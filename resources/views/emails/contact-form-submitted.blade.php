@extends('emails.layout.modern', ['title' => 'Nouveau message de contact'])

@section('content')
    <h2>Nouveau message de contact</h2>
    
    <p>Vous avez reçu un nouveau message depuis le formulaire de contact de votre portfolio.</p>
    
    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 8px; padding: 20px; margin-top: 20px; margin-bottom: 25px;">
        <h3 class="section-title" style="margin-top: 0;">Détails de l'expéditeur</h3>
        <p style="margin-bottom: 8px;"><span class="text-zinc">Nom :</span> <span class="font-semibold text-emerald">{{ $contact->prenom }} {{ $contact->nom }}</span></p>
        <p style="margin-bottom: 8px;"><span class="text-zinc">Email :</span> <a href="mailto:{{ $contact->email }}" style="color: #f4f4f5; text-decoration: none;">{{ $contact->email }}</a></p>
        <p style="margin-bottom: 8px;"><span class="text-zinc">Téléphone :</span> {{ $contact->telephone ?? 'Non renseigné' }}</p>
        <p style="margin-bottom: 8px;"><span class="text-zinc">Catégorie :</span> <span style="background-color: rgba(255,255,255,0.1); padding: 2px 8px; border-radius: 4px; font-size: 12px;">{{ ucfirst($contact->categorie) }}</span></p>
        
        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #27272a;">
            <p style="margin-bottom: 8px;"><span class="text-zinc">Sujet :</span> <strong>{{ $contact->sujet }}</strong></p>
            <p class="text-zinc mb-2">Message :</p>
            <div style="background-color: #18181b; padding: 15px; border-radius: 6px; border-left: 3px solid #10b981; font-style: italic; color: #d4d4d8;">
                {!! nl2br(e($contact->message)) !!}
            </div>
        </div>
    </div>
    
    <div style="text-align: center;">
        <a href="mailto:{{ $contact->email }}?subject=RE: {{ rawurlencode($contact->sujet) }}" class="btn">Répondre à {{ $contact->prenom }}</a>
    </div>
@endsection
