<?php

namespace App\Notifications;

use App\Models\FormationRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class FormationRegistrationSubmitted extends Notification implements ShouldQueue
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
            ->subject('Votre demande d’inscription a bien été reçue')
            ->greeting('Bonjour '.$notifiable->name.' !')
            ->line('Votre demande d’inscription à la formation « '.$this->registration->formation->title.' » a bien été enregistrée.')
            ->line('Statut : '.FormationRegistration::statusOptions()[$this->registration->status])
            ->action('Voir la formation', route('formations.show', ['formation' => $this->registration->formation->slug]))
            ->line('Vous recevrez une nouvelle notification dès que votre demande sera traitée.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'formation_registration_submitted',
            'registration_id' => $this->registration->getKey(),
            'formation_id' => $this->registration->formation_id,
            'formation_title' => $this->registration->formation->title,
            'status' => $this->registration->status,
        ];
    }
}
