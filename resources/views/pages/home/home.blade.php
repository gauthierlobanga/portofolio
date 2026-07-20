<div>
    @if (session()->has('message'))
        <div x-cloak x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false }, 5000)"
            class="mb-6 p-4 rounded-lg transition-all duration-500 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-8">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-3" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span
                    class="text-green-800 dark:text-green-300 font-medium">{{ session('message ' . auth()->user()->name) }}</span>
            </div>
        </div>
    @endif

    <div class="rounded-t-2xl overflow-hidden">
        <div class="w-full max-w-screen-xl px-0 py-20 mx-auto lg:p-10" x-cloak x-data="{}">
            <div x-data="{}" x-init="$nextTick(() => {
                if (reducedMotion) return
                gsap.timeline({
                        scrollTrigger: {
                            trigger: $refs.header,
                            start: 'top bottom-=150px',
                        },
                    })
                    .fromTo(
                        $refs.header_introducing, {
                            autoAlpha: 0,
                            y: -30,
                        }, {
                            autoAlpha: 1,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                    )
                    .fromTo(
                        $refs.header_new, {
                            autoAlpha: 0,
                            x: -30,
                            y: 30,
                        }, {
                            autoAlpha: 1,
                            x: 0,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.6',
                    )
                    .fromTo(
                        $refs.header_version4, {
                            autoAlpha: 0,
                            y: 30,
                        }, {
                            autoAlpha: 1,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.6',
                    )
                    .fromTo(
                        $refs.header_features, {
                            autoAlpha: 0,
                            x: 30,
                            y: 30,
                        }, {
                            autoAlpha: 1,
                            x: 0,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.6',
                    )
                gsap.fromTo(
                    $refs.feature_1, {
                        autoAlpha: 0,
                        x: -20,
                    }, {
                        autoAlpha: 1,
                        x: 0,
                        duration: 0.7,
                        ease: 'circ.out',
                        scrollTrigger: {
                            trigger: $refs.feature_1,
                            start: 'top bottom-=150px',
                        },
                    },
                )
                gsap.fromTo(
                    $refs.feature_2, {
                        autoAlpha: 0,
                        x: 20,
                    }, {
                        autoAlpha: 1,
                        x: 0,
                        duration: 0.7,
                        ease: 'circ.out',
                        scrollTrigger: {
                            trigger: $refs.feature_2,
                            start: 'top bottom-=150px',
                        },
                    },
                )
                gsap.fromTo(
                    $refs.feature_3, {
                        autoAlpha: 0,
                        x: -20,
                    }, {
                        autoAlpha: 1,
                        x: 0,
                        duration: 0.7,
                        ease: 'circ.out',
                        scrollTrigger: {
                            trigger: $refs.feature_3,
                            start: 'top bottom-=150px',
                        },
                    },
                )
                gsap.fromTo(
                    $refs.feature_4, {
                        autoAlpha: 0,
                        x: 20,
                    }, {
                        autoAlpha: 1,
                        x: 0,
                        duration: 0.7,
                        ease: 'circ.out',
                        scrollTrigger: {
                            trigger: $refs.feature_4,
                            start: 'top bottom-=150px',
                        },
                    },
                )
                gsap.fromTo(
                    $refs.feature_5, {
                        autoAlpha: 0,
                        x: -20,
                    }, {
                        autoAlpha: 1,
                        x: 0,
                        duration: 0.7,
                        ease: 'circ.out',
                        scrollTrigger: {
                            trigger: $refs.feature_5,
                            start: 'top bottom-=150px',
                        },
                    },
                )
                gsap.to($refs.geometric_shape_1, {
                    yPercent: -100,
                    rotate: 100,
                    scrollTrigger: {
                        trigger: $refs.feature_1,
                        scrub: 1.5,
                        start: 'top bottom-=200px',
                        end: 'bottom+=300px center',
                    },
                })
                gsap.to($refs.geometric_shape_2, {
                    yPercent: -100,
                    xPercent: -50,
                    rotate: 180,
                    scrollTrigger: {
                        trigger: $refs.feature_2,
                        scrub: 1.5,
                        start: 'top bottom-=200px',
                        end: 'bottom+=300px center',
                    },
                })
                gsap.to($refs.geometric_shape_3, {
                    yPercent: -100,
                    xPercent: -30,
                    rotate: 100,
                    scrollTrigger: {
                        trigger: $refs.feature_3,
                        scrub: 1.5,
                        start: 'top bottom-=200px',
                        end: 'bottom+=300px center',
                    },
                })
                gsap.to($refs.geometric_shape_4, {
                    yPercent: -100,
                    xPercent: -30,
                    rotate: 100,
                    scrollTrigger: {
                        trigger: $refs.feature_4,
                        scrub: 1.5,
                        start: 'top bottom-=200px',
                        end: 'bottom+=300px center',
                    },
                })
                gsap.to($refs.geometric_shape_5, {
                    yPercent: -100,
                    xPercent: -50,
                    rotate: 100,
                    scrollTrigger: {
                        trigger: $refs.feature_5,
                        scrub: 1.5,
                        start: 'top bottom-=200px',
                        end: 'bottom+=300px center',
                    },
                })
            })"
                class=" group/header flex flex-col md:flex-row md:gap-0 lg:justify-between" x-cloak
                x-data="{}">
                <!-- Section Texte -->
                <div class="flex-1 flex flex-col justify-center mb-12" x-ref="header">
                    <div class=" font-extrabold " x-ref="header_introducing">
                        <span class="text-accent-content text-6xl" x-ref="header_features">
                            {{ $settings->getName() }}
                        </span>
                        <br>

                        <span x-ref="header_new" class="text-4xl">
                            {{ $settings->getTitleJob() }}
                        </span>
                    </div>

                    <div class="min-w-[18rem] max-w-[30rem] pt-7 text-dolphin text-lg" x-ref="header_version4">
                        {!! str($settings->getBio())->markdown()->sanitizeHtml() !!}
                        <br />
                    </div>
                    {{-- Nos links-social --}}
                    <livewire:home.links-social />
                    {{-- hero-button --}}
                    <livewire:home.hero-button />
                </div>
                <!-- Section Image -->
                <livewire:home.hero-image />
            </div>
        </div>
        {{-- Nos projects --}}
        <livewire:home.project />
    </div>
    {{-- home-section --}}
    <livewire:home.home-section />
</div>
