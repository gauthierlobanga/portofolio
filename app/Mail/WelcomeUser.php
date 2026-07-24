<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable de bienvenue pour un nouvel utilisateur.
 *
 * Cet e-mail est envoyé à un utilisateur juste après son inscription
 * pour lui souhaiter la bienvenue sur la plateforme. Il utilise le layout
 * premium "modern" avec la présentation du portfolio dans le footer.
 */
class WelcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur GauDev !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-user',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
