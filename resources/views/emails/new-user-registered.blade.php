@extends('emails.layout.modern', ['title' => 'Nouvel utilisateur inscrit'])

@section('content')
    <h2>Nouvel utilisateur inscrit</h2>
    
    <p>Un nouvel utilisateur vient de créer un compte sur votre plateforme.</p>
    
    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 8px; padding: 20px; margin-top: 20px; margin-bottom: 25px;">
        <h3 class="section-title" style="margin-top: 0;">Détails du compte</h3>
        
        <div style="display: flex; align-items: center; margin-bottom: 15px;">
            <div style="width: 48px; height: 48px; border-radius: 50%; background-color: #10b981; color: #09090b; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: bold; margin-right: 15px; text-transform: uppercase;">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; color: #f4f4f5;">{{ $user->name }}</div>
                <a href="mailto:{{ $user->email }}" style="color: #a1a1aa; font-size: 14px; text-decoration: none;">{{ $user->email }}</a>
            </div>
        </div>
        
        <p style="margin-bottom: 0; font-size: 13px; color: #71717a;">
            Inscrit le : {{ $user->created_at->format('d/m/Y à H:i') }}
        </p>
    </div>
    
    <div style="text-align: center;">
        <a href="{{ url('/admin') }}" class="btn">Voir dans l'administration</a>
    </div>
@endsection
