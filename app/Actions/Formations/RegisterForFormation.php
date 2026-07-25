<?php

namespace App\Actions\Formations;

use App\Exceptions\Formations\FormationRegistrationException;
use App\Models\Formation;
use App\Models\FormationRegistration;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class RegisterForFormation
{
    public function __invoke(
        Formation $formation,
        User $user,
        string $message,
        bool $termsAccepted,
    ): FormationRegistration {
        if (! $termsAccepted) {
            throw new FormationRegistrationException('Vous devez accepter les conditions d’inscription.');
        }

        if (! $user->hasVerifiedEmail()) {
            throw new FormationRegistrationException('Votre adresse email doit être vérifiée avant l’inscription.');
        }

        return DB::transaction(function () use ($formation, $user, $message): FormationRegistration {
            $lockedFormation = Formation::query()
                ->lockForUpdate()
                ->findOrFail($formation->getKey());

            if (! $lockedFormation->acceptsRegistrations()) {
                throw new FormationRegistrationException('Les inscriptions pour cette formation sont fermées.');
            }

            $existing = FormationRegistration::withTrashed()
                ->whereBelongsTo($lockedFormation, 'formation')
                ->whereBelongsTo($user)
                ->first();

            if ($existing?->isOpen() && ! $existing->trashed()) {
                throw new FormationRegistrationException('Vous êtes déjà inscrit à cette formation.');
            }

            $occupiedSeats = FormationRegistration::query()
                ->whereBelongsTo($lockedFormation, 'formation')
                ->activeForCapacity()
                ->count();

            $status = $lockedFormation->capacity !== null
                && $occupiedSeats >= $lockedFormation->capacity
                ? FormationRegistration::STATUS_WAITLISTED
                : FormationRegistration::STATUS_PENDING;

            $registrationData = [
                'formation_id' => $lockedFormation->getKey(),
                'user_id' => $user->getKey(),
                'status' => $status,
                'payment_status' => $lockedFormation->price !== null && (float) $lockedFormation->price > 0
                    ? FormationRegistration::PAYMENT_PENDING
                    : FormationRegistration::PAYMENT_FREE,
                'amount' => $lockedFormation->price,
                'currency' => $lockedFormation->currency ?: 'EUR',
                'attendance_status' => FormationRegistration::ATTENDANCE_REGISTERED,
                'terms_accepted_at' => now(),
                'approved_at' => null,
                'cancelled_at' => null,
                'message' => trim($message) ?: null,
            ];

            if ($existing) {
                if ($existing->trashed()) {
                    $existing->restore();
                }

                $existing->fill($registrationData);
                $existing->save();

                return $existing->load(['formation', 'user']);
            }

            return FormationRegistration::query()
                ->create($registrationData)
                ->load(['formation', 'user']);
        }, attempts: 3);
    }
}
