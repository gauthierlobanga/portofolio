<?php

namespace App\Actions\Formations;

use App\Exceptions\Formations\FormationRegistrationException;
use App\Models\Formation;
use App\Models\FormationRegistration;
use App\Notifications\FormationRegistrationStatusChanged;
use Illuminate\Support\Facades\DB;

final class ChangeFormationRegistrationStatus
{
    public function __invoke(FormationRegistration $registration, string $status): FormationRegistration
    {
        if (! array_key_exists($status, FormationRegistration::statusOptions())) {
            throw new FormationRegistrationException('Le statut demandé est invalide.');
        }

        $promotedRegistration = null;

        $updatedRegistration = DB::transaction(function () use ($registration, $status, &$promotedRegistration): FormationRegistration {
            $lockedRegistration = FormationRegistration::query()
                ->lockForUpdate()
                ->findOrFail($registration->getKey());

            $previousStatus = $lockedRegistration->status;

            $formation = Formation::query()
                ->lockForUpdate()
                ->findOrFail($lockedRegistration->formation_id);

            if ($status === FormationRegistration::STATUS_APPROVED && $formation->capacity !== null) {
                $occupiedSeats = FormationRegistration::query()
                    ->whereBelongsTo($formation, 'formation')
                    ->activeForCapacity()
                    ->where($lockedRegistration->getKeyName(), '!=', $lockedRegistration->getKey())
                    ->count();

                if ($occupiedSeats >= $formation->capacity) {
                    throw new FormationRegistrationException('Aucune place disponible pour approuver cette inscription.');
                }
            }

            $lockedRegistration->status = $status;
            $lockedRegistration->approved_at = $status === FormationRegistration::STATUS_APPROVED
                ? ($lockedRegistration->approved_at ?? now())
                : null;
            $lockedRegistration->cancelled_at = $status === FormationRegistration::STATUS_CANCELLED
                ? ($lockedRegistration->cancelled_at ?? now())
                : null;
            $lockedRegistration->save();

            if (
                $formation->capacity !== null
                && $previousStatus !== $status
                && in_array($previousStatus, [
                    FormationRegistration::STATUS_PENDING,
                    FormationRegistration::STATUS_APPROVED,
                ], true)
                && in_array($status, [
                    FormationRegistration::STATUS_REJECTED,
                    FormationRegistration::STATUS_CANCELLED,
                ], true)
            ) {
                $promotedRegistration = FormationRegistration::query()
                    ->whereBelongsTo($formation, 'formation')
                    ->where('status', FormationRegistration::STATUS_WAITLISTED)
                    ->orderBy('created_at')
                    ->lockForUpdate()
                    ->first();

                if ($promotedRegistration) {
                    $promotedRegistration->status = FormationRegistration::STATUS_APPROVED;
                    $promotedRegistration->approved_at = now();
                    $promotedRegistration->cancelled_at = null;
                    $promotedRegistration->save();
                    $promotedRegistration->load(['formation', 'user']);
                }
            }

            return $lockedRegistration->load(['formation', 'user']);
        }, attempts: 3);

        if ($updatedRegistration->wasChanged('status')) {
            $updatedRegistration->user->notify(new FormationRegistrationStatusChanged($updatedRegistration));
        }

        if ($promotedRegistration) {
            $promotedRegistration->user->notify(new FormationRegistrationStatusChanged($promotedRegistration));
        }

        return $updatedRegistration;
    }
}
