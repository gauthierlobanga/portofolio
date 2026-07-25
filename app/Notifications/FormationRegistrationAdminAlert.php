<?php

namespace App\Notifications;

use App\Models\FormationRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class FormationRegistrationAdminAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public FormationRegistration $registration)
    {
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouvelle demande d’inscription')
            ->greeting('Nouvelle inscription à traiter')
            ->line($this->registration->user->name.' demande une inscription à « '.$this->registration->formation->title.' ».')
            ->line('Statut : '.FormationRegistration::statusOptions()[$this->registration->status])
            ->action('Ouvrir la gestion des inscriptions', route('filament.admin.resources.formation-registrations.index'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'formation_registration_admin_alert',
            'registration_id' => $this->registration->getKey(),
            'formation_id' => $this->registration->formation_id,
            'formation_title' => $this->registration->formation->title,
            'participant_name' => $this->registration->user->name,
            'status' => $this->registration->status,
        ];
    }
}
