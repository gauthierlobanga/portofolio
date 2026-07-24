<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable pour l'auto-répondeur du formulaire de contact.
 *
 * Cet e-mail est envoyé au visiteur pour lui confirmer la bonne réception
 * de son message. Il utilise le layout premium "modern" et injecte
 * dynamiquement les informations du portfolio dans le footer.
 */
class ContactAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre message - GauDev',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-auto-reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
