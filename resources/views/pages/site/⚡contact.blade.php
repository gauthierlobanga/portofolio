<?php

use Livewire\Component;
use App\Models\Contact;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Settings\SettingApp;

new #[Layout('layouts::main')] class extends Component {
    #[Validate('required|string|min:2')]
    public string $nom = '';

    #[Validate('required|string|min:2')]
    public string $prenom = '';

    #[Validate('required|email')]
    public string $email = '';

    public string $contactEmail = ''; // ← nouvelle propriété pour l'affichage dans le Hero

    #[Validate('nullable|string|min:9')]
    public string $telephone = '';

    #[Validate('required|string|in:general,commercial,technique,support,reclamation')]
    public string $categorie = 'general';

    #[Validate('required|string|min:5')]
    public string $sujet = '';

    #[Validate('required|string|min:10|max:5000')]
    public string $message = '';

    public bool $sent = false;

    public string $appName = 'CADERSA';
    public ?string $logoUrl = null;
    public array $socialLinks = [];

    public ?string $phone = null;
    public ?string $secondaryEmail = null;
    public array $addresses = [];

    public function boot(SettingApp $appSettings): void
    {
        $this->appName = $appSettings->name;
        $this->logoUrl = $appSettings->logoUrl();
        $this->socialLinks = $this->buildSocialLinks($appSettings);
        $this->phone = $appSettings->phone;
        $this->contactEmail = $appSettings->email; // ← modifié
        $this->secondaryEmail = $appSettings->secondary_email;
        $this->addresses = $appSettings->addresses ?? [];
    }

    protected function buildSocialLinks(SettingApp $settings): array
    {
        $links = [];
        if ($settings->facebook_url) {
            $links['facebook'] = $settings->facebook_url;
        }
        if ($settings->x_url) {
            $links['x'] = $settings->x_url;
        }
        if ($settings->linkedin_url) {
            $links['linkedin'] = $settings->linkedin_url;
        }
        if ($settings->instagram_url) {
            $links['instagram'] = $settings->instagram_url;
        }
        if ($settings->youtube_url) {
            $links['youtube'] = $settings->youtube_url;
        }
        return $links;
    }

    public function with(SettingApp $settings): array
    {
        return [
            'settings' => $settings,
            'categories' => Contact::getCategories(),
            'addresses' => $settings->addresses ?? [],
        ];
    }

    /**
     * Messages de validation personnalisés
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'nom.min' => 'Le nom doit contenir au moins 2 caractères.',

            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.min' => 'Le prénom doit contenir au moins 2 caractères.',

            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse email valide.',

            'telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'telephone.min' => 'Le numéro de téléphone doit contenir au moins 9 caractères.',

            'categorie.required' => 'Veuillez sélectionner une catégorie.',
            'categorie.in' => 'La catégorie sélectionnée n\'est pas valide.',

            'sujet.required' => 'Le sujet est obligatoire.',
            'sujet.string' => 'Le sujet doit être une chaîne de caractères.',
            'sujet.min' => 'Le sujet doit contenir au moins 5 caractères.',

            'message.required' => 'Le message est obligatoire.',
            'message.string' => 'Le message doit être une chaîne de caractères.',
            'message.min' => 'Le message doit contenir au moins 10 caractères.',
            'message.max' => 'Le message ne peut pas dépasser 5000 caractères.',
        ];
    }

    public function submit()
    {
        $this->validate();

        $contact = Contact::create([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'categorie' => $this->categorie,
            'sujet' => $this->sujet,
            'message' => $this->message,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        try {
            if ($this->contactEmail) {
                \Illuminate\Support\Facades\Mail::to($this->contactEmail)->send(new \App\Mail\ContactFormSubmitted($contact));
            }

            // Envoi de l'accusé de réception / auto-répondeur au visiteur
            \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\ContactAutoReply($contact));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de l\'envoi des emails de contact : ' . $e->getMessage());
        }

        $this->reset(['nom', 'prenom', 'email', 'telephone', 'categorie', 'sujet', 'message']);
        $this->sent = true;
    }

    public function getCategoryIcon(string $category): string
    {
        return match ($category) {
            'general' => '',
            'commercial' => '',
            'technique' => '',
            'support' => '',
            'reclamation' => '',
            default => '',
        };
    }
};
?>

<div>
    {{-- ==================== HERO CONTACT ==================== --}}
    <section class="relative flex flex-col items-center justify-center overflow-hidden bg-white py-24 dark:bg-zinc-950">
        {{-- Décoration d'arrière-plan épurée --}}
        <div class="pointer-events-none absolute inset-0 z-0 flex justify-center">
            {{-- Gradient subtil --}}
            <div class="absolute top-[-20%] left-1/2 aspect-square w-[800px] -translate-x-1/2 rounded-full bg-linear-to-br from-emerald-100/40 via-transparent to-transparent blur-[100px] dark:from-emerald-900/20 dark:to-transparent"></div>
            {{-- Grid Pattern --}}
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
        </div>

        <div class="relative z-10 mx-auto max-w-5xl px-6 lg:px-8 text-center" x-cloak x-data="{ shown: false }" x-intersect.once="shown = true">
            
            <div class="inline-flex items-center gap-2.5 rounded-full border border-emerald-200/50 bg-emerald-50/50 px-3.5 py-1 text-[11px] font-medium uppercase tracking-[0.15em] text-emerald-600 shadow-sm backdrop-blur-md transition-all duration-300 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400 mb-6"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'">
                <span class="relative flex h-1.5 w-1.5">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span>
                </span>
                {{ $settings->contact_hero_badge ?: 'Nous contacter' }}
            </div>

            @if ($settings->contact_hero_title)
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-zinc-900 font-serif dark:text-white transition-all duration-500 delay-100"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    {{ $settings->contact_hero_title }}
                </h1>
            @else
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-zinc-900 font-serif dark:text-white transition-all duration-500 delay-100"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Parlons de votre <span class="bg-linear-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent dark:from-emerald-400 dark:to-teal-400">projet</span>
                </h1>
            @endif

            <p class="mx-auto mt-6 max-w-2xl text-lg sm:text-xl text-zinc-600 dark:text-zinc-400 transition-all duration-500 delay-200"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                {{ $settings->contact_hero_subtitle ?: 'Notre équipe est disponible pour répondre à toutes vos questions et vous accompagner dans vos projets.' }}
            </p>
            
            {{-- Coordonnées rapides --}}
            @if ($phone || $contactEmail  || $secondaryEmail)
                <div class="mt-8 flex flex-wrap justify-center gap-4 text-sm"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                     style="transition: all 0.5s ease-out 0.3s;">
                    @if ($phone)
                        <a href="tel:{{ $phone }}" class="flex items-center gap-2 rounded-full border border-zinc-200/80 bg-white/80 px-4 py-2 font-medium text-zinc-700 shadow-sm backdrop-blur-md transition-all hover:scale-105 hover:border-emerald-300 hover:text-emerald-600 dark:border-zinc-800/80 dark:bg-zinc-900/80 dark:text-zinc-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 16.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            {{ $phone }}
                        </a>
                    @endif
                    @if ($contactEmail )
                        <a href="mailto:{{ $contactEmail }}" class="flex items-center gap-2 rounded-full border border-zinc-200/80 bg-white/80 px-4 py-2 font-medium text-zinc-700 shadow-sm backdrop-blur-md transition-all hover:scale-105 hover:border-emerald-300 hover:text-emerald-600 dark:border-zinc-800/80 dark:bg-zinc-900/80 dark:text-zinc-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            {{ $contactEmail }}
                        </a>
                    @endif
                    @if ($secondaryEmail)
                        <a href="mailto:{{ $secondaryEmail }}" class="flex items-center gap-2 rounded-full border border-zinc-200/80 bg-white/80 px-4 py-2 font-medium text-zinc-700 shadow-sm backdrop-blur-md transition-all hover:scale-105 hover:border-emerald-300 hover:text-emerald-600 dark:border-zinc-800/80 dark:bg-zinc-900/80 dark:text-zinc-300 dark:hover:border-emerald-700 dark:hover:text-emerald-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            {{ $secondaryEmail }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <section class="relative z-0 mx-auto -mt-12 max-w-4xl px-6 pb-24 lg:px-8">
        {{-- ADRESSES AVEC BORDURE SUBTILE --}}
        @if (!empty($this->addresses))
            <div class="mb-12">
                <h3 class="mb-6 flex items-center justify-center gap-2 text-sm font-semibold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 text-center">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    {{ $settings->contact_offices_title ?: 'Nos bureaux' }}
                </h3>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach ($this->addresses as $addr)
                        <div class="group flex items-start gap-4 rounded-3xl border border-zinc-200/60 bg-white/50 p-6 shadow-sm backdrop-blur-md transition-all hover:border-emerald-300 dark:border-zinc-800/60 dark:bg-zinc-900/50 dark:hover:border-emerald-700">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-zinc-100 text-emerald-600 transition-colors group-hover:bg-emerald-100 dark:bg-zinc-800 dark:text-emerald-400 dark:group-hover:bg-emerald-900/50">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div class="text-left">
                                <h4 class="font-semibold text-zinc-900 dark:text-white">{{ $addr['label'] }}</h4>
                                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">{{ $addr['address'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- FORMULAIRE --}}
        <div class="overflow-hidden rounded-3xl border border-zinc-200/60 bg-white/80 p-6 shadow-xl shadow-zinc-200/20 backdrop-blur-xl sm:p-12 dark:border-zinc-800/60 dark:bg-zinc-900/80 dark:shadow-none">
            
            <div class="mb-8 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white">
                    {{ $settings->contact_form_heading ?: 'Envoyez-nous un message' }}
                </h2>
                <p class="mt-2 text-sm sm:text-base text-zinc-500 dark:text-zinc-400">
                    {{ $settings->contact_form_description ?: 'Remplissez le formulaire ci-dessous, nous vous répondrons dans les plus brefs délais.' }}
                </p>
            </div>

            {{-- Succès --}}
            @if ($sent)
                <div wire:key="success-message" wire:transition class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100 text-emerald-500 dark:bg-emerald-900/30">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <h3 class="mt-6 text-2xl font-bold text-zinc-900 dark:text-white">Message envoyé !</h3>
                    <p class="mt-2 text-zinc-600 dark:text-zinc-400">Nous avons bien reçu votre message et vous répondrons rapidement.</p>
                    <flux:button variant="outline" type="button" wire:click="$set('sent', false)" class="mt-8">
                        Envoyer un autre message
                    </flux:button>
                </div>
            @else
                {{-- Formulaire --}}
                <form wire:key="contact-form" wire:submit="submit" wire:transition class="space-y-6">
                    {{-- Catégories (validation en temps réel) --}}
                    <div>
                        <label class="mb-3 block text-sm font-semibold text-zinc-900 dark:text-zinc-100">Quel est l'objet de votre demande ?</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($categories as $key => $label)
                                <button type="button" wire:click="$set('categorie', '{{ $key }}')" wire:key="cat-{{ $key }}" aria-pressed="{{ $categorie === $key ? 'true' : 'false' }}"
                                    class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-medium transition-all duration-200
                                    {{ $categorie === $key
                                        ? 'border-emerald-500 bg-emerald-50 text-emerald-700 ring-1 ring-emerald-500 dark:border-emerald-500 dark:bg-emerald-900/30 dark:text-emerald-300 dark:ring-emerald-500'
                                        : 'border-zinc-200 bg-white text-zinc-700 hover:border-emerald-300 hover:bg-emerald-50/50 dark:border-zinc-700/80 dark:bg-zinc-800/50 dark:text-zinc-300 dark:hover:border-emerald-700 dark:hover:bg-zinc-800' }}">
                                    @if ($categorie === $key)
                                        <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                    @endif
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                        @error('categorie')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    {{-- Nom / Prénom --}}
                    <div class="grid gap-6 sm:grid-cols-2">
                        <flux:input wire:model.live.debounce.300ms="nom" label="Nom" placeholder="Dupont" />
                        <flux:input wire:model.live.debounce.300ms="prenom" label="Prénom" placeholder="Jean" />
                    </div>

                    {{-- Email / Téléphone --}}
                    <div class="grid gap-6 sm:grid-cols-2">
                        <flux:input type="email" wire:model.live.debounce.300ms="email" label="Adresse email" placeholder="jean@exemple.com" />
                        <flux:input type="tel" wire:model.live.debounce.300ms="telephone" label="Téléphone (optionnel)" placeholder="+33 6 12 34 56 78" />
                    </div>

                    {{-- Sujet --}}
                    <flux:input wire:model.live.debounce.300ms="sujet" label="Sujet" placeholder="Demande de renseignements" />

                    {{-- Message --}}
                    <flux:textarea wire:model.live.debounce.300ms="message" label="Message" rows="5" placeholder="Décrivez votre demande en détail..." />
                    
                    {{-- Compteur de caractères --}}
                    <div class="mt-1 flex items-center justify-between">
                        <div class="h-1 w-full flex-1 rounded-full bg-zinc-100 dark:bg-zinc-800">
                            <div class="h-1 rounded-full bg-emerald-500 transition-all duration-300" style="width: {{ (mb_strlen($message) / 5000) * 100 }}%"></div>
                        </div>
                        <span class="ml-4 text-xs font-medium text-zinc-400">{{ mb_strlen($message) }}/5000</span>
                    </div>

                    {{-- Indice catégorie dynamique --}}
                    <div class="relative overflow-hidden min-h-[56px] rounded-2xl border border-zinc-200/50 bg-zinc-50/50 p-4 text-sm dark:border-zinc-800/50 dark:bg-zinc-900/30">
                        <span wire:key="hint-{{ $categorie }}" wire:transition class="absolute flex items-center gap-2 text-zinc-600 dark:text-zinc-400">
                            <svg class="h-4 w-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @switch($categorie)
                                @case('general') Pour une question générale ou un premier contact. @break
                                @case('commercial') Demandez un devis, une présentation ou un accompagnement business. @break
                                @case('technique') Signalez un besoin technique ou une intégration. @break
                                @case('support') Obtenez de l'aide sur un service en cours. @break
                                @case('reclamation') Partagez une insatisfaction pour un traitement prioritaire. @break
                            @endswitch
                        </span>
                    </div>

                    <div class="pt-4">
                        <flux:button variant="primary" type="submit" wire:loading.attr="disabled" class="w-full sm:w-auto px-8">
                            Envoyer le message
                        </flux:button>
                        <p class="mt-4 text-center sm:text-left text-xs text-zinc-500 dark:text-zinc-500">
                            Vos données sont traitées avec la plus grande confidentialité.
                        </p>
                    </div>
                </form>
            @endif
        </div>
    </section>

    {{-- ==================== FAQ ==================== --}}
    <livewire:faq.faq />
</div>
