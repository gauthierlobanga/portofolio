{{-- resources/views/components/pdf-viewer.blade.php --}}
@props([
    'pdfUrl' => null,
    'label' => 'Lire le document',
    'modalTitle' => 'Document PDF',
    'buttonClass' => 'inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium transition-colors',
    'icon' => null,
])

@php
    $__pdfViewerId = 'pdf-viewer-'.\Illuminate\Support\Str::random(8);
@endphp

<div id="{{ $__pdfViewerId }}" wire:ignore x-data="pdfViewer(@json($pdfUrl))" data-pdf-url="{{ $pdfUrl }}">
    @if ($pdfUrl)
        {{-- Bouton d'ouverture --}}
        <button type="button" data-pdf-open-button
                @click="openModal()"
                class="{{ $buttonClass }}"
                aria-label="{{ $label }}">
            @if ($icon)
                {{ $icon }}
            @else
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            @endif
            <span>{{ $label }}</span>
        </button>

        {{-- ===== MODALE PLEIN ECRAN (Style Liseuse Moderne) ===== --}}
        <div data-pdf-modal x-show="open"
             x-cloak
             x-transition:enter.duration.300.opacity
             x-transition:leave.duration.200.opacity
             class="fixed inset-0 z-[100] flex flex-col bg-zinc-900 backdrop-blur-md"
             @keydown.escape.window="closeModal()"
             role="dialog"
             aria-modal="true"
             aria-labelledby="pdf-modal-title">

            {{-- En-tête de la liseuse --}}
            <div class="flex items-center justify-between px-6 py-4 bg-zinc-950 border-b border-zinc-800 shrink-0 shadow-sm"
                 x-transition:enter.duration.400.translate.y.-100
                 x-transition:leave.duration.300.translate.y.-100>
                <div class="flex items-center gap-4 text-zinc-100">
                    <button type="button" data-pdf-close-button
                            @click="closeModal()"
                            class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors rounded-full"
                            aria-label="Fermer la liseuse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </button>
                    <div class="flex flex-col">
                        <span id="pdf-modal-title" class="font-medium text-lg tracking-wide">{{ $modalTitle }}</span>
                        <span class="text-xs text-zinc-400">Lecteur PDF intégré</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ $pdfUrl }}"
                       download
                       class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-500 transition-colors rounded-full"
                       aria-label="Télécharger le document">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span class="hidden sm:inline">Télécharger</span>
                    </a>
                </div>
            </div>

            {{-- Contenu PDF --}}
            <div class="flex-1 w-full h-full relative overflow-hidden flex items-center justify-center">
                {{-- État de chargement --}}
                <div x-show="loading"
                     x-transition.opacity.duration.300
                     class="absolute inset-0 flex items-center justify-center z-10">
                    <div class="flex flex-col items-center gap-4">
                        <div class="w-12 h-12 border-4 border-zinc-700 border-t-emerald-500 rounded-full animate-spin"></div>
                        <span class="text-sm font-medium text-zinc-300">Préparation du document...</span>
                    </div>
                </div>

                {{-- Message d'erreur --}}
                <div x-show="error"
                     x-cloak
                     x-transition.opacity.duration.300
                     class="absolute inset-0 flex items-center justify-center bg-zinc-900 z-10">
                    <div class="text-center max-w-md px-6 py-8 bg-zinc-800 rounded-2xl shadow-xl">
                        <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-white text-lg font-medium">Impossible d'afficher le document</p>
                        <p class="text-sm text-zinc-400 mt-2 mb-6">Le lecteur natif du navigateur a rencontré un problème. Vous pouvez réessayer ou ouvrir le fichier manuellement.</p>
                        <div class="flex items-center justify-center gap-3">
                            <button type="button"
                                    @click="retry()"
                                    class="px-5 py-2.5 bg-zinc-700 text-white hover:bg-zinc-600 rounded-lg transition font-medium">
                                Réessayer
                            </button>
                            <a x-bind:href="pdfUrl"
                               target="_blank"
                               rel="noopener"
                               class="px-5 py-2.5 bg-emerald-600 text-white hover:bg-emerald-500 rounded-lg transition font-medium">
                                Ouvrir l'original
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Lecteur PDF (iframe) --}}
                <iframe x-ref="pdfIframe"
                        class="w-full h-full border-none shadow-inner bg-white"
                        title="Lecteur PDF"
                        frameborder="0"
                        x-on:load="handleIframeLoad()"
                        x-on:error="handleIframeError()">
                </iframe>
            </div>
        </div>
    @else
        <span class="text-sm text-zinc-400 dark:text-zinc-600">Aucun document PDF</span>
    @endif
</div>

@once
    <script>
        (function() {
            const register = () => {
                Alpine.data('pdfViewer', (initialUrl) => ({
                    open: false,
                    pdfUrl: initialUrl ?? null,
                    loading: true,
                    error: false,
                    iframeLoaded: false,

                    init() {
                        if (!this.pdfUrl) return;
                        const link = document.createElement('link');
                        link.rel = 'prefetch';
                        link.href = this.pdfUrl;
                        document.head.appendChild(link);
                    },

                    openModal() {
                        this.open = true;
                        this.loading = true;
                        this.error = false;
                        this.iframeLoaded = false;
                        this.$nextTick(() => {
                            const iframe = this.$refs.pdfIframe;
                            if (iframe) iframe.src = this.pdfUrl ? this.pdfUrl + '#toolbar=0&navpanes=0&view=FitH' : '';
                        });
                    },

                    closeModal() {
                        this.open = false;
                        this.loading = false;
                        this.error = false;
                        this.iframeLoaded = false;
                        this.$nextTick(() => {
                            const iframe = this.$refs.pdfIframe;
                            if (iframe) iframe.src = '';
                        });
                    },

                    handleIframeLoad() {
                        this.loading = false;
                        this.error = false;
                        this.iframeLoaded = true;
                    },

                    handleIframeError() {
                        this.loading = false;
                        this.error = true;
                    },

                    retry() {
                        this.loading = true;
                        this.error = false;
                        this.iframeLoaded = false;
                        const iframe = this.$refs.pdfIframe;
                        if (iframe) iframe.src = this.pdfUrl ? this.pdfUrl + '#toolbar=0&navpanes=0&view=FitH' : '';
                    },

                    openPdfExternal() {
                        if (!this.pdfUrl) return;
                        window.open(this.pdfUrl, '_blank', 'noopener');
                    },
                }));
            };

            if (window.Alpine) {
                register();
            } else {
                document.addEventListener('alpine:init', register);
            }
        })();
    </script>
@endonce

<script>
    (function(){
        const root = document.getElementById("{{ $__pdfViewerId }}");
        if (!root) return;
        const openBtn = root.querySelector('[data-pdf-open-button]');
        const closeBtn = root.querySelector('[data-pdf-close-button]');
        const modal = root.querySelector('[data-pdf-modal]');
        const iframe = root.querySelector('iframe');
        const pdfUrl = root.dataset.pdfUrl;

        // Fallback handlers — run even if Alpine is present to ensure modal works when Alpine/Livewire is broken
        if (openBtn) {
            openBtn.addEventListener('click', function (e) {
                try {
                    if (modal) {
                        modal.style.display = 'flex';
                    }
                    if (iframe && pdfUrl) {
                        iframe.src = pdfUrl + '#toolbar=0&navpanes=0&view=FitH';
                    }
                } catch (err) {
                    // silent
                }
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                try {
                    if (modal) modal.style.display = 'none';
                    if (iframe) iframe.src = '';
                } catch (err) {}
            });
        }

        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    try {
                        modal.style.display = 'none';
                        if (iframe) iframe.src = '';
                    } catch (err) {}
                }
            });
        }
    })();
</script>
