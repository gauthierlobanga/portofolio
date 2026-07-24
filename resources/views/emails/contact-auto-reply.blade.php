@extends('emails.layout.modern', ['title' => 'Merci pour votre message !'])

@section('content')
    <h2>Bonjour {{ $contact->prenom }},</h2>
    
    <p>Merci de m'avoir contacté via mon portfolio ! Je confirme la bonne réception de votre message concernant <strong>"{{ $contact->sujet }}"</strong>.</p>
    
    <div style="background-color: #18181b; padding: 15px; border-radius: 6px; border-left: 3px solid #10b981; font-style: italic; color: #d4d4d8; margin: 20px 0;">
        "{{ Str::limit($contact->message, 150) }}"
    </div>
    
    <p>Je vous répondrai dans les plus brefs délais à cette adresse e-mail. En attendant, n'hésitez pas à parcourir mes services et compétences ci-dessous.</p>
    
    <p>À très vite !</p>
@endsection
