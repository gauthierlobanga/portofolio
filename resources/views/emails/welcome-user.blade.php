@extends('emails.layout.modern', ['title' => 'Bienvenue sur GauDev !'])

@section('content')
    <h2>Bienvenue {{ explode(' ', $user->name)[0] }} !</h2>
    
    <p>Je suis ravi de vous compter parmi les membres de la plateforme. Votre compte a été créé avec succès.</p>
    
    <p>GauDev est conçu pour vous offrir des services de développement sur-mesure et vous accompagner dans la réussite de vos projets technologiques.</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ url('/login') }}" class="btn">Accéder à mon espace</a>
    </div>
    
    <p>Si vous avez la moindre question ou un projet en tête, n'hésitez pas à répondre directement à cet e-mail.</p>
    
    <p>À bientôt !</p>
@endsection
