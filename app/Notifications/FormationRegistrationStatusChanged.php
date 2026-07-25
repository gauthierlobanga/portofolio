<?php

namespace App\Notifications;

use App\Models\FormationRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class FormationRegistrationStatusChanged extends Notification implements ShouldQueue
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
            ->subject('Mise à jour de votre inscription')
            ->greeting('Bonjour '.$notifiable->name.' !')
            ->line('Le statut de votre inscription à la formation « '.$this->registration->formation->title.' » a été mis à jour.')
            ->line('Nouveau statut : '.FormationRegistration::statusOptions()[$this->registration->status])
            ->action('Voir la formation', route('formations.show', ['formation' => $this->registration->formation->slug]));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'formation_registration_status_changed',
            'registration_id' => $this->registration->getKey(),
            'formation_id' => $this->registration->formation_id,
            'formation_title' => $this->registration->formation->title,
            'status' => $this->registration->status,
        ];
    }
}
