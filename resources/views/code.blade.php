<!DOCTYPE html>
<html lang="en" class="scrollbar-thin">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plugins - Filament</title>
    <meta name="description"
        content="Extend your Filament projects with community-built plugins, from new field types to themes and starter kits." />


    <meta property="og:type" content="website" />
    <meta property="og:title" content="Plugins - Filament" />
    <meta property="og:description"
        content="Extend your Filament projects with community-built plugins, from new field types to themes and starter kits." />
    <meta property="og:image" content="https://filamentphp.com/og/plugins.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Plugins - Filament" />
    <meta name="twitter:description"
        content="Extend your Filament projects with community-built plugins, from new field types to themes and starter kits." />
    <meta name="twitter:image" content="https://filamentphp.com/og/plugins.png" />


    <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png?v=6bT7Ed2SVA" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg?v=6bT7Ed2SVA" />
    <link rel="shortcut icon" href="/favicon/favicon.ico?v=6bT7Ed2SVA" />
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png?v=6bT7Ed2SVA" />
    <meta name="apple-mobile-web-app-title" content="Filament" />
    <link rel="manifest" href="/favicon/site.webmanifest?v=6bT7Ed2SVA" />


    <link rel="preload" as="font" type="font/woff2"
        href="https://filamentphp.com/build/assets/albert-sans-latin-wght-normal-BJ0ssN8N.woff2" crossorigin />
    <link rel="preload" as="font" type="font/woff2"
        href="https://filamentphp.com/build/assets/outfit-latin-wght-normal-Bc-8i84L.woff2" crossorigin />


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Livewire Styles -->
    <style>
        [wire\:loading][wire\:loading],
        [wire\:loading\.delay][wire\:loading\.delay],
        [wire\:loading\.list-item][wire\:loading\.list-item],
        [wire\:loading\.inline-block][wire\:loading\.inline-block],
        [wire\:loading\.inline][wire\:loading\.inline],
        [wire\:loading\.block][wire\:loading\.block],
        [wire\:loading\.flex][wire\:loading\.flex],
        [wire\:loading\.table][wire\:loading\.table],
        [wire\:loading\.grid][wire\:loading\.grid],
        [wire\:loading\.inline-flex][wire\:loading\.inline-flex] {
            display: none;
        }

        [wire\:loading\.delay\.none][wire\:loading\.delay\.none],
        [wire\:loading\.delay\.shortest][wire\:loading\.delay\.shortest],
        [wire\:loading\.delay\.shorter][wire\:loading\.delay\.shorter],
        [wire\:loading\.delay\.short][wire\:loading\.delay\.short],
        [wire\:loading\.delay\.default][wire\:loading\.delay\.default],
        [wire\:loading\.delay\.long][wire\:loading\.delay\.long],
        [wire\:loading\.delay\.longer][wire\:loading\.delay\.longer],
        [wire\:loading\.delay\.longest][wire\:loading\.delay\.longest] {
            display: none;
        }

        [wire\:offline][wire\:offline] {
            display: none;
        }

        [wire\:dirty]:not(textarea):not(input):not(select) {
            display: none;
        }

        :root {
            --livewire-progress-bar-color: #2299dd;
        }

        [x-cloak] {
            display: none !important;
        }

        [wire\:cloak] {
            display: none !important;
        }

        dialog#livewire-error::backdrop {
            background-color: rgba(0, 0, 0, .6);
        }
    </style>
    <link rel="preload" as="style" href="https://filamentphp.com/build/assets/app-DzipoCla.css" />
    <link rel="stylesheet" href="https://filamentphp.com/build/assets/app-DzipoCla.css" data-navigate-track="reload" />
</head>

<body x-data="{
    showMobileMenu: false,
    navMediaQuery: window.matchMedia(
        '(min-width: ' +
        (getComputedStyle(document.documentElement)
            .getPropertyValue('--breakpoint-nav')
            .trim() || '50rem') +
        ')',
    ),
}"
    x-resize="
            if (navMediaQuery.matches) {
                showMobileMenu = false
            }
        "
    :class="{
        'overflow-hidden': showMobileMenu,
    }"
    class="bg-dots-pattern min-h-screen bg-[#faf9f5] bg-repeat font-albert-sans text-stone-600 antialiased selection:bg-stone-400/20 sm:px-5 lg:px-10">
    <main class="mx-auto w-full max-w-350 overflow-x-clip border-x border-b border-bone-100 bg-serenade-50">
        <nav class="sticky top-0 z-100 border-b border-bone-100 bg-serenade-50">
            <header data-triangle-decoration="bottom" class="flex h-16 w-full items-stretch justify-between nav:gap-3">

                <div class="flex w-22 items-stretch border-r border-bone-100 min-[370px]:w-25 2xs:w-30 nav:hidden">
                    <a href="/docs" aria-label="Open Filament documentation"
                        class="flex w-full items-center justify-center px-3.5 transition-all duration-300 ease-out hover:bg-bone-100/30 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset">
                        Docs
                    </a>
                </div>


                <div class="flex grow items-stretch nav:grow-0">

                    <a href="https://filamentphp.com" aria-label="Filament homepage"
                        class="group grid w-full grow place-items-center border-r border-bone-100 px-1 pb-0.5 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset min-[370px]:px-3.5">
                        <style>
                            [data-logo-pre-init] .logoLightBulb,
                            [data-logo-pre-init] .logoF2 {
                                opacity: 0 !important;
                            }

                            [data-logo-pre-init] .logoF1 {
                                translate: 8px;
                            }

                            [data-logo-pre-init] .logoI {
                                translate: -2px;
                            }

                            [data-logo-pre-init] .logoIDot {
                                translate: -2px;
                            }

                            [data-logo-pre-init] .logoL {
                                translate: -11px;
                            }

                            [data-logo-pre-init] .logoA {
                                translate: -11px;
                            }

                            [data-logo-pre-init] .logoM {
                                translate: -10px;
                            }

                            [data-logo-pre-init] .logoE {
                                translate: -9px;
                            }

                            [data-logo-pre-init] .logoN {
                                translate: -9px;
                            }

                            [data-logo-pre-init] .logoT {
                                translate: -8px;
                            }
                        </style>

                        <div class="relative top-1.25" data-logo-pre-init x-init="() => {
                            const logoInitialAnimation = $el.querySelectorAll('.logoInitialAnimation')
                            const logoLightBulb = $el.querySelectorAll('.logoLightBulb')
                            const logoF1 = $el.querySelectorAll('.logoF1')
                            const logoF2 = $el.querySelectorAll('.logoF2')
                            const logoI = $el.querySelector('.logoI')
                            const logoIDot = $el.querySelector('.logoIDot')
                            const logoL = $el.querySelector('.logoL')
                            const logoA = $el.querySelector('.logoA')
                            const logoM = $el.querySelector('.logoM')
                            const logoE = $el.querySelector('.logoE')
                            const logoN = $el.querySelector('.logoN')
                            const logoT = $el.querySelector('.logoT')
                            let isInitialAnimationComplete = false
                            const isReversed = false

                            if (isReversed) {
                                gsap.set(logoLightBulb, {
                                    opacity: 1,
                                    y: 0,
                                    scale: 1,
                                    transformOrigin: '50% 50%',
                                })
                                gsap.set(logoF1, { x: 0, opacity: 0 })
                                gsap.set(logoF2, { x: 0, opacity: 1 })
                                gsap.set(logoI, { x: 0, opacity: 0 })
                                gsap.set(logoIDot, { x: 0, opacity: 0 })
                                gsap.set(logoL, { x: 0 })
                                gsap.set(logoA, { x: 0 })
                                gsap.set(logoM, { x: 0 })
                                gsap.set(logoE, { x: 0 })
                                gsap.set(logoN, { x: 0 })
                                gsap.set(logoT, { x: 0 })
                            } else {
                                gsap.set(logoLightBulb, {
                                    opacity: 0,
                                    y: -2,
                                    scale: 0.5,
                                    transformOrigin: '50% 50%',
                                })
                                gsap.set(logoF1, { x: 8 })
                                gsap.set(logoF2, { x: 8, opacity: 0 })
                                gsap.set(logoI, { x: -2 })
                                gsap.set(logoIDot, { x: -2 })
                                gsap.set(logoL, { x: -11 })
                                gsap.set(logoA, { x: -11 })
                                gsap.set(logoM, { x: -10 })
                                gsap.set(logoE, { x: -9 })
                                gsap.set(logoN, { x: -9 })
                                gsap.set(logoT, { x: -8 })
                            }

                            $el.removeAttribute('data-logo-pre-init')
                            isInitialAnimationComplete = true

                            let animation

                            if (isReversed) {
                                animation = gsap
                                    .timeline({ paused: true })
                                    .to(
                                        logoLightBulb, {
                                            opacity: 0,
                                            y: -2,
                                            scale: 0.5,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoF1, {
                                            x: 8,
                                            rotation: 0,
                                            opacity: 1,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoF2, {
                                            x: 8,
                                            rotation: 0,
                                            opacity: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoI, {
                                            x: -2,
                                            opacity: 1,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                        },
                                        0,
                                    )
                                    .to(
                                        logoIDot, {
                                            x: -2,
                                            opacity: 1,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                        },
                                        0,
                                    )
                                    .to(
                                        logoL, {
                                            x: -11,
                                            rotation: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoA, {
                                            x: -11,
                                            rotation: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0.02,
                                    )
                                    .to(
                                        logoM, {
                                            x: -10,
                                            rotation: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0.04,
                                    )
                                    .to(
                                        logoE, {
                                            x: -9,
                                            rotation: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0.06,
                                    )
                                    .to(
                                        logoN, {
                                            x: -9,
                                            rotation: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0.08,
                                    )
                                    .to(
                                        logoT, {
                                            x: -8,
                                            rotation: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0.1,
                                    )
                            } else {
                                animation = gsap
                                    .timeline({ paused: true })
                                    .to(
                                        logoLightBulb, {
                                            opacity: 1,
                                            y: 0,
                                            scale: 1,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoF1, {
                                            x: 0,
                                            rotation: 0,
                                            opacity: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoF2, {
                                            x: 0,
                                            rotation: 0,
                                            opacity: 1,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                                    .to(
                                        logoI, {
                                            x: 0,
                                            color: '#efaf5d',
                                            opacity: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                        },
                                        0,
                                    )
                                    .to(
                                        logoIDot, {
                                            x: 0,
                                            color: '#efaf5d',
                                            opacity: 0,
                                            duration: 0.4,
                                            ease: 'sine.inOut',
                                        },
                                        0,
                                    )
                                    .to(
                                        [logoL, logoA, logoM, logoE, logoN, logoT], {
                                            x: 0,
                                            rotation: 0,
                                            duration: 0.4,
                                            stagger: 0.02,
                                            ease: 'sine.inOut',
                                            keyframes: {
                                                rotation: [0, -10, 0],
                                                easeEach: 'sine.inOut',
                                            },
                                        },
                                        0,
                                    )
                            }

                            motion.hover($el, () => {
                                if (!isInitialAnimationComplete) {
                                    return
                                }
                                animation.play()

                                return () => {
                                    if (!isInitialAnimationComplete) {
                                        return
                                    }
                                    animation.reverse()
                                }
                            })
                        }">
                            <svg class="h-10" viewBox="0 0 144 43" version="1.1" xmlns="http://www.w3.org/2000/svg">

                                <path class="logoInitialAnimation logoF1 fill-cocoa"
                                    d="M7.223,12.685L7.223,11.42C7.223,9.471 7.871,8.001 9.813,8.001L11.55,8.001L11.55,4L9.813,4C5.349,4 3.033,6.769 3.033,11.42L3.033,12.685L0,12.685L0,16.035L3.033,16.035L3.033,28.651L7.223,28.651L7.223,16.035L12.348,16.035L12.348,12.685L7.223,12.685Z" />

                                <path class="logoF2 fill-cocoa"
                                    d="M9.772,8.012L12.283,8.012C12.809,6.58 13.529,5.243 14.407,4.03L9.772,4.03C5.327,4.03 3.02,6.787 3.02,11.416L3.02,12.676L0,12.676L0,16.011L3.02,16.011L3.02,28.571L7.194,28.571L7.194,16.011L11.426,16.011C11.324,15.268 11.267,14.511 11.267,13.74C11.267,13.382 11.282,13.028 11.305,12.676L7.194,12.676L7.194,11.416C7.194,9.476 7.839,8.012 9.772,8.012" />

                                <g transform="matrix(1,0,0,1,0.214531,-0.010962)">
                                    <path class="logoInitialAnimation logoI fill-cocoa"
                                        d="M27.909,12.766L28.056,11.476L25.39,11.554L25.406,11.654C25.43,11.8 25.41,11.976 25.388,12.162C25.344,12.545 25.293,12.98 25.642,13.278C25.763,13.38 26.155,13.601 26.579,13.844C26.846,13.997 27.188,14.19 27.358,14.301C27.25,14.337 27.091,14.333 26.942,14.325C26.845,14.319 26.746,14.313 26.656,14.321L26.527,14.329C26.105,14.357 25.731,14.384 25.614,14.44C25.411,14.537 25.35,14.963 25.379,15.308C25.393,15.481 25.454,15.885 25.723,16.056L27.356,17.047L25.64,17.201L25.607,17.211C25.439,17.295 25.422,17.661 25.423,17.855C25.423,18.173 25.496,18.582 25.716,18.77L27.404,19.805C27.34,19.806 27.276,19.809 27.212,19.81C26.661,19.824 26.087,19.844 25.58,19.991L25.553,20.005C25.426,20.1 25.423,20.764 25.518,21.135C25.572,21.349 25.66,21.467 25.757,21.527L27.408,22.526L25.756,22.678L25.725,22.686C25.376,22.852 25.512,23.777 25.602,24.048L25.616,24.092L27.479,25.289L25.831,25.401C25.719,25.406 25.664,25.468 25.621,25.525C25.485,25.705 25.496,26.429 25.524,27.426C25.538,27.916 25.551,28.379 25.52,28.568L25.498,28.709L27.883,28.717L27.895,27.157L30.718,26.868L30.742,26.865L30.761,26.852C30.861,26.76 30.903,26.505 30.904,26.318C30.905,26.172 30.894,25.621 30.715,25.424L28.93,24.298L30.712,24.133L30.732,24.118C30.879,24.008 30.898,23.375 30.8,22.99C30.738,22.751 30.648,22.585 30.522,22.531L28.874,21.527C29.036,21.519 29.206,21.514 29.381,21.51C29.777,21.5 30.188,21.489 30.531,21.418C30.652,21.392 30.739,21.291 30.788,21.115C30.888,20.759 30.811,20.157 30.643,19.925C30.564,19.815 30.216,19.606 29.376,19.131C29.128,18.991 28.896,18.845 28.772,18.768C28.904,18.762 29.074,18.76 29.25,18.759C29.976,18.752 30.514,18.738 30.662,18.584C30.778,18.464 30.832,17.878 30.727,17.478C30.671,17.262 30.592,17.109 30.474,17.054L28.826,16.048L30.491,15.909L30.524,15.9C30.725,15.798 30.76,15.321 30.735,15.029C30.718,14.828 30.655,14.456 30.428,14.308" />
                                </g>

                                <g transform="matrix(0.995789,0,0,0.995652,0.338179,0.317612)">
                                    <path class="logoInitialAnimation logoIDot fill-cocoa"
                                        d="M27.694,5C26.228,5 25,6.095 25,7.498C25,8.901 26.228,10.029 27.694,10.029C29.159,10.029 30.319,8.934 30.319,7.498C30.319,6.061 29.126,5 27.694,5Z" />
                                </g>


                                <rect class="logoInitialAnimation logoL fill-cocoa" x="44.27" y="4.029" width="4.139"
                                    height="24.542" />

                                <path class="logoInitialAnimation logoA fill-cocoa"
                                    d="M59.517,24.895C57.243,24.895 55.139,23.159 55.139,20.606C55.139,18.052 57.243,16.317 59.517,16.317C61.791,16.317 63.86,17.848 63.86,20.606C63.86,23.363 61.757,24.895 59.517,24.895ZM63.86,14.649C62.706,12.879 60.365,12.335 58.94,12.335C54.766,12.335 50.864,15.5 50.864,20.606C50.864,25.711 54.766,28.877 58.94,28.877C60.501,28.877 62.842,28.162 63.86,26.528L63.86,28.571L67.999,28.571L67.999,12.675L63.86,12.675L63.86,14.649Z" />

                                <path class="logoInitialAnimation logoM fill-cocoa"
                                    d="M89.815,12.335C88.56,12.335 86.32,12.709 84.827,15.331C83.945,13.39 82.282,12.505 79.772,12.369C78.278,12.369 76.106,13.084 75.225,15.024L75.225,12.676L71.085,12.676L71.085,28.572L75.225,28.572L75.225,20.096C75.225,17.374 76.853,16.386 78.55,16.386C80.247,16.386 81.434,17.611 81.468,19.824L81.468,28.571L85.608,28.571L85.608,20.096C85.608,17.679 86.965,16.385 88.832,16.385C90.528,16.385 91.818,17.645 91.818,19.925L91.818,28.571L95.924,28.571L95.924,19.483C95.924,14.819 93.65,12.335 89.816,12.335" />

                                <path class="logoInitialAnimation logoE fill-cocoa"
                                    d="M102.121,19.176C102.427,17.031 104.123,15.806 106.295,15.806C108.331,15.806 109.959,16.997 110.265,19.176L102.121,19.176ZM106.261,12.335C101.748,12.335 98.05,15.569 98.05,20.572C98.05,25.576 101.748,28.912 106.261,28.912C109.179,28.912 112.233,27.788 113.658,25.065C112.64,24.52 111.487,23.908 110.503,23.363C109.757,24.725 108.128,25.406 106.533,25.406C104.192,25.406 102.427,24.112 102.156,22.002L114.235,22.002C114.269,21.628 114.303,20.981 114.303,20.573C114.303,15.569 110.775,12.335 106.262,12.335" />

                                <path class="logoInitialAnimation logoN fill-cocoa"
                                    d="M125.97,12.335C124.137,12.335 122.135,13.322 121.253,15.023L121.253,12.675L117.113,12.675L117.113,28.571L121.253,28.571L121.253,20.096C121.253,17.338 122.848,16.385 124.714,16.385C126.579,16.385 127.734,17.61 127.734,19.925L127.734,28.571L131.874,28.571L131.874,19.176C131.874,14.682 129.668,12.334 125.97,12.334" />

                                <path class="logoInitialAnimation logoT fill-cocoa"
                                    d="M136.535,6.616L136.535,12.675L133.65,12.675L133.65,16.011L136.535,16.011L136.535,28.571L140.641,28.571L140.641,16.011L144,16.011L144,12.675L140.641,12.675L140.641,6.616L136.535,6.616Z" />

                                <path class="logoLightBulb fill-honey-200"
                                    d="M25.233,7.782C25.233,9.213 26.455,10.303 27.915,10.303C29.375,10.303 30.53,9.213 30.53,7.782C30.53,6.352 29.341,5.296 27.915,5.296C26.489,5.296 25.233,6.386 25.233,7.782Z" />

                                <path class="logoLightBulb fill-honey-200"
                                    d="M33.7,1.323C30.892,-0.035 27.654,-0.361 24.586,0.407C22.56,0.916 20.657,1.909 19.088,3.277C18.809,3.513 18.539,3.765 18.277,4.029C17.4,4.915 16.623,5.955 15.965,7.135C15.802,7.423 15.652,7.715 15.511,8.011C14.805,9.496 14.374,11.08 14.241,12.674C14.211,13.046 14.194,13.419 14.195,13.792C14.185,14.526 14.244,15.266 14.368,16.01C14.511,16.859 14.736,17.712 15.051,18.56C15.565,19.922 16.262,21.168 16.929,22.322C17.603,23.527 18.154,24.541 18.648,25.566C19.044,26.406 19.395,27.283 19.698,28.178C19.796,28.469 19.889,28.762 19.977,29.057L20.155,29.691C20.299,30.209 20.577,30.648 20.957,30.959C21.656,31.533 22.585,31.667 23.464,31.308L25.825,30.177L28.861,28.723L28.786,27.072L30.929,26.852L30.953,26.85L30.971,26.837C31.092,26.751 31.113,26.425 31.114,26.24C31.115,26.094 31.105,25.604 30.928,25.408L29.139,24.285L30.922,24.119L30.941,24.105C31.088,23.996 31.107,23.333 31.008,22.95C30.948,22.712 30.845,22.56 30.72,22.507L29.086,21.516C29.248,21.507 29.416,21.503 29.59,21.498C29.985,21.488 30.393,21.478 30.736,21.406C30.857,21.381 30.944,21.279 30.993,21.104C31.092,20.75 31.021,20.131 30.855,19.901C30.775,19.791 30.413,19.576 29.577,19.103C29.33,18.963 29.096,18.831 28.973,18.754C29.105,18.748 29.273,18.747 29.448,18.745C30.171,18.738 30.696,18.723 30.862,18.584C31,18.469 31.042,17.837 30.938,17.438C30.881,17.224 30.787,17.083 30.67,17.029L29.036,16.038L30.701,15.899L30.735,15.889C30.934,15.789 30.97,15.291 30.946,15.001C30.929,14.801 30.867,14.444 30.642,14.296L28.125,12.755L28.271,11.465L25.604,11.543L25.621,11.643C25.644,11.788 25.624,11.963 25.602,12.149C25.559,12.531 25.509,12.963 25.856,13.259C25.976,13.361 26.375,13.59 26.797,13.831C27.063,13.984 27.406,14.18 27.575,14.29C27.467,14.327 27.315,14.318 27.167,14.31C27.071,14.304 26.971,14.299 26.882,14.306L26.754,14.314C26.334,14.342 25.946,14.371 25.829,14.426C25.627,14.522 25.565,14.936 25.594,15.281C25.608,15.454 25.669,15.873 25.937,16.043L27.573,17.036L25.859,17.187L25.825,17.197C25.658,17.281 25.634,17.616 25.634,17.809C25.634,18.125 25.706,18.558 25.924,18.745L27.619,19.793C27.556,19.794 27.492,19.797 27.429,19.798C26.879,19.812 26.31,19.827 25.805,19.973L25.778,19.987C25.652,20.082 25.643,20.734 25.731,21.104C25.784,21.327 25.874,21.47 25.986,21.523L27.623,22.515L25.973,22.666L25.942,22.674C25.594,22.84 25.725,23.76 25.814,24.029L25.828,24.073L27.694,25.278L26.048,25.389C25.936,25.395 25.881,25.457 25.838,25.513C25.736,25.649 25.716,26.064 25.725,26.687L22.928,28.121C22.526,26.781 22.026,25.473 21.44,24.227C20.905,23.117 20.325,22.049 19.616,20.782C18.982,19.686 18.377,18.607 17.949,17.469C17.494,16.244 17.272,15.013 17.289,13.806C17.281,12.04 17.755,10.261 18.66,8.658C19.335,7.45 20.154,6.435 21.099,5.635C22.315,4.575 23.78,3.809 25.335,3.418C25.403,3.4 25.471,3.386 25.539,3.371L25.601,3.358C27.314,2.978 29.114,3.038 30.807,3.528C31.353,3.686 31.877,3.886 32.366,4.122C34.263,5.023 35.908,6.558 36.999,8.449C38.197,10.474 38.699,12.799 38.413,14.999C38.278,16.152 37.912,17.369 37.328,18.611C37.019,19.238 36.663,19.862 36.318,20.466C36.1,20.849 35.882,21.233 35.67,21.623C35.027,22.81 33.998,25.213 33.66,26.003C33.6,26.143 33.562,26.233 33.546,26.266C33.191,27.089 32.681,28.272 32.517,28.649L29.277,30.223L22.526,33.501C21.759,33.811 21.307,34.598 21.426,35.422C21.542,36.23 22.207,36.854 23.065,36.954L27.329,37.104L21.883,40.192L23.155,42.998L34.252,37.646C35.135,37.238 35.527,36.211 35.146,35.309C34.893,34.709 34.312,34.295 33.63,34.228L29.608,33.244L34.727,31.075C34.852,31.018 34.859,31.013 36.174,27.988C36.234,27.849 36.296,27.705 36.362,27.553C36.363,27.551 36.374,27.525 36.394,27.479C36.797,26.527 37.799,24.195 38.388,23.107C38.582,22.747 38.784,22.392 38.987,22.038L39.004,22.009C39.355,21.395 39.752,20.699 40.115,19.961C40.849,18.399 41.31,16.857 41.483,15.382C41.856,12.51 41.211,9.489 39.667,6.877C38.271,4.459 36.15,2.487 33.699,1.321" />
                            </svg>
                        </div>
                    </a>


                    <nav class="hidden items-center gap-2 pl-3.5 nav:flex">
                        <div>
                            <a x-data="{ isActive: false }" href="https://filamentphp.com"
                                class="group relative inline-grid place-items-center px-2 py-1.5 transition-all duration-300 ease-out will-change-transform focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset hover:font-medium hover:text-stone-800"
                                x-init="() => {
                                    const animation = gsap.timeline({ paused: true })

                                    animation
                                        .fromTo(
                                            $refs['navbar-link-top-left'], { x: -15, y: -15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                        )
                                        .fromTo(
                                            $refs['navbar-link-bottom-right'], { x: 15, y: 15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                            '<',
                                        )
                                        .to(
                                            $refs['navbar-link-label'], {
                                                scale: 0.9,
                                                duration: 0.35,
                                                ease: 'sine.out',
                                            },
                                            0,
                                        )

                                    if (!isActive) {
                                        motion.hover($el, () => {
                                            animation.play()

                                            return () => {
                                                animation.reverse()
                                            }
                                        })
                                    } else {
                                        animation.progress(1)
                                    }
                                }">
                                <div class="absolute top-0 left-0 opacity-0" x-ref="navbar-link-top-left"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 text-amber-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span x-ref="navbar-link-label" class="flex items-center gap-1.5 whitespace-nowrap">
                                    Home

                                </span>

                                <div class="absolute right-0 bottom-0 opacity-0" x-ref="navbar-link-bottom-right"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 -scale-x-100 -scale-y-100 text-blue-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a x-data="{ isActive: true }" href="https://filamentphp.com/plugins" aria-current="page"
                                class="group relative inline-grid place-items-center px-2 py-1.5 transition-all duration-300 ease-out will-change-transform focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset font-medium text-stone-800"
                                x-init="() => {
                                    const animation = gsap.timeline({ paused: true })

                                    animation
                                        .fromTo(
                                            $refs['navbar-link-top-left'], { x: -15, y: -15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                        )
                                        .fromTo(
                                            $refs['navbar-link-bottom-right'], { x: 15, y: 15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                            '<',
                                        )
                                        .to(
                                            $refs['navbar-link-label'], {
                                                scale: 0.9,
                                                duration: 0.35,
                                                ease: 'sine.out',
                                            },
                                            0,
                                        )

                                    if (!isActive) {
                                        motion.hover($el, () => {
                                            animation.play()

                                            return () => {
                                                animation.reverse()
                                            }
                                        })
                                    } else {
                                        animation.progress(1)
                                    }
                                }">
                                <div class="absolute top-0 left-0" x-ref="navbar-link-top-left" :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 text-amber-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span x-ref="navbar-link-label" class="flex items-center gap-1.5 whitespace-nowrap"
                                    style="transform: scale(0.9)">
                                    Plugins

                                </span>

                                <div class="absolute right-0 bottom-0" x-ref="navbar-link-bottom-right"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 -scale-x-100 -scale-y-100 text-blue-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a x-data="{ isActive: false }" href="https://filamentphp.com/insights"
                                class="group relative inline-grid place-items-center px-2 py-1.5 transition-all duration-300 ease-out will-change-transform focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset hover:font-medium hover:text-stone-800"
                                x-init="() => {
                                    const animation = gsap.timeline({ paused: true })

                                    animation
                                        .fromTo(
                                            $refs['navbar-link-top-left'], { x: -15, y: -15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                        )
                                        .fromTo(
                                            $refs['navbar-link-bottom-right'], { x: 15, y: 15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                            '<',
                                        )
                                        .to(
                                            $refs['navbar-link-label'], {
                                                scale: 0.9,
                                                duration: 0.35,
                                                ease: 'sine.out',
                                            },
                                            0,
                                        )

                                    if (!isActive) {
                                        motion.hover($el, () => {
                                            animation.play()

                                            return () => {
                                                animation.reverse()
                                            }
                                        })
                                    } else {
                                        animation.progress(1)
                                    }
                                }">
                                <div class="absolute top-0 left-0 opacity-0" x-ref="navbar-link-top-left"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 text-amber-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span x-ref="navbar-link-label" class="flex items-center gap-1.5 whitespace-nowrap">
                                    Insights

                                </span>

                                <div class="absolute right-0 bottom-0 opacity-0" x-ref="navbar-link-bottom-right"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 -scale-x-100 -scale-y-100 text-blue-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a x-data="{ isActive: false }" href="https://filamentphp.com/consulting"
                                class="group relative inline-grid place-items-center px-2 py-1.5 transition-all duration-300 ease-out will-change-transform focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset hover:font-medium hover:text-stone-800"
                                x-init="() => {
                                    const animation = gsap.timeline({ paused: true })

                                    animation
                                        .fromTo(
                                            $refs['navbar-link-top-left'], { x: -15, y: -15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                        )
                                        .fromTo(
                                            $refs['navbar-link-bottom-right'], { x: 15, y: 15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                            '<',
                                        )
                                        .to(
                                            $refs['navbar-link-label'], {
                                                scale: 0.9,
                                                duration: 0.35,
                                                ease: 'sine.out',
                                            },
                                            0,
                                        )

                                    if (!isActive) {
                                        motion.hover($el, () => {
                                            animation.play()

                                            return () => {
                                                animation.reverse()
                                            }
                                        })
                                    } else {
                                        animation.progress(1)
                                    }
                                }">
                                <div class="absolute top-0 left-0 opacity-0" x-ref="navbar-link-top-left"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 text-amber-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span x-ref="navbar-link-label" class="flex items-center gap-1.5 whitespace-nowrap">
                                    Consulting

                                </span>

                                <div class="absolute right-0 bottom-0 opacity-0" x-ref="navbar-link-bottom-right"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 -scale-x-100 -scale-y-100 text-blue-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a x-data="{ isActive: false }" href="https://filamentphp.com/custom-dashboards-plugin"
                                class="group relative inline-grid place-items-center px-2 py-1.5 transition-all duration-300 ease-out will-change-transform focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset hover:font-medium hover:text-stone-800"
                                x-init="() => {
                                    const animation = gsap.timeline({ paused: true })

                                    animation
                                        .fromTo(
                                            $refs['navbar-link-top-left'], { x: -15, y: -15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                        )
                                        .fromTo(
                                            $refs['navbar-link-bottom-right'], { x: 15, y: 15, opacity: 0 }, {
                                                x: 0,
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.25,
                                                ease: 'circ.out',
                                            },
                                            '<',
                                        )
                                        .to(
                                            $refs['navbar-link-label'], {
                                                scale: 0.9,
                                                duration: 0.35,
                                                ease: 'sine.out',
                                            },
                                            0,
                                        )

                                    if (!isActive) {
                                        motion.hover($el, () => {
                                            animation.play()

                                            return () => {
                                                animation.reverse()
                                            }
                                        })
                                    } else {
                                        animation.progress(1)
                                    }
                                }">
                                <div class="absolute top-0 left-0 opacity-0" x-ref="navbar-link-top-left"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 text-amber-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>

                                <span x-ref="navbar-link-label" class="flex items-center gap-1.5 whitespace-nowrap">
                                    <span class="hidden lg:inline">Custom </span>Dashboards

                                    <div class="inline-flex items-center">
                                        <span
                                            class="relative inline-block overflow-hidden rounded-xs bg-honey-200 px-1.25 py-px font-roboto-mono text-xs font-medium tracking-wide text-cocoa uppercase"
                                            x-init="() => {
                                                const shine = $refs.shine

                                                const tween = gsap.fromTo(
                                                    shine, { x: '-100%', opacity: 1 }, {
                                                        x: '200%',
                                                        opacity: 0,
                                                        duration: 1.2,
                                                        ease: 'power2.inOut',
                                                        repeat: -1,
                                                        repeatDelay: 1,
                                                        paused: true,
                                                    },
                                                )

                                                motion.inView($el, () => {
                                                    tween.play()
                                                    return () => tween.pause()
                                                })
                                            }">
                                            New
                                            <span x-ref="shine"
                                                class="pointer-events-none absolute inset-y-0 -left-full w-full skew-x-[-20deg] bg-linear-to-r from-transparent via-white to-transparent"
                                                aria-hidden="true"></span>
                                        </span>
                                    </div>
                                </span>

                                <div class="absolute right-0 bottom-0 opacity-0" x-ref="navbar-link-bottom-right"
                                    :aria-hidden="true"
                                    :class="{
                                        'grayscale': !isActive,
                                    }">
                                    <svg class="h-2 -scale-x-100 -scale-y-100 text-blue-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </nav>
                </div>


                <div class="flex items-stretch">

                    <div class="hidden border-r border-bone-100 nav-github:flex">
                        <a href="https://github.com/filamentphp/filament" target="_blank" rel="noopener noreferrer"
                            aria-label="Open Filament GitHub repository"
                            class="group flex items-center gap-2.5 pr-3 pb-0.5 whitespace-nowrap transition-all duration-300 ease-out hover:pr-4 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                            x-init="() => {
                                const star = $refs.star
                                const sparks = $refs.sparksContainer.querySelectorAll('[data-spark]')

                                // Set initial state - sparks hidden
                                gsap.set(sparks, { opacity: 0 })

                                const hoverAnimation = gsap.timeline({ paused: true })

                                // Star bounce and fill
                                hoverAnimation.to(
                                    star, {
                                        scale: 1.25,
                                        duration: 0.2,
                                        ease: 'back.out(2)',
                                    },
                                    0,
                                )

                                // Sparks burst outward
                                sparks.forEach((spark, i) => {
                                    const angle = parseFloat(spark.dataset.angle) * (Math.PI / 180)
                                    const distance = 6

                                    hoverAnimation.fromTo(
                                        spark, {
                                            opacity: 1,
                                            '--spark-distance': '0px',
                                        }, {
                                            opacity: 0,
                                            '--spark-distance': distance + 'px',
                                            duration: 0.5,
                                            ease: 'power2.out',
                                            stagger: 0.5,
                                            immediateRender: false,
                                        },
                                        0.02 + i * 0.02,
                                    )
                                })

                                motion.hover($el, () => {
                                    hoverAnimation.restart()

                                    return () => {
                                        gsap.to(star, {
                                            scale: 1,
                                            rotation: 0,
                                            duration: 0.3,
                                            ease: 'power2.out',
                                        })
                                    }
                                })
                            }">
                            <div class="relative" x-ref="sparksContainer">
                                <svg x-ref="star"
                                    class="size-4 shrink-0 text-transparent transition-colors duration-300 ease-out [--icon-stroke:var(--color-stone-800)] group-hover:text-honey-200"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M8.08887 0.989258C8.31973 0.427753 9.07211 0.326095 9.44336 0.806641C9.4865 0.862481 9.52201 0.923989 9.54883 0.989258V0.991211L11.3418 5.33105L11.458 5.61328L11.7637 5.63867L16.4102 6.0127V6.01367C17.0215 6.06538 17.3475 6.75913 16.9971 7.2627C16.9591 7.31722 16.9145 7.36673 16.8643 7.41016L15.5156 8.57422L15.5205 8.57324L13.3232 10.4697L13.0938 10.668L13.1631 10.9629L14.2432 15.5381L14.2441 15.54C14.3864 16.1331 13.8328 16.6577 13.248 16.4844C13.1823 16.4648 13.1191 16.4371 13.0605 16.4014H13.0615L9.08301 13.9531L8.82031 13.792L8.55859 13.9531L4.5791 16.4004C4.05796 16.7169 3.38971 16.3508 3.37598 15.7412C3.37445 15.6735 3.38178 15.6059 3.39746 15.54V15.5391L4.48145 10.9629L4.55176 10.668L4.32129 10.4697L0.776367 7.41016C0.312197 7.00899 0.456622 6.25511 1.03613 6.05371C1.09645 6.03279 1.1591 6.01868 1.22266 6.0127L1.22363 6.01367L5.87305 5.63867L6.17773 5.61328L6.29492 5.33105L8.08789 0.991211L8.08887 0.989258Z"
                                        class="fill-current stroke-(--icon-stroke) [stroke-width:var(--stroke-width,1)]" />
                                </svg>


                                <div data-spark data-angle="-45"
                                    class="pointer-events-none absolute -top-1 -right-1 -rotate-45 opacity-0"
                                    style="
                                translate: calc(
                                        var(--spark-distance, 0px) * 0.707
                                    )
                                    calc(var(--spark-distance, 0px) * -0.707);
                            ">
                                    <div class="h-0.5 w-1.5 rounded-full bg-honey-200"></div>
                                </div>


                                <div data-spark data-angle="45"
                                    class="pointer-events-none absolute -right-1 -bottom-1 rotate-45 opacity-0"
                                    style="
                                translate: calc(
                                        var(--spark-distance, 0px) * 0.707
                                    )
                                    calc(var(--spark-distance, 0px) * 0.707);
                            ">
                                    <div class="h-0.5 w-1.5 rounded-full bg-honey-200"></div>
                                </div>


                                <div data-spark data-angle="-135"
                                    class="pointer-events-none absolute -top-1 -left-1 rotate-45 opacity-0"
                                    style="
                                translate: calc(
                                        var(--spark-distance, 0px) * -0.707
                                    )
                                    calc(var(--spark-distance, 0px) * -0.707);
                            ">
                                    <div class="h-0.5 w-1.5 rounded-full bg-honey-200"></div>
                                </div>


                                <div data-spark data-angle="135"
                                    class="pointer-events-none absolute -bottom-1 -left-1 -rotate-45 opacity-0"
                                    style="
                                translate: calc(
                                        var(--spark-distance, 0px) * -0.707
                                    )
                                    calc(var(--spark-distance, 0px) * 0.707);
                            ">
                                    <div class="h-0.5 w-1.5 rounded-full bg-honey-200"></div>
                                </div>
                            </div>
                            <div>
                                <div class="leading-5 font-semibold text-stone-800">
                                    31.5K+
                                </div>
                                <div class="text-sm">GitHub stars</div>
                            </div>
                        </a>
                    </div>

                    <div class="flex items-stretch">

                        <div class="hidden nav-search:flex">
                            <button type="button" x-on:click="$dispatch('open-search-modal')"
                                aria-label="Search the documentation"
                                class="group flex items-center gap-5 px-3.5 transition-all duration-300 ease-out hover:gap-6 hover:bg-bone-100/30 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                x-init="() => {
                                    const animation = gsap.timeline({ paused: true })
                                    animation.to($refs.circle, {
                                        keyframes: {
                                            scaleX: [1, 0, 1],
                                        },
                                        duration: 0.6,
                                        ease: 'circ.inOut',
                                    })
                                    motion.hover($el, () => {
                                        animation.play()

                                        return () => {
                                            animation.reverse()
                                        }
                                    })
                                }">
                                <div class="flex items-center gap-2">

                                    <div class="relative top-0.5 flex flex-col items-center justify-center">

                                        <div x-ref="circle"
                                            class="size-2.5 -rotate-45 rounded-full ring-1 ring-stone-800"></div>

                                        <div class="relative -top-0.5 left-1.25 h-1.5 w-px -rotate-45 bg-stone-800">
                                        </div>
                                    </div>
                                    <div>Search...</div>
                                </div>
                                <span class="hidden items-center gap-1 text-sm nav-expanded:flex">
                                    <span>
                                        Ctrl
                                    </span>
                                    <span
                                        class="-mx-1.5 opacity-0 transition-all duration-300 ease-out group-hover:-mx-0.5 group-hover:opacity-100">
                                        +
                                    </span>
                                    <span>K</span>
                                </span>
                            </button>
                        </div>


                        <svg class="-mx-px hidden h-full text-bone-300 nav-search:block"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 75" fill="none">
                            <path d="M0.5 0V75" stroke="currentColor" stroke-dasharray="6 6" />
                        </svg>


                        <div
                            class="hidden justify-center border-l border-bone-100 nav:flex nav:w-auto nav-github:border-l-0">
                            <a href="/docs" aria-label="Open Filament documentation"
                                class="flex w-full items-center justify-center gap-2.5 px-3.5 transition-all duration-300 ease-out hover:bg-bone-100/30 hover:px-4 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset nav:hover:gap-3">
                                <img src="https://filamentphp.com/build/assets/barney-C7Py5uPh.webp"
                                    alt="Barney, the Filament mascot" aria-hidden="true" width="20"
                                    height="32" fetchpriority="high" class="hidden w-5 -scale-x-100 nav:block" />
                                <span class="block nav-expanded:hidden">Docs</span>
                                <span class="hidden nav-expanded:block">
                                    Documentation
                                </span>
                            </a>
                        </div>
                    </div>


                    <div class="relative z-40 nav:hidden">

                        <button type="button" x-on:click="showMobileMenu = true"
                            class="grid h-full w-22 place-items-center overflow-hidden transition duration-300 ease-out hover:bg-bone-100/30 focus:ring-0 focus:outline-none min-[370px]:w-25 2xs:w-30 nav:hidden nav:w-auto"
                            aria-label="Open menu" aria-expanded="false" x-bind:aria-expanded="showMobileMenu">
                            <div>Menu</div>
                        </button>


                        <div x-show="showMobileMenu" x-cloak class="fixed inset-0 z-50 nav:hidden" role="dialog"
                            aria-modal="true" aria-labelledby="mobile-menu-title" x-trap.noscroll="showMobileMenu"
                            x-on:click.self="showMobileMenu = false" x-init="() => {
                                const overlay = $refs.overlay
                                const menuPanel = $refs.menuPanel
                                const closeBtn = $refs.closeBtn
                                const docsBtn = $refs.docsBtn
                                const navItems = $refs.navItems.children
                                const dragHandle = $refs.dragHandle
                                const badges = $refs.navItems.querySelectorAll('[data-badge]')
                                const plusDecoration = $refs.plusDecoration
                                const plusLines = $refs.plusDecoration.querySelectorAll('[data-plus-line]')
                                const plusSymbol = $refs.plusDecoration.querySelector('[data-plus-symbol]')
                                let draggableInstance = null

                                // Watch for menu state changes
                                $watch('showMobileMenu', (isOpen) => {
                                    if (isOpen) {
                                        // Opening animation
                                        const tl = gsap.timeline({
                                            onComplete: () => {
                                                // Initialize draggable after opening animation
                                                draggableInstance = Draggable.create(menuPanel, {
                                                    type: 'y',
                                                    trigger: dragHandle,
                                                    bounds: { minY: 0, maxY: window.innerHeight },
                                                    inertia: true,
                                                    onPress: function() {
                                                        // Animate drag handle to larger width
                                                        gsap.to(dragHandle.querySelector('div'), {
                                                            width: 72,
                                                            duration: 0.3,
                                                            ease: 'back.out(1.7)',
                                                        })
                                                    },
                                                    onDrag: function() {
                                                        // Update overlay opacity based on drag position
                                                        const dragProgress =
                                                            this.y / (window.innerHeight * 0.5)
                                                        const newOpacity = Math.max(0, 1 - dragProgress)
                                                        gsap.set(overlay, { opacity: newOpacity })

                                                        // Update drag handle fill based on drag distance
                                                        const maxDrag = 200 // Maximum drag distance for full fill
                                                        const fillProgress = Math.min(1, this.y / maxDrag)
                                                        const fillWidth = fillProgress * 100

                                                        gsap.set(dragHandle.querySelector('div'), {
                                                            background: `linear-gradient(to right, rgb(120 113 108) ${fillWidth}%, rgb(120 113 108 / 0.4) ${fillWidth}%)`,
                                                        })
                                                    },
                                                    onRelease: function() {
                                                        // Reset drag handle width and fill
                                                        gsap.to(dragHandle.querySelector('div'), {
                                                            width: 48,
                                                            background: 'rgb(120 113 108 / 0.4)',
                                                            duration: 0.3,
                                                            ease: 'power2.out',
                                                        })
                                                    },
                                                    onDragEnd: function() {
                                                        const threshold = 100

                                                        if (this.y > threshold) {
                                                            // Close menu if dragged down past threshold
                                                            showMobileMenu = false
                                                        } else {
                                                            // Snap back to original position
                                                            gsap.to(menuPanel, {
                                                                y: 0,
                                                                duration: 0.3,
                                                                ease: 'back.out(1.7)',
                                                            })
                                                            gsap.to(overlay, {
                                                                opacity: 1,
                                                                duration: 0.3,
                                                            })
                                                        }

                                                        // Ensure drag handle is reset
                                                        gsap.to(dragHandle.querySelector('div'), {
                                                            width: 48,
                                                            background: 'rgb(120 113 108 / 0.4)',
                                                            duration: 0.3,
                                                            ease: 'power2.out',
                                                        })
                                                    },
                                                })[0]
                                            },
                                        })

                                        // Animate overlay
                                        tl.fromTo(
                                            overlay, { opacity: 0 }, {
                                                opacity: 1,
                                                duration: 0.3,
                                                ease: 'power2.out',
                                            },
                                        )

                                        // Animate top buttons
                                        tl.fromTo(
                                            [closeBtn, docsBtn], {
                                                y: -20,
                                                opacity: 0,
                                            }, {
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.5,
                                                stagger: 0.1,
                                                ease: 'back.out(2)',
                                            },
                                            '<0.1',
                                        )

                                        // Animate menu panel from bottom
                                        tl.fromTo(
                                            menuPanel, {
                                                y: 100,
                                                opacity: 0,
                                            }, {
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.5,
                                                ease: 'back.out(1.7)',
                                            },
                                            '<0.1',
                                        )

                                        // Animate navigation items
                                        tl.fromTo(
                                            navItems, {
                                                y: 30,
                                                opacity: 0,
                                            }, {
                                                y: 0,
                                                opacity: 1,
                                                duration: 0.5,
                                                stagger: 0.08,
                                                ease: 'back.out(2)',
                                            },
                                            '<0.2',
                                        )

                                        // Animate you-are-here badges with pop-in effect
                                        if (badges.length > 0) {
                                            tl.fromTo(
                                                badges, {
                                                    scale: 0,
                                                    x: -10,
                                                    opacity: 0,
                                                }, {
                                                    scale: 1,
                                                    x: 0,
                                                    opacity: 1,
                                                    duration: 0.4,
                                                    stagger: 0.1,
                                                    ease: 'back.out(1.5)',
                                                },
                                                '<0.5',
                                            )
                                        }

                                        // Animate plus lines stretching from sides
                                        tl.fromTo(
                                            plusLines[0], {
                                                scaleX: 0,
                                                transformOrigin: 'right center',
                                            }, {
                                                scaleX: 1,
                                                duration: 0.5,
                                                ease: 'power2.out',
                                            },
                                            '<',
                                        )

                                        tl.fromTo(
                                            plusLines[1], {
                                                scaleX: 0,
                                                transformOrigin: 'left center',
                                            }, {
                                                scaleX: 1,
                                                duration: 0.5,
                                                ease: 'power2.out',
                                            },
                                            '<',
                                        )

                                        // Animate plus symbol with scale pop
                                        tl.fromTo(
                                            plusSymbol, {
                                                scale: 0,
                                                opacity: 0,
                                            }, {
                                                scale: 1,
                                                opacity: 1,
                                                duration: 0.4,
                                                ease: 'back.out(2.5)',
                                            },
                                            '<',
                                        )
                                    } else {
                                        // Kill draggable instance
                                        if (draggableInstance) {
                                            draggableInstance.kill()
                                            draggableInstance = null
                                        }

                                        // Closing animation
                                        const tl = gsap.timeline()

                                        // Animate plus symbol out
                                        tl.to(plusSymbol, {
                                            scale: 0,
                                            opacity: 0,
                                            duration: 0.2,
                                            ease: 'power2.in',
                                        })

                                        // Animate plus lines out
                                        tl.to(
                                            plusLines, {
                                                scaleX: 0,
                                                duration: 0.25,
                                                ease: 'power2.in',
                                            },
                                            '<0.1',
                                        )

                                        // Animate badges out first
                                        if (badges.length > 0) {
                                            tl.to(
                                                badges, {
                                                    scale: 0,
                                                    opacity: 0,
                                                    duration: 0.2,
                                                    stagger: 0.05,
                                                    ease: 'power2.in',
                                                },
                                                '<',
                                            )
                                        }

                                        // Animate nav items out
                                        tl.to(
                                            navItems, {
                                                y: 20,
                                                opacity: 0,
                                                duration: 0.25,
                                                stagger: 0.03,
                                                ease: 'power2.in',
                                            },
                                            '<',
                                        )

                                        // Animate menu panel out
                                        tl.to(
                                            menuPanel, {
                                                y: 50,
                                                opacity: 0,
                                                duration: 0.3,
                                                ease: 'power2.in',
                                            },
                                            '<',
                                        )

                                        // Animate buttons out
                                        tl.to(
                                            [closeBtn, docsBtn], {
                                                y: -15,
                                                opacity: 0,
                                                duration: 0.25,
                                                stagger: 0.05,
                                                ease: 'power2.in',
                                            },
                                            '<',
                                        )

                                        // Animate overlay out
                                        tl.to(
                                            overlay, {
                                                opacity: 0,
                                                duration: 0.2,
                                                ease: 'power2.in',
                                            },
                                            '<0.1',
                                        )
                                    }
                                })
                            }">

                            <div x-ref="overlay" x-on:click="showMobileMenu = false"
                                class="bg-dots-pattern absolute inset-0 bg-black/21 bg-repeat backdrop-blur-sm"
                                aria-hidden="true"></div>


                            <div class="pointer-events-none relative flex h-full flex-col px-5"
                                x-on:click="showMobileMenu = false">
                                <span id="mobile-menu-title" class="sr-only">
                                    Navigation menu
                                </span>


                                <div
                                    class="pointer-events-none absolute top-0 right-0 left-0 z-20 flex items-center justify-between px-5 py-4 text-sm">

                                    <div x-ref="docsBtn">
                                        <a href="https://github.com/filamentphp/filament" target="_blank"
                                            rel="noopener noreferrer" x-on:click="showMobileMenu = false"
                                            class="group pointer-events-auto flex h-10 w-23 items-center justify-center gap-1.5 overflow-hidden rounded-md bg-serenade-50 pr-3 pl-3.5 text-stone-800 transition-all duration-300 ease-out hover:w-35 hover:bg-cream-100 focus:outline-none">
                                            <svg class="size-4 shrink-0 text-transparent transition-all duration-300 ease-out [--icon-stroke:var(--color-stone-800)] group-hover:text-honey-200"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18"
                                                fill="none">
                                                <path
                                                    d="M8.08887 0.989258C8.31973 0.427753 9.07211 0.326095 9.44336 0.806641C9.4865 0.862481 9.52201 0.923989 9.54883 0.989258V0.991211L11.3418 5.33105L11.458 5.61328L11.7637 5.63867L16.4102 6.0127V6.01367C17.0215 6.06538 17.3475 6.75913 16.9971 7.2627C16.9591 7.31722 16.9145 7.36673 16.8643 7.41016L15.5156 8.57422L15.5205 8.57324L13.3232 10.4697L13.0938 10.668L13.1631 10.9629L14.2432 15.5381L14.2441 15.54C14.3864 16.1331 13.8328 16.6577 13.248 16.4844C13.1823 16.4648 13.1191 16.4371 13.0605 16.4014H13.0615L9.08301 13.9531L8.82031 13.792L8.55859 13.9531L4.5791 16.4004C4.05796 16.7169 3.38971 16.3508 3.37598 15.7412C3.37445 15.6735 3.38178 15.6059 3.39746 15.54V15.5391L4.48145 10.9629L4.55176 10.668L4.32129 10.4697L0.776367 7.41016C0.312197 7.00899 0.456622 6.25511 1.03613 6.05371C1.09645 6.03279 1.1591 6.01868 1.22266 6.0127L1.22363 6.01367L5.87305 5.63867L6.17773 5.61328L6.29492 5.33105L8.08789 0.991211L8.08887 0.989258Z"
                                                    class="fill-current stroke-(--icon-stroke) [stroke-width:var(--stroke-width,1)]" />
                                            </svg>
                                            <div
                                                class="relative transition-all duration-300 ease-out will-change-transform group-hover:pr-13">
                                                <div
                                                    class="transition duration-300 ease-out will-change-transform group-hover:-translate-y-1.5 group-hover:opacity-0">
                                                    31.5K+
                                                </div>
                                                <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                                    <div
                                                        class="translate-y-1.5 whitespace-nowrap opacity-0 transition duration-300 ease-out group-hover:translate-y-0 group-hover:opacity-100">
                                                        Star on GitHub
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                    <div x-ref="closeBtn">
                                        <button type="button" x-on:click="showMobileMenu = false"
                                            class="group pointer-events-auto flex h-10 items-center justify-center rounded-md bg-serenade-50 pr-3.5 pl-3 text-stone-800 transition duration-300 ease-out hover:bg-cream-100 focus:outline-none"
                                            aria-label="Close menu">
                                            <svg class="mr-1.25 size-3.5 shrink-0 transition duration-300 ease-out will-change-transform group-hover:rotate-90"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M18 6 6 18" />
                                                <path d="m6 6 12 12" />
                                            </svg>
                                            <span>Close</span>
                                            <span
                                                class="grid grid-cols-[0fr] transition-[grid-template-columns] duration-300 ease-out group-hover:grid-cols-[1fr]">
                                                <span class="overflow-hidden">
                                                    <span
                                                        class="ml-1 opacity-0 transition duration-300 ease-out group-hover:opacity-100">
                                                        menu
                                                    </span>
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>


                                <div class="pointer-events-none mt-auto flex justify-center pb-6">
                                    <nav x-ref="menuPanel"
                                        class="pointer-events-auto relative z-10 w-full rounded-xl bg-serenade-50"
                                        aria-label="Main navigation" x-on:click.stop>

                                        <div x-ref="dragHandle"
                                            class="-mt-5 flex cursor-grab touch-none flex-col items-center pt-8 pb-8 select-none active:cursor-grabbing"
                                            aria-label="Drag to close menu">
                                            <div class="h-1.25 w-12 rounded-full bg-stone-400/40"></div>
                                        </div>


                                        <ul x-ref="navItems"
                                            class="flex flex-col items-stretch px-5 text-center text-lg">
                                            <li>
                                                <a href="https://filamentphp.com" x-on:click="showMobileMenu = false"
                                                    class="block py-2 transition duration-300 ease-out hover:scale-110 hover:font-medium hover:text-stone-800">
                                                    <span class="relative inline-flex items-center gap-1.5">
                                                        Home


                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://filamentphp.com/plugins" aria-current="page"
                                                    x-on:click="showMobileMenu = false"
                                                    class="block py-2 transition duration-300 ease-out font-medium text-stone-800">
                                                    <span class="relative inline-flex items-center gap-1.5">
                                                        Plugins


                                                        <div class="pointer-events-none absolute -right-23.5 bottom-2.25 inline-flex flex-col gap-2"
                                                            data-badge style="opacity: 0; transform: scale(0)">
                                                            <div x-init="() => {
                                                                const tween = gsap.to($el, {
                                                                    keyframes: {
                                                                        y: [0, -5, 0],
                                                                        rotate: [0, -3, 3, 0],
                                                                    },
                                                                    duration: 1,
                                                                    repeat: -1,
                                                                    repeatDelay: 1,
                                                                    delay: 1.5,
                                                                    ease: 'bounce.inOut',
                                                                    paused: true,
                                                                })

                                                                motion.inView($el.closest('[data-badge]'), () => {
                                                                    tween.play()
                                                                    return () => tween.pause()
                                                                })
                                                            }">
                                                                <div
                                                                    class="ml-2.5 -rotate-5 rounded-tl-md rounded-tr-md rounded-br-md bg-stone-800 px-2 py-1 text-xs whitespace-nowrap text-stone-100">
                                                                    You're here
                                                                </div>
                                                            </div>
                                                            <div x-init="() => {
                                                                const tween = gsap.to($el, {
                                                                    keyframes: {
                                                                        y: [0, -5, 0],
                                                                    },
                                                                    duration: 1,
                                                                    repeat: -1,
                                                                    repeatDelay: 1,
                                                                    delay: 1.5,
                                                                    ease: 'bounce.inOut',
                                                                    paused: true,
                                                                })

                                                                motion.inView($el.closest('[data-badge]'), () => {
                                                                    tween.play()
                                                                    return () => tween.pause()
                                                                })
                                                            }">
                                                                <svg class="size-2 text-honey-200"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 8 8" fill="none">
                                                                    <path d="M4 0L8 4L4 8L0 4L4 0Z"
                                                                        class="fill-current" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://filamentphp.com/insights"
                                                    x-on:click="showMobileMenu = false"
                                                    class="block py-2 transition duration-300 ease-out hover:scale-110 hover:font-medium hover:text-stone-800">
                                                    <span class="relative inline-flex items-center gap-1.5">
                                                        Insights


                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://filamentphp.com/consulting"
                                                    x-on:click="showMobileMenu = false"
                                                    class="block py-2 transition duration-300 ease-out hover:scale-110 hover:font-medium hover:text-stone-800">
                                                    <span class="relative inline-flex items-center gap-1.5">
                                                        Consulting


                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://filamentphp.com/custom-dashboards-plugin"
                                                    x-on:click="showMobileMenu = false"
                                                    class="block py-2 transition duration-300 ease-out hover:scale-110 hover:font-medium hover:text-stone-800">
                                                    <span class="relative inline-flex items-center gap-1.5">
                                                        Custom Dashboards

                                                        <div class="inline-flex items-center">
                                                            <span
                                                                class="relative inline-block overflow-hidden rounded-xs bg-honey-200 px-1.25 py-px font-roboto-mono text-xs font-medium tracking-wide text-cocoa uppercase"
                                                                x-init="() => {
                                                                    const shine = $refs.shine

                                                                    const tween = gsap.fromTo(
                                                                        shine, { x: '-100%', opacity: 1 }, {
                                                                            x: '200%',
                                                                            opacity: 0,
                                                                            duration: 1.2,
                                                                            ease: 'power2.inOut',
                                                                            repeat: -1,
                                                                            repeatDelay: 1,
                                                                            paused: true,
                                                                        },
                                                                    )

                                                                    motion.inView($el, () => {
                                                                        tween.play()
                                                                        return () => tween.pause()
                                                                    })
                                                                }">
                                                                New
                                                                <span x-ref="shine"
                                                                    class="pointer-events-none absolute inset-y-0 -left-full w-full skew-x-[-20deg] bg-linear-to-r from-transparent via-white to-transparent"
                                                                    aria-hidden="true"></span>
                                                            </span>
                                                        </div>

                                                    </span>
                                                </a>
                                            </li>
                                        </ul>


                                        <div x-ref="plusDecoration" class="flex items-center gap-5 px-5 pt-3 pb-4">
                                            <div data-plus-line class="h-px w-full bg-bone-100"></div>
                                            <div data-plus-symbol class="text-sm text-bone-500">
                                                +
                                            </div>
                                            <div data-plus-line class="h-px w-full bg-bone-100"></div>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </nav>
        <div>
            <section data-triangle-decoration="bottom"
                class="flex flex-col items-center gap-x-10 gap-y-5 border-b border-bone-100 px-5 py-10 xs:px-8 sm:py-15 lg:flex-row lg:px-15">

                <div class="shrink-0 lg:mt-7 lg:-ml-5">
                    <img x-ref="heroImage" src="https://filamentphp.com/build/assets/sparky-plugins-Cld2EAuF.webp"
                        width="400" height="271" fetchpriority="high"
                        alt="Illustration of Sparky the dog holding a plugin piece" class="w-100" />
                </div>


                <div class="flex flex-col items-center gap-4 lg:items-start">

                    <header class="flex flex-col items-center gap-3 text-center md:gap-4 lg:items-start lg:text-left">
                        <h1>Plugins</h1>
                        <p data-section-description role="note" class="max-w-2xl">
                            Extend your Filament projects with community-built plugins, from
                            new field types to themes and starter kits.
                        </p>
                    </header>


                    <div class="flex flex-wrap items-center justify-center gap-3 lg:justify-start">

                        <div x-data data-button-pulse class="rounded-full bg-honey-200"
                            aria-label="Submit your plugin to Filament" x-init="async () => {
                                await window.FilamentAnimations.waitForFonts()

                                const button = $el.querySelector('a')
                                const textWrapper = button.querySelector('[data-text]')
                                const icon = button.querySelector('[data-icon] svg')
                                const hasCustomIcon = false
                                const hasCustomContent = false
                                const animateIcon = true

                                const tl = gsap.timeline({ paused: true })

                                // Only animate text if not using custom content
                                let chars = []
                                if (!hasCustomContent && textWrapper) {
                                    const split = new SplitText(textWrapper, { type: 'chars' })
                                    chars = split.chars
                                }

                                if (hasCustomIcon && animateIcon) {
                                    // Custom icon animation: subtle scale and lift
                                    tl.to(
                                        icon, {
                                            scale: 1.1,
                                            rotation: 0.01,
                                            duration: 0.3,
                                            ease: 'sine.out',
                                        },
                                        0,
                                    )
                                } else if (!hasCustomIcon) {
                                    // Arrow animation
                                    const direction = 'right'
                                    const distance = 30

                                    let xOut, yOut, xIn, yIn

                                    switch (direction) {
                                        case 'top-right':
                                            xOut = distance * Math.cos((-45 * Math.PI) / 180)
                                            yOut = distance * Math.sin((-45 * Math.PI) / 180)
                                            xIn = -xOut
                                            yIn = -yOut
                                            break
                                        case 'bottom-right':
                                            xOut = distance * Math.cos((45 * Math.PI) / 180)
                                            yOut = distance * Math.sin((45 * Math.PI) / 180)
                                            xIn = -xOut
                                            yIn = -yOut
                                            break
                                        case 'left':
                                            xOut = -distance
                                            yOut = 0
                                            xIn = -xOut
                                            yIn = 0
                                            break
                                        default:
                                            xOut = distance
                                            yOut = 0
                                            xIn = -distance
                                            yIn = 0
                                    }

                                    tl.to(
                                        icon, {
                                            keyframes: [
                                                { x: xOut, y: yOut, duration: 0.23, ease: 'power2.in' },
                                                { x: xIn, y: yIn, duration: 0 },
                                                { x: 0, y: 0, duration: 0.23, ease: 'power2.out' },
                                            ],
                                        },
                                        0,
                                    )
                                }

                                // Characters shine with stagger (only if not custom content)
                                if (chars.length > 0) {
                                    tl.to(
                                        chars, {
                                            keyframes: {
                                                opacity: [1, 0.4, 1],
                                            },
                                            duration: 0.15,
                                            ease: 'sine.inOut',
                                            stagger: 0.02,
                                        },
                                        0.1,
                                    )
                                }

                                motion.hover(button, () => {
                                    tl.tweenTo(tl.duration())

                                    return () => {
                                        tl.tweenTo(0)
                                    }
                                })
                            }">
                            <a href="https://filamentphp.com/author" target="_blank" rel="noopener noreferrer"
                                aria-label="Submit your plugin to Filament"
                                class="group inline-flex w-full items-center justify-between rounded-full font-medium whitespace-nowrap text-stone-900 transition duration-300 ease-out will-change-transform hover:scale-y-102 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-13 gap-2.5 pr-1.25 pl-5 bg-honey-200 hover:bg-honey-100 ">
                                <span data-text class="grow">
                                    Submit plugins
                                </span>


                                <div data-icon
                                    class="relative isolate grid shrink-0 place-items-center overflow-hidden rounded-full size-11 bg-serenade-50 text-stone-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.25"
                                        style="transform: rotate(0deg)" viewBox="0 0 28 22" fill="none">
                                        <path class="fill-current"
                                            d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                    </svg>
                                </div>
                            </a>
                        </div>


                        <div x-data data-button-pulse class="rounded-full bg-cream-100"
                            aria-label="Learn how to create plugins for Filament" x-init="async () => {
                                await window.FilamentAnimations.waitForFonts()

                                const button = $el.querySelector('a')
                                const textWrapper = button.querySelector('[data-text]')
                                const icon = button.querySelector('[data-icon] svg')
                                const hasCustomIcon = true
                                const hasCustomContent = false
                                const animateIcon = true

                                const tl = gsap.timeline({ paused: true })

                                // Only animate text if not using custom content
                                let chars = []
                                if (!hasCustomContent && textWrapper) {
                                    const split = new SplitText(textWrapper, { type: 'chars' })
                                    chars = split.chars
                                }

                                if (hasCustomIcon && animateIcon) {
                                    // Custom icon animation: subtle scale and lift
                                    tl.to(
                                        icon, {
                                            scale: 1.1,
                                            rotation: 0.01,
                                            duration: 0.3,
                                            ease: 'sine.out',
                                        },
                                        0,
                                    )
                                } else if (!hasCustomIcon) {
                                    // Arrow animation
                                    const direction = 'right'
                                    const distance = 30

                                    let xOut, yOut, xIn, yIn

                                    switch (direction) {
                                        case 'top-right':
                                            xOut = distance * Math.cos((-45 * Math.PI) / 180)
                                            yOut = distance * Math.sin((-45 * Math.PI) / 180)
                                            xIn = -xOut
                                            yIn = -yOut
                                            break
                                        case 'bottom-right':
                                            xOut = distance * Math.cos((45 * Math.PI) / 180)
                                            yOut = distance * Math.sin((45 * Math.PI) / 180)
                                            xIn = -xOut
                                            yIn = -yOut
                                            break
                                        case 'left':
                                            xOut = -distance
                                            yOut = 0
                                            xIn = -xOut
                                            yIn = 0
                                            break
                                        default:
                                            xOut = distance
                                            yOut = 0
                                            xIn = -distance
                                            yIn = 0
                                    }

                                    tl.to(
                                        icon, {
                                            keyframes: [
                                                { x: xOut, y: yOut, duration: 0.23, ease: 'power2.in' },
                                                { x: xIn, y: yIn, duration: 0 },
                                                { x: 0, y: 0, duration: 0.23, ease: 'power2.out' },
                                            ],
                                        },
                                        0,
                                    )
                                }

                                // Characters shine with stagger (only if not custom content)
                                if (chars.length > 0) {
                                    tl.to(
                                        chars, {
                                            keyframes: {
                                                opacity: [1, 0.4, 1],
                                            },
                                            duration: 0.15,
                                            ease: 'sine.inOut',
                                            stagger: 0.02,
                                        },
                                        0.1,
                                    )
                                }

                                motion.hover(button, () => {
                                    tl.tweenTo(tl.duration())

                                    return () => {
                                        tl.tweenTo(0)
                                    }
                                })
                            }">
                            <a href="/docs/plugins" target="_blank" rel="noopener noreferrer"
                                aria-label="Learn how to create plugins for Filament"
                                class="group inline-flex w-full items-center justify-between rounded-full font-medium whitespace-nowrap text-stone-900 transition duration-300 ease-out will-change-transform hover:scale-y-102 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-13 gap-2.5 flex-row-reverse pr-5 pl-1.25 bg-cream-100 hover:bg-powder-200 ">
                                <span data-text class="grow">
                                    How to create plugins
                                </span>


                                <div data-icon
                                    class="relative isolate grid shrink-0 place-items-center overflow-hidden rounded-full size-11 bg-serenade-50 text-stone-900">
                                    <svg class="size-5.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"
                                        fill="none">
                                        <path class="fill-current"
                                            d="M21.5091 7.12486L11.2415 1.64882C11.0909 1.56758 10.9095 1.56758 10.7589 1.64882L0.491351 7.12486C0.142917 7.31134 0.127019 7.80509 0.462733 8.0136C0.472092 8.01941 0.481631 8.02492 0.491351 8.03012L2.95728 9.34608V13.5917C2.95721 13.8858 3.06532 14.1697 3.26103 14.3892C4.36222 15.6153 6.83244 17.6739 11.0002 17.6739C12.4678 17.6877 13.923 17.4045 15.2784 16.8414V19.8986C15.2789 20.2938 15.707 20.5402 16.049 20.3422C16.2073 20.2505 16.3049 20.0815 16.3051 19.8986V16.3349C17.2163 15.8217 18.0384 15.1644 18.7394 14.3883C18.9355 14.1694 19.0437 13.8857 19.0432 13.5917V9.34608L21.5091 8.03012C21.8575 7.84363 21.8734 7.34989 21.5377 7.14138C21.5283 7.13557 21.5188 7.13006 21.5091 7.12486ZM11.0002 16.6472C7.23544 16.6472 5.01079 14.8024 4.02511 13.703C3.9986 13.672 3.98403 13.6325 3.98404 13.5917V9.89369L10.7589 13.5062C10.9098 13.5865 11.0907 13.5865 11.2415 13.5062L15.2784 11.3534V15.7171C14.1661 16.2493 12.75 16.6472 11.0002 16.6472ZM18.0164 13.5917C18.0164 13.6325 18.0018 13.672 17.9753 13.703C17.4822 14.2492 16.9209 14.7298 16.3051 15.1327V10.8058L18.0164 9.89369V13.5917ZM16.1212 9.74138C16.0947 9.71838 16.0661 9.69803 16.0356 9.68063L11.2441 7.12572C10.8878 6.95463 10.48 7.23334 10.5099 7.6274C10.5227 7.795 10.6166 7.94574 10.7615 8.03098L15.0431 10.3155L11.0002 12.4717L1.82356 7.57749L11.0002 2.68327L20.1769 7.57749L16.1212 9.74138Z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>


                    <hr aria-hidden="true"
                        class="my-2 h-0.5 w-full border-0 bg-bone-100 mask-x-from-50% lg:mask-r-from-0% lg:mask-l-from-100%" />


                    <div class="flex flex-wrap justify-center gap-5 3xs:flex-nowrap"
                        aria-label="Plugin directory statistics">
                        <div x-data x-init="() => {
                            const card = $el
                            const background = $refs.background
                            const topLeftCorner = $refs.topLeftCorner
                            const bottomLeftCorner = $refs.bottomLeftCorner
                            const topRightCorner = $refs.topRightCorner
                            const bottomRightCorner = $refs.bottomRightCorner

                            const tl = gsap.timeline({ paused: true })

                            // Background scales up and changes color
                            tl.fromTo(
                                background, {
                                    scale: 1,
                                }, {
                                    scale: 1.02,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            // Corner animations - move outward with stagger
                            tl.to(
                                topLeftCorner, {
                                    x: -5,
                                    y: -5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                topRightCorner, {
                                    x: 5,
                                    y: -5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                bottomLeftCorner, {
                                    x: -5,
                                    y: 5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                bottomRightCorner, {
                                    x: 5,
                                    y: 5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }"
                            class="group relative min-w-24 px-4 text-center xs:min-w-27 py-3">

                            <div x-ref="background"
                                class="absolute inset-0 transition duration-300 ease-out bg-cream-100 group-hover:bg-bubblegum/25"
                                aria-hidden="true"></div>


                            <div class="relative z-1 flex items-center gap-0.5 flex-col">

                                <div class="font-medium mix-blend-luminosity">
                                    Plugins
                                </div>


                                <div class="font-bold text-stone-900 text-xl">
                                    921
                                </div>
                            </div>


                            <div x-ref="topLeftCorner" class="absolute top-0 left-0" aria-hidden="true">
                                <svg class="text-stone-600 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="bottomLeftCorner" class="absolute bottom-0 left-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-y-100 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="topRightCorner" class="absolute top-0 right-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-x-100 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="bottomRightCorner" class="absolute right-0 bottom-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-x-100 -scale-y-100 h-2.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <div x-data x-init="() => {
                            const card = $el
                            const background = $refs.background
                            const topLeftCorner = $refs.topLeftCorner
                            const bottomLeftCorner = $refs.bottomLeftCorner
                            const topRightCorner = $refs.topRightCorner
                            const bottomRightCorner = $refs.bottomRightCorner

                            const tl = gsap.timeline({ paused: true })

                            // Background scales up and changes color
                            tl.fromTo(
                                background, {
                                    scale: 1,
                                }, {
                                    scale: 1.02,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            // Corner animations - move outward with stagger
                            tl.to(
                                topLeftCorner, {
                                    x: -5,
                                    y: -5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                topRightCorner, {
                                    x: 5,
                                    y: -5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                bottomLeftCorner, {
                                    x: -5,
                                    y: 5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                bottomRightCorner, {
                                    x: 5,
                                    y: 5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }"
                            class="group relative min-w-24 px-4 text-center xs:min-w-27 py-3">

                            <div x-ref="background"
                                class="absolute inset-0 transition duration-300 ease-out bg-cream-100 group-hover:bg-bubblegum/25"
                                aria-hidden="true"></div>


                            <div class="relative z-1 flex items-center gap-0.5 flex-col">

                                <div class="font-medium mix-blend-luminosity">
                                    Authors
                                </div>


                                <div class="font-bold text-stone-900 text-xl">
                                    433
                                </div>
                            </div>


                            <div x-ref="topLeftCorner" class="absolute top-0 left-0" aria-hidden="true">
                                <svg class="text-stone-600 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="bottomLeftCorner" class="absolute bottom-0 left-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-y-100 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="topRightCorner" class="absolute top-0 right-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-x-100 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="bottomRightCorner" class="absolute right-0 bottom-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-x-100 -scale-y-100 h-2.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <div x-data x-init="() => {
                            const card = $el
                            const background = $refs.background
                            const topLeftCorner = $refs.topLeftCorner
                            const bottomLeftCorner = $refs.bottomLeftCorner
                            const topRightCorner = $refs.topRightCorner
                            const bottomRightCorner = $refs.bottomRightCorner

                            const tl = gsap.timeline({ paused: true })

                            // Background scales up and changes color
                            tl.fromTo(
                                background, {
                                    scale: 1,
                                }, {
                                    scale: 1.02,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            // Corner animations - move outward with stagger
                            tl.to(
                                topLeftCorner, {
                                    x: -5,
                                    y: -5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                topRightCorner, {
                                    x: 5,
                                    y: -5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                bottomLeftCorner, {
                                    x: -5,
                                    y: 5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            tl.to(
                                bottomRightCorner, {
                                    x: 5,
                                    y: 5,
                                    duration: 0.25,
                                    ease: 'power2.out',
                                },
                                0,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }"
                            class="group relative min-w-24 px-4 text-center xs:min-w-27 py-3">

                            <div x-ref="background"
                                class="absolute inset-0 transition duration-300 ease-out bg-cream-100 group-hover:bg-bubblegum/25"
                                aria-hidden="true"></div>


                            <div class="relative z-1 flex items-center gap-0.5 flex-col">

                                <div class="font-medium mix-blend-luminosity">
                                    Stars
                                </div>


                                <div class="font-bold text-stone-900 text-xl">
                                    34.7K
                                </div>
                            </div>


                            <div x-ref="topLeftCorner" class="absolute top-0 left-0" aria-hidden="true">
                                <svg class="text-stone-600 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="bottomLeftCorner" class="absolute bottom-0 left-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-y-100 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="topRightCorner" class="absolute top-0 right-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-x-100 h-2.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>


                            <div x-ref="bottomRightCorner" class="absolute right-0 bottom-0" aria-hidden="true">
                                <svg class="text-stone-600 -scale-x-100 -scale-y-100 h-2.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                    <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <div wire:key="lw-1485238057-0"
                wire:snapshot="{&quot;data&quot;:{&quot;bottomMessage&quot;:&quot;The best plugins are waiting to be found.&quot;,&quot;featuredPluginIds&quot;:[[&quot;019c9538-7228-7280-9912-c8a6d4c53b58&quot;,&quot;019ea734-5695-71f1-b572-f4d1ebf722ad&quot;,&quot;019c9539-0268-70b5-aef1-a3487ede8a36&quot;,&quot;019ccceb-0b72-7195-95ac-c61c13dbd785&quot;],{&quot;s&quot;:&quot;arr&quot;}],&quot;search&quot;:&quot;skill&quot;,&quot;selectedVersion&quot;:&quot;all&quot;,&quot;selectedPrice&quot;:&quot;all&quot;,&quot;selectedMinScore&quot;:&quot;all&quot;,&quot;filterDarkMode&quot;:false,&quot;filterMultilingual&quot;:false,&quot;filterFeatured&quot;:false,&quot;filterOfficial&quot;:false,&quot;selectedTags&quot;:[[],{&quot;s&quot;:&quot;arr&quot;}],&quot;sortBy&quot;:&quot;newest&quot;,&quot;paginators&quot;:[{&quot;page&quot;:1},{&quot;s&quot;:&quot;arr&quot;}]},&quot;memo&quot;:{&quot;id&quot;:&quot;YnxP6ytAvwCttzIdw9HJ&quot;,&quot;name&quot;:&quot;plugin-list&quot;,&quot;path&quot;:&quot;plugins&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;release&quot;:&quot;a-a-a&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;,&quot;islands&quot;:[]},&quot;checksum&quot;:&quot;db4c3f7198303fdc24991750425828d52952cdb1e4cb22392b2c29aff3918482&quot;}"
                wire:effects="{&quot;partials&quot;:[],&quot;url&quot;:{&quot;search&quot;:{&quot;as&quot;:&quot;q&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;selectedVersion&quot;:{&quot;as&quot;:&quot;v&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;selectedPrice&quot;:{&quot;as&quot;:&quot;price&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;selectedMinScore&quot;:{&quot;as&quot;:&quot;score&quot;,&quot;use&quot;:&quot;push&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;filterDarkMode&quot;:{&quot;as&quot;:&quot;dark&quot;,&quot;use&quot;:&quot;push&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;filterMultilingual&quot;:{&quot;as&quot;:&quot;i18n&quot;,&quot;use&quot;:&quot;push&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;filterFeatured&quot;:{&quot;as&quot;:&quot;featured&quot;,&quot;use&quot;:&quot;push&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;filterOfficial&quot;:{&quot;as&quot;:&quot;official&quot;,&quot;use&quot;:&quot;push&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;selectedTags&quot;:{&quot;as&quot;:&quot;tags&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;sortBy&quot;:{&quot;as&quot;:&quot;sort&quot;,&quot;use&quot;:&quot;replace&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null},&quot;paginators.page&quot;:{&quot;as&quot;:&quot;page&quot;,&quot;use&quot;:&quot;push&quot;,&quot;alwaysShow&quot;:false,&quot;except&quot;:null}}}"
                wire:id="YnxP6ytAvwCttzIdw9HJ" wire:name="plugin-list">

                <!--[if BLOCK]><![endif]-->
                <div wire:ignore data-triangle-decoration="bottom"
                    class="border-b border-bone-100 px-5 pt-8 pb-8 xs:px-8 md:px-10 md:pt-10 md:pb-10">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="heading-5">Featured Plugins</h2>
                            <p class="text-sm text-stone-500">
                                A selection of plugins curated by the Filament team
                            </p>
                        </div>
                        <button type="button" wire:click="setSort('popular')"
                            class="inline-flex shrink-0 items-center gap-1 text-xs leading-7 font-medium text-stone-800 transition duration-300 ease-out hover:text-stone-600">
                            <span>View all</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5" viewBox="0 0 28 22"
                                fill="none">
                                <path class="fill-current"
                                    d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-4 grid grid-cols-1 items-start gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
                        aria-label="Featured plugins">
                        <!--[if BLOCK]><![endif]--> <a
                            href="https://filamentphp.com/plugins/filament-custom-dashboards"
                            class="group flex flex-col gap-2.5 overflow-hidden rounded-xs bg-cream-100 p-4 transition duration-300 ease-out"
                            aria-label="View Custom Dashboards plugin page">

                            <div
                                class="aspect-video overflow-hidden rounded-xs ring ring-cocoa transition duration-300 ease-out group-hover:scale-101">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019eac5a-2676-72ce-91fd-7388b7d38d89/conversions/01KTP5M9J45JD8RR2RMMWWMG1P-optimized.webp"
                                    alt="Custom Dashboards plugin thumbnail" class="size-full object-cover"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex flex-col gap-1">

                                <div class="flex items-center gap-3">
                                    <div
                                        class="relative min-w-0 flex-1 transition duration-300 ease-out will-change-transform group-hover:translate-x-3">

                                        <div x-data x-init="() => {
                                            const tweens = []
                                            let playing = false

                                            const rotatingEl = $el.querySelector('[data-rotating]')
                                            const rotate = () => {
                                                gsap.to(rotatingEl, {
                                                    rotation: '+=60',
                                                    duration: 0.5,
                                                    ease: 'sine.out',
                                                    onComplete: () => {
                                                        if (playing) gsap.delayedCall(0.5, rotate)
                                                    },
                                                })
                                            }

                                            const boxes = $el.querySelectorAll('[data-box]')
                                            const delays = [0, 0.2, 0.1]
                                            boxes.forEach((box, i) => {
                                                tweens.push(
                                                    gsap.to(box, {
                                                        opacity: 0.3,
                                                        repeat: -1,
                                                        yoyo: true,
                                                        duration: 0.4,
                                                        delay: delays[i] || 0,
                                                        ease: 'power1.inOut',
                                                        paused: true,
                                                    }),
                                                )
                                            })

                                            const group = $el.closest('.group')
                                            if (group) {
                                                group.addEventListener('mouseenter', () => {
                                                    playing = true
                                                    tweens.forEach((t) => t.resume())
                                                    rotate()
                                                })
                                                group.addEventListener('mouseleave', () => {
                                                    playing = false
                                                    tweens.forEach((t) => t.pause())
                                                })
                                            }
                                        }"
                                            class="absolute top-1/2 -left-4 -translate-y-1/2">
                                            <div
                                                class="translate-x-0.5 opacity-0 transition duration-300 ease-out will-change-transform group-hover:translate-x-0 group-hover:opacity-100">
                                                <div data-rotating class="flex items-center gap-0.75">
                                                    <div class="flex flex-col gap-1">

                                                        <div data-box class="size-0.75 bg-current"></div>


                                                        <div data-box class="size-0.75 bg-current"></div>
                                                    </div>


                                                    <div data-box class="size-0.75 bg-current"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <p class="truncate pr-1 font-outfit font-medium text-stone-800">
                                            Custom Dashboards
                                        </p>
                                    </div>

                                    <span class="shrink-0 text-sm font-medium text-stone-800">
                                        $89.00
                                    </span>
                                </div>


                                <!--[if BLOCK]><![endif]-->
                                <p class="line-clamp-2 text-sm">
                                    Let your users build and share their own dashboards with a drag-and-drop interface.
                                    Define your data sources in PHP and let them do the rest.
                                </p>
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex items-center gap-2">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c9537-fbba-7175-a27f-bcdcdb422aa1/conversions/filament-optimized.webp"
                                    alt="Filament avatar"
                                    class="size-5 shrink-0 rounded-xs object-cover ring ring-black/50"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                                <span class="truncate text-xs text-stone-600">
                                    Filament
                                </span>


                                <span
                                    class="ml-auto shrink-0 -translate-x-2 opacity-0 transition duration-300 ease-out group-hover:translate-x-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5" viewBox="0 0 28 22"
                                        fill="none">
                                        <path class="fill-current"
                                            d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <a href="https://filamentphp.com/plugins/filament-blueprint"
                            class="group flex flex-col gap-2.5 overflow-hidden rounded-xs bg-cream-100 p-4 transition duration-300 ease-out"
                            aria-label="View Blueprint plugin page">

                            <div
                                class="aspect-video overflow-hidden rounded-xs ring ring-cocoa transition duration-300 ease-out group-hover:scale-101">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019eab44-43e5-71f1-9d5e-44a8f5efc64b/conversions/01KTNM8GX1DZFVK3DZNR869NEZ-optimized.webp"
                                    alt="Blueprint plugin thumbnail" class="size-full object-cover" loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex flex-col gap-1">

                                <div class="flex items-center gap-3">
                                    <div
                                        class="relative min-w-0 flex-1 transition duration-300 ease-out will-change-transform group-hover:translate-x-3">

                                        <div x-data x-init="() => {
                                            const tweens = []
                                            let playing = false

                                            const rotatingEl = $el.querySelector('[data-rotating]')
                                            const rotate = () => {
                                                gsap.to(rotatingEl, {
                                                    rotation: '+=60',
                                                    duration: 0.5,
                                                    ease: 'sine.out',
                                                    onComplete: () => {
                                                        if (playing) gsap.delayedCall(0.5, rotate)
                                                    },
                                                })
                                            }

                                            const boxes = $el.querySelectorAll('[data-box]')
                                            const delays = [0, 0.2, 0.1]
                                            boxes.forEach((box, i) => {
                                                tweens.push(
                                                    gsap.to(box, {
                                                        opacity: 0.3,
                                                        repeat: -1,
                                                        yoyo: true,
                                                        duration: 0.4,
                                                        delay: delays[i] || 0,
                                                        ease: 'power1.inOut',
                                                        paused: true,
                                                    }),
                                                )
                                            })

                                            const group = $el.closest('.group')
                                            if (group) {
                                                group.addEventListener('mouseenter', () => {
                                                    playing = true
                                                    tweens.forEach((t) => t.resume())
                                                    rotate()
                                                })
                                                group.addEventListener('mouseleave', () => {
                                                    playing = false
                                                    tweens.forEach((t) => t.pause())
                                                })
                                            }
                                        }"
                                            class="absolute top-1/2 -left-4 -translate-y-1/2">
                                            <div
                                                class="translate-x-0.5 opacity-0 transition duration-300 ease-out will-change-transform group-hover:translate-x-0 group-hover:opacity-100">
                                                <div data-rotating class="flex items-center gap-0.75">
                                                    <div class="flex flex-col gap-1">

                                                        <div data-box class="size-0.75 bg-current"></div>


                                                        <div data-box class="size-0.75 bg-current"></div>
                                                    </div>


                                                    <div data-box class="size-0.75 bg-current"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <p class="truncate pr-1 font-outfit font-medium text-stone-800">
                                            Blueprint
                                        </p>
                                    </div>

                                    <span class="shrink-0 text-sm font-medium text-stone-800">
                                        $49.00
                                    </span>
                                </div>


                                <!--[if BLOCK]><![endif]-->
                                <p class="line-clamp-2 text-sm">
                                    Filament Blueprint is a premium Laravel Boost extension that helps AI agents produce
                                    accurate, detailed implementation plans and security reports for Filament apps.
                                </p>
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex items-center gap-2">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c9537-fbba-7175-a27f-bcdcdb422aa1/conversions/filament-optimized.webp"
                                    alt="Filament avatar"
                                    class="size-5 shrink-0 rounded-xs object-cover ring ring-black/50"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                                <span class="truncate text-xs text-stone-600">
                                    Filament
                                </span>


                                <span
                                    class="ml-auto shrink-0 -translate-x-2 opacity-0 transition duration-300 ease-out group-hover:translate-x-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5" viewBox="0 0 28 22"
                                        fill="none">
                                        <path class="fill-current"
                                            d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <a href="https://filamentphp.com/plugins/pxlrbt-spotlight-pro"
                            class="group flex flex-col gap-2.5 overflow-hidden rounded-xs bg-cream-100 p-4 transition duration-300 ease-out"
                            aria-label="View Spotlight Pro plugin page">

                            <div
                                class="aspect-video overflow-hidden rounded-xs ring ring-cocoa transition duration-300 ease-out group-hover:scale-101">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c9539-026e-72d1-a95e-23cd12c5044d/conversions/pxlrbt-spotlight-pro-optimized.webp"
                                    alt="Spotlight Pro plugin thumbnail" class="size-full object-cover"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex flex-col gap-1">

                                <div class="flex items-center gap-3">
                                    <div
                                        class="relative min-w-0 flex-1 transition duration-300 ease-out will-change-transform group-hover:translate-x-3">

                                        <div x-data x-init="() => {
                                            const tweens = []
                                            let playing = false

                                            const rotatingEl = $el.querySelector('[data-rotating]')
                                            const rotate = () => {
                                                gsap.to(rotatingEl, {
                                                    rotation: '+=60',
                                                    duration: 0.5,
                                                    ease: 'sine.out',
                                                    onComplete: () => {
                                                        if (playing) gsap.delayedCall(0.5, rotate)
                                                    },
                                                })
                                            }

                                            const boxes = $el.querySelectorAll('[data-box]')
                                            const delays = [0, 0.2, 0.1]
                                            boxes.forEach((box, i) => {
                                                tweens.push(
                                                    gsap.to(box, {
                                                        opacity: 0.3,
                                                        repeat: -1,
                                                        yoyo: true,
                                                        duration: 0.4,
                                                        delay: delays[i] || 0,
                                                        ease: 'power1.inOut',
                                                        paused: true,
                                                    }),
                                                )
                                            })

                                            const group = $el.closest('.group')
                                            if (group) {
                                                group.addEventListener('mouseenter', () => {
                                                    playing = true
                                                    tweens.forEach((t) => t.resume())
                                                    rotate()
                                                })
                                                group.addEventListener('mouseleave', () => {
                                                    playing = false
                                                    tweens.forEach((t) => t.pause())
                                                })
                                            }
                                        }"
                                            class="absolute top-1/2 -left-4 -translate-y-1/2">
                                            <div
                                                class="translate-x-0.5 opacity-0 transition duration-300 ease-out will-change-transform group-hover:translate-x-0 group-hover:opacity-100">
                                                <div data-rotating class="flex items-center gap-0.75">
                                                    <div class="flex flex-col gap-1">

                                                        <div data-box class="size-0.75 bg-current"></div>


                                                        <div data-box class="size-0.75 bg-current"></div>
                                                    </div>


                                                    <div data-box class="size-0.75 bg-current"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <p class="truncate pr-1 font-outfit font-medium text-stone-800">
                                            Spotlight Pro
                                        </p>
                                    </div>

                                    <span class="shrink-0 text-sm font-medium text-stone-800">
                                        €49.00
                                    </span>
                                </div>


                                <!--[if BLOCK]><![endif]-->
                                <p class="line-clamp-2 text-sm">
                                    Browse your Filament Panel with ease. Filament Spotlight Pro adds a
                                    Spotlight/Raycast like Command Palette to your Filament Panel.
                                </p>
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex items-center gap-2">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c9537-d77e-7132-80a6-82f298842633/conversions/pxlrbt-optimized.webp"
                                    alt="Dennis Koch avatar"
                                    class="size-5 shrink-0 rounded-xs object-cover ring ring-black/50"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                                <span class="truncate text-xs text-stone-600">
                                    Dennis Koch
                                </span>


                                <span
                                    class="ml-auto shrink-0 -translate-x-2 opacity-0 transition duration-300 ease-out group-hover:translate-x-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5" viewBox="0 0 28 22"
                                        fill="none">
                                        <path class="fill-current"
                                            d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <a href="https://filamentphp.com/plugins/relaticle-custom-fields"
                            class="group flex flex-col gap-2.5 overflow-hidden rounded-xs bg-cream-100 p-4 transition duration-300 ease-out hidden sm:flex lg:hidden xl:flex"
                            aria-label="View Custom Fields plugin page">

                            <div
                                class="aspect-video overflow-hidden rounded-xs ring ring-cocoa transition duration-300 ease-out group-hover:scale-101">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019cccf9-fd66-7019-a5dd-ae97643eacbc/conversions/01KK6FKZA3YEJ6XMKJVCC3B8H5-optimized.webp"
                                    alt="Custom Fields plugin thumbnail" class="size-full object-cover"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex flex-col gap-1">

                                <div class="flex items-center gap-3">
                                    <div
                                        class="relative min-w-0 flex-1 transition duration-300 ease-out will-change-transform group-hover:translate-x-3">

                                        <div x-data x-init="() => {
                                            const tweens = []
                                            let playing = false

                                            const rotatingEl = $el.querySelector('[data-rotating]')
                                            const rotate = () => {
                                                gsap.to(rotatingEl, {
                                                    rotation: '+=60',
                                                    duration: 0.5,
                                                    ease: 'sine.out',
                                                    onComplete: () => {
                                                        if (playing) gsap.delayedCall(0.5, rotate)
                                                    },
                                                })
                                            }

                                            const boxes = $el.querySelectorAll('[data-box]')
                                            const delays = [0, 0.2, 0.1]
                                            boxes.forEach((box, i) => {
                                                tweens.push(
                                                    gsap.to(box, {
                                                        opacity: 0.3,
                                                        repeat: -1,
                                                        yoyo: true,
                                                        duration: 0.4,
                                                        delay: delays[i] || 0,
                                                        ease: 'power1.inOut',
                                                        paused: true,
                                                    }),
                                                )
                                            })

                                            const group = $el.closest('.group')
                                            if (group) {
                                                group.addEventListener('mouseenter', () => {
                                                    playing = true
                                                    tweens.forEach((t) => t.resume())
                                                    rotate()
                                                })
                                                group.addEventListener('mouseleave', () => {
                                                    playing = false
                                                    tweens.forEach((t) => t.pause())
                                                })
                                            }
                                        }"
                                            class="absolute top-1/2 -left-4 -translate-y-1/2">
                                            <div
                                                class="translate-x-0.5 opacity-0 transition duration-300 ease-out will-change-transform group-hover:translate-x-0 group-hover:opacity-100">
                                                <div data-rotating class="flex items-center gap-0.75">
                                                    <div class="flex flex-col gap-1">

                                                        <div data-box class="size-0.75 bg-current"></div>


                                                        <div data-box class="size-0.75 bg-current"></div>
                                                    </div>


                                                    <div data-box class="size-0.75 bg-current"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <p class="truncate pr-1 font-outfit font-medium text-stone-800">
                                            Custom Fields
                                        </p>
                                    </div>

                                    <span class="shrink-0 text-sm font-medium text-stone-800">
                                        $79.00
                                    </span>
                                </div>


                                <!--[if BLOCK]><![endif]-->
                                <p class="line-clamp-2 text-sm">
                                    Eliminate custom field migrations forever. Let your users create and manage form
                                    fields directly in Filament admin panels with 20+ built-in field types, validation,
                                    and zero database changes.
                                </p>
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>


                            <div class="flex items-center gap-2">
                                <!--[if BLOCK]><![endif]--> <img
                                    src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c9537-f52d-7267-8cc2-f78723c5345b/conversions/relaticle-optimized.webp"
                                    alt="Relaticle avatar"
                                    class="size-5 shrink-0 rounded-xs object-cover ring ring-black/50"
                                    loading="lazy" />
                                <!--[if ENDBLOCK]><![endif]-->
                                <span class="truncate text-xs text-stone-600">
                                    Relaticle
                                </span>


                                <span
                                    class="ml-auto shrink-0 -translate-x-2 opacity-0 transition duration-300 ease-out group-hover:translate-x-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5" viewBox="0 0 28 22"
                                        fill="none">
                                        <path class="fill-current"
                                            d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
                <!--[if ENDBLOCK]><![endif]-->
                <section id="scroll-to-reference" x-data="{
                    search: $wire.entangle('search').live,
                    showFilters: false,
                    selectedVersion: $wire.entangle('selectedVersion').live,
                    selectedPrice: $wire.entangle('selectedPrice').live,
                    selectedMinScore: $wire.entangle('selectedMinScore').live,
                    filterDarkMode: $wire.entangle('filterDarkMode').live,
                    filterMultilingual: $wire.entangle('filterMultilingual').live,
                    filterFeatured: $wire.entangle('filterFeatured').live,
                    filterOfficial: $wire.entangle('filterOfficial').live,
                    selectedTags: $wire.entangle('selectedTags').live,
                    sortBy: $wire.entangle('sortBy').live,
                    sortDropdownOpen: false,
                    availableTags: JSON.parse('[\u0022action\u0022,\u0022analytics\u0022,\u0022developer-tool\u0022,\u0022form-builder\u0022,\u0022form-editor\u0022,\u0022form-field\u0022,\u0022form-layout\u0022,\u0022icon-set\u0022,\u0022infolist-entry\u0022,\u0022kit\u0022,\u0022panel-authentication\u0022,\u0022panel-authorization\u0022,\u0022panel-builder\u0022,\u0022spatie\u0022,\u0022table-builder\u0022,\u0022table-column\u0022,\u0022theme\u0022,\u0022widget\u0022]'),
                    tagLabels: JSON.parse('{\u0022action\u0022:\u0022Action\u0022,\u0022analytics\u0022:\u0022Analytics\u0022,\u0022developer-tool\u0022:\u0022Developer Tool\u0022,\u0022form-builder\u0022:\u0022Forms\u0022,\u0022form-editor\u0022:\u0022Form Editor Field\u0022,\u0022form-field\u0022:\u0022Form Field\u0022,\u0022form-layout\u0022:\u0022Form Layout\u0022,\u0022icon-set\u0022:\u0022Icon Set\u0022,\u0022infolist-entry\u0022:\u0022Infolist Entry\u0022,\u0022kit\u0022:\u0022Kit\u0022,\u0022panel-authentication\u0022:\u0022Panel Authentication\u0022,\u0022panel-authorization\u0022:\u0022Panel Authorization\u0022,\u0022panel-builder\u0022:\u0022Panels\u0022,\u0022spatie\u0022:\u0022Spatie Integration\u0022,\u0022table-builder\u0022:\u0022Tables\u0022,\u0022table-column\u0022:\u0022Table Column\u0022,\u0022theme\u0022:\u0022Theme\u0022,\u0022widget\u0022:\u0022Widget\u0022}'),
                    circlePositions: { c1: 6, c2: 12, c3: 18 },
                    defaultPositions: { c1: 6, c2: 12, c3: 18 },
                    randomizeCircles() {
                        this.circlePositions = {
                            c1: Math.floor(Math.random() * 13) + 6,
                            c2: Math.floor(Math.random() * 13) + 6,
                            c3: Math.floor(Math.random() * 13) + 6,
                        }
                    },
                    resetCirclePositions() {
                        this.circlePositions = { ...this.defaultPositions }
                    },
                    isTagSelected(tag) {
                        return this.selectedTags.includes(tag)
                    },
                    toggleTag(tag) {
                        if (this.isTagSelected(tag)) {
                            this.selectedTags = this.selectedTags.filter((t) => t !== tag)
                        } else {
                            this.selectedTags = [...this.selectedTags, tag]
                        }
                    },
                    get activeFilterCount() {
                        let count = 0
                        if (this.selectedVersion !== 'all') count++
                        if (this.selectedPrice !== 'all') count++
                        if (this.selectedMinScore !== 'all') count++
                        if (this.filterDarkMode) count++
                        if (this.filterMultilingual) count++
                        if (this.filterFeatured) count++
                        if (this.filterOfficial) count++
                        count += this.selectedTags.length
                        return count
                    },
                    resetFilters() {
                        gsap.to($refs.resetIcon, {
                            rotation: '-=360',
                            duration: 0.5,
                            ease: 'sine.inOut',
                        })

                        this.selectedVersion = 'all'
                        this.selectedPrice = 'all'
                        this.selectedMinScore = 'all'
                        this.filterDarkMode = false
                        this.filterMultilingual = false
                        this.filterFeatured = false
                        this.filterOfficial = false
                        this.selectedTags = []
                        this.sortBy = 'newest'
                        this.showFilters = false

                        $wire.resetFilters()

                        $refs.filtersButton.focus()
                        document
                            .querySelector('#scroll-to-reference')
                            ?.scrollIntoView({ behavior: 'smooth' })
                    },
                    listeningMessages: [
                        `Whatcha looking for? 🔍`,
                        `I'm listening... 👀`,
                        `Go ahead, I'm ready 🎯`,
                        `Type away! ⌨️`,
                        `Searching is fun! 🤓`,
                        `What can I find for you? 🕵️‍♂️`,
                    ],
                    listeningIndex: 0,
                    get listeningMessage() {
                        return this.listeningMessages[
                            this.listeningIndex % this.listeningMessages.length
                        ]
                    },
                    rotateListeningMessage() {
                        this.listeningIndex++
                    },
                    clearSearch() {
                        if (!this.search) return

                        const input = this.$refs.searchInput
                        const originalText = this.search
                        const length = originalText.length
                        const obj = { progress: 0 }

                        gsap.to(obj, {
                            progress: 1,
                            duration: Math.min(0.5, length * 0.03),
                            ease: 'none',
                            onUpdate: () => {
                                const charsToRemove = Math.floor(obj.progress * length)
                                input.value = originalText.slice(0, length - charsToRemove)
                            },
                            onComplete: () => {
                                this.search = ''
                                document.activeElement?.blur()
                            },
                        })
                    },
                }" aria-label="Plugin search and listing"
                    class="scroll-mt-11 px-5 py-8 xs:px-8 md:p-10">
                    <div class="mb-5">
                        <h2 class="heading-5">All Plugins</h2>
                        <p class="text-sm text-stone-500">
                            Browse the full collection of community and official plugins
                        </p>
                    </div>

                    <!--[if BLOCK]><![endif]-->
                    <div role="note"
                        class="flex items-start gap-2.5 rounded-xs bg-honey-100 text-stone-700 p-3.5 text-sm mb-5"
                        x-show="! filterOfficial">
                        <svg class="mt-px shrink-0 size-4.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 256 256">
                            <path class="fill-current"
                                d="M208,40H48A16,16,0,0,0,32,56v56c0,52.72,25.52,84.67,46.93,102.19,23.06,18.86,46,25.27,47,25.53a8,8,0,0,0,4.2,0c1-.26,23.91-6.67,47-25.53C198.48,196.67,224,164.72,224,112V56A16,16,0,0,0,208,40ZM120,96a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm8,88a12,12,0,1,1,12-12A12,12,0,0,1,128,184Z">
                            </path>
                        </svg>
                        <span>
                            <!--[if BLOCK]><![endif]--> <strong>Most plugins here are third-party.</strong>
                            They are built by the community, not the Filament team. Only
                            plugins marked
                            <strong>Official</strong>
                            are maintained by Filament; the security of all others is not
                            reviewed or vetted, so install at your own risk. Found malware
                            or an unresolved security issue the author won't address?
                            <a href="https://filamentphp.com/plugins/report-security-issue"
                                class="font-medium text-stone-800 underline decoration-stone-400 underline-offset-2 transition hover:decoration-stone-800">
                                Report it
                            </a>
                            .
                            <!--[if ENDBLOCK]><![endif]--> </span>
                    </div>
                    <!--[if ENDBLOCK]><![endif]-->

                    <search class="flex w-full flex-col-reverse gap-2.75 sm:flex-row sm:items-center" role="search">

                        <div class="flex items-center">

                            <button type="button" x-ref="filtersButton" x-on:click="showFilters = !showFilters"
                                :aria-expanded="showFilters" aria-controls="filters-panel"
                                class="group inline-flex h-10 items-center gap-1.75 rounded-xs bg-cream-100 px-3 transition-all duration-300 ease-out will-change-transform focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset active:scale-95"
                                :class="showFilters ? 'bg-honey-100 hover:bg-honey-100/90' : 'bg-cream-100 hover:bg-honey-100'">

                                <span x-init="$watch('selectedVersion', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('selectedPrice', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('selectedMinScore', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('filterDarkMode', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('filterMultilingual', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('filterFeatured', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('filterOfficial', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('selectedTags', () => {
                                    if (showFilters) randomizeCircles()
                                })
                                $watch('showFilters', (value) => {
                                    if (!value) resetCirclePositions()
                                })"
                                    class="[--circle-1:6px] [--circle-2:12px] [--circle-3:18px]"
                                    :class="!showFilters ?
                                        '[--circle-1:6px] [--circle-2:12px] [--circle-3:18px] group-hover:[--circle-1:18px] group-hover:[--circle-2:6px] group-hover:[--circle-3:12px]' :
                                        'text-stone-800'"
                                    :style="showFilters ?
                                        `--circle-1: ${circlePositions.c1}px; --circle-2: ${circlePositions.c2}px; --circle-3: ${circlePositions.c3}px` :
                                        ''">
                                    <svg class="size-5" viewBox="0 0 24 24">
                                        <defs>
                                            <mask id="slider-mask-tw">
                                                <rect x="0" y="0" width="100%" height="100%" fill="white" />

                                                <g fill="black">
                                                    <circle cy="5" r="2.5"
                                                        class="translate-x-(--circle-1) transition duration-500 ease-out will-change-transform" />
                                                    <circle cy="12" r="2.5"
                                                        class="translate-x-(--circle-2) transition duration-500 ease-out will-change-transform" />
                                                    <circle cy="19" r="2.5"
                                                        class="translate-x-(--circle-3) transition duration-500 ease-out will-change-transform" />
                                                </g>
                                            </mask>
                                        </defs>

                                        <g stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                            mask="url(#slider-mask-tw)">
                                            <line x1="2" y1="5" x2="22" y2="5" />
                                            <line x1="2" y1="12" x2="22" y2="12" />
                                            <line x1="2" y1="19" x2="22" y2="19" />
                                        </g>

                                        <g stroke="currentColor" stroke-width="1" fill="none">
                                            <circle cy="5" r="2"
                                                class="translate-x-(--circle-1) transition duration-500 ease-out will-change-transform" />
                                            <circle cy="12" r="2"
                                                class="translate-x-(--circle-2) transition duration-500 ease-out will-change-transform" />
                                            <circle cy="19" r="2"
                                                class="translate-x-(--circle-3) transition duration-500 ease-out will-change-transform" />
                                        </g>
                                    </svg>
                                </span>


                                <span class="text-sm transition-all duration-300 ease-out"
                                    :class="showFilters ? 'font-medium text-stone-800' :
                                        'group-hover:font-medium group-hover:text-stone-800'">
                                    Filters
                                </span>
                            </button>


                            <div class="grid transition-[grid-template-columns] duration-500 ease-out"
                                style="grid-template-columns: 0fr"
                                :style="`grid-template-columns: ${activeFilterCount > 0 ? '1fr' : '0fr'}; transition-delay: ${activeFilterCount > 0 ? '0ms' : '400ms'}`">
                                <div class="flex items-center overflow-hidden">

                                    <div class="px-1 transition-opacity duration-500 ease-out"
                                        :style="`opacity: ${activeFilterCount > 0 ? '1' : '0'}; transition-delay: ${activeFilterCount > 0 ? '0ms' : '400ms'}`">
                                        <svg class="h-px w-5 text-bone-500" viewBox="0 0 20 1" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <line class="stroke-current" y1="0.5" x2="20"
                                                y2="0.5" stroke-dasharray="4 4" />
                                        </svg>
                                    </div>


                                    <button type="button" x-on:click="resetFilters()"
                                        :inert="activeFilterCount === 0" :aria-hidden="activeFilterCount === 0"
                                        class="group custom-dashed-border inline-flex h-10 min-w-27 items-center justify-center gap-1.5 rounded-xs bg-cream-100 pr-3 pl-2.5 transition-all duration-500 ease-out will-change-transform hover:bg-minty-200/70 active:scale-95"
                                        :style="`opacity: ${activeFilterCount > 0 ? '1' : '0'}; visibility: ${activeFilterCount > 0 ? 'visible' : 'hidden'}; pointer-events: ${activeFilterCount > 0 ? 'auto' : 'none'}; transition-delay: ${activeFilterCount > 0 ? '0ms' : '400ms'}`"
                                        :class="activeFilterCount > 0 ? 'hover:text-stone-800' : ''">

                                        <span x-ref="resetIcon">
                                            <svg aria-hidden="true" class="size-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 15 15" version="1.1">
                                                <path class="fill-current"
                                                    d="M7.867185 0.88626C7.825754999999999 0.891555 7.76163 0.910965 7.724685 0.9294C7.677225 0.953085 7.383555 1.236615 6.7243949999999995 1.8952049999999998C5.68041 2.93829 5.71236 2.9001599999999996 5.71236 3.10338C5.71236 3.3075599999999996 5.673735 3.261165 6.70362 4.294365C7.211745 4.80414 7.657875 5.240685 7.694999999999999 5.264474999999999C7.822905 5.34645 8.01585 5.353755 8.155994999999999 5.281905C8.228459999999998 5.24475 8.31984 5.153295 8.357099999999999 5.080620000000001C8.42571 4.946775000000001 8.42319 4.75782 8.351175 4.635C8.33424 4.606125 8.096985 4.357365 7.8239399999999995 4.082205L7.3275 3.58191 7.6575 3.5898600000000003C8.117325 3.60093 8.471789999999999 3.657255 8.90181 3.787605C9.44361 3.9518400000000002 10.032869999999999 4.26138 10.485 4.619294999999999C10.687635 4.77969 11.104875 5.197665 11.264355 5.3999999999999995C11.808119999999999 6.089910000000001 12.13926 6.8794949999999995 12.264615 7.785C12.301305 8.050094999999999 12.301425 8.708174999999999 12.26484 8.969999999999999C12.101145 10.141184999999998 11.598 11.118599999999999 10.754999999999999 11.903039999999999C10.17222 12.445350000000001 9.474044999999998 12.825809999999999 8.69097 13.02783C8.223285 13.14849 7.8072 13.18788 7.177499999999999 13.171125C6.917655 13.164225 6.86499 13.178684999999998 6.743925 13.290284999999999C6.641039999999999 13.385129999999998 6.592769999999999 13.495664999999999 6.593445 13.63491C6.59466 13.88733 6.76209 14.06598 7.029884999999999 14.100584999999999C7.2814499999999995 14.13309 7.94946 14.116575 8.283885 14.069595C9.200445 13.94082 10.079565 13.592145 10.826895 13.061024999999999C11.614289999999999 12.50142 12.267405 11.724734999999999 12.68358 10.853055C12.968069999999999 10.257209999999999 13.146704999999999 9.61716 13.217535 8.94C13.22832 8.836875 13.23714 8.58375 13.23714 8.3775C13.23714 7.978275 13.219919999999998 7.758105 13.161675 7.41231C13.0107 6.516165 12.637575 5.650634999999999 12.090345 4.9272C11.334225 3.9275849999999997 10.277295 3.19989 9.085155 2.8581C8.57196 2.710965 8.084069999999999 2.64075 7.57125 2.64024C7.441305 2.640105 7.335 2.635065 7.335 2.629035C7.335 2.62302 7.560809999999999 2.3918250000000003 7.8367949999999995 2.115285C8.40282 1.54815 8.40516 1.545 8.40516 1.3499999999999999C8.40516 1.0560450000000001 8.16417 0.8482949999999999 7.867185 0.88626M3.3321899999999998 4.537694999999999C3.23994 4.563525 3.1971149999999997 4.591575 3.110985 4.682535C2.81289 4.997355 2.30058 5.83293 2.2737000000000003 6.04815C2.22639 6.42669 2.63334 6.69816 2.9726549999999996 6.51441C3.0738149999999997 6.45963 3.10614 6.419504999999999 3.2174099999999997 6.2105250000000005C3.400695 5.86632 3.5242649999999998 5.6768849999999995 3.7975649999999996 5.321115C3.9056399999999996 5.18043 3.93717 5.08863 3.92544 4.94877C3.9006899999999995 4.6534949999999995 3.6180299999999996 4.457625 3.3321899999999998 4.537694999999999M2.09823 7.490714999999999C1.970535 7.536345 1.88439 7.613009999999999 1.823145 7.73553C1.7902949999999997 7.801259999999999 1.7815649999999998 7.847339999999999 1.76778 8.02803C1.7320799999999998 8.495505 1.783755 9.13875 1.89738 9.64131C1.9591500000000002 9.914489999999999 1.9947899999999998 9.986295 2.11143 10.072485C2.40936 10.29264 2.8286249999999997 10.10469 2.860515 9.736695000000001C2.86563 9.677595 2.8560749999999997 9.601094999999999 2.82843 9.48C2.7284399999999995 9.04203 2.69163 8.654295 2.70606 8.191035C2.718585 7.78923 2.7096299999999998 7.750184999999999 2.57328 7.612575C2.503965 7.542599999999999 2.46348 7.514925 2.4020249999999996 7.495469999999999C2.307375 7.465515 2.17458 7.46343 2.09823 7.490714999999999M3.3359399999999995 11.33031C3.2022299999999997 11.37426 3.0857099999999997 11.4861 3.02895 11.625C2.9950499999999995 11.707964999999998 3.002625 11.88798 3.043605 11.97297C3.1430249999999997 12.179234999999998 3.6860399999999998 12.70584 4.1325 13.029C4.50273 13.296975 4.68543 13.395 4.814654999999999 13.395C4.94355 13.395 5.11152 13.317585000000001 5.179589999999999 13.22682C5.26476 13.113254999999999 5.287215 13.049355 5.2865850000000005 12.9225C5.28609 12.82077 5.27934 12.789135 5.24229 12.714675C5.19147 12.61254 5.12952 12.55566 4.942845 12.439755C4.5888599999999995 12.219975 4.258830000000001 11.94051 3.9231599999999998 11.576324999999999C3.73302 11.370029999999998 3.66384 11.32752 3.5009399999999995 11.316855C3.43659 11.31264 3.374235 11.317725 3.3359399999999995 11.33031"
                                                    stroke="none" fill-rule="evenodd" stroke-width="0.015"></path>
                                            </svg>
                                        </span>


                                        <span class="text-sm">Reset</span>


                                        <span aria-hidden="true"
                                            class="inline-grid h-5 min-w-4.75 place-items-center rounded-xs bg-minty-200 px-1 text-center font-medium text-stone-800 transition-all duration-300 ease-out group-hover:bg-cream-50">
                                            <number-flow x-ref="filterCountFlow" x-init="$nextTick(() => $refs.filterCountFlow.update(activeFilterCount))"
                                                x-effect="$refs.filterCountFlow?.update(activeFilterCount)"
                                                class="pb-px font-roboto-mono text-xs leading-2.5 tabular-nums"></number-flow>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div
                            class="group relative grow overflow-hidden rounded-xs bg-cream-100 transition duration-300 ease-out focus-within:ring focus-within:ring-black/50 focus-within:ring-inset">

                            <div aria-hidden="true"
                                class="pointer-events-none absolute top-3.5 left-3 flex flex-col items-center justify-center">

                                <div
                                    class="size-2.5 -rotate-45 rounded-full ring-1 ring-stone-800 transition duration-500 ease-out group-focus-within:-scale-x-100">
                                </div>

                                <div class="relative -top-0.5 left-1.25 h-1.5 w-px -rotate-45 bg-stone-800"></div>
                            </div>


                            <label class="contents">
                                <span class="sr-only">
                                    Search plugins, authors, descriptions, and repos
                                </span>
                                <input x-ref="searchInput" id="plugin-search" name="search" type="search"
                                    autocomplete="off"
                                    class="-m-0.5 h-11 w-[calc(100%+4px)] border-2 border-black bg-transparent py-1.5 pr-19 pl-8.25 text-sm font-medium text-stone-800 transition-all duration-300 ease-out focus:outline-none [&::-webkit-search-cancel-button]:appearance-none"
                                    x-model.debounce.250ms="search" @focus="rotateListeningMessage()" />
                            </label>


                            <div aria-hidden="true"
                                class="pointer-events-none absolute top-3 right-2 hidden translate-y-3 text-xs opacity-0 transition duration-300 ease-out md:block"
                                :class="{
                                    'group-focus-within:opacity-100 group-focus-within:translate-y-0': search.length ===
                                        0,
                                }">
                                <div x-text="listeningMessage"></div>
                            </div>


                            <button type="button" @click="clearSearch()" aria-label="Clear search"
                                :aria-hidden="search.length === 0" :tabindex="search.length === 0 ? -1 : 0"
                                class="absolute top-1.5 right-1.5 flex h-7 items-center justify-center gap-0.75 rounded-xs bg-bone-100 pr-1.75 pl-2 text-xs opacity-0 transition-all duration-300 ease-out will-change-transform hover:bg-flamingo/60 hover:text-stone-800"
                                :class="{
                                    'pointer-events-auto opacity-100 hover:scale-95': search.length > 0,
                                    'opacity-0 scale-50 pointer-events-none': search.length === 0,
                                }">
                                <span>Clear</span>
                                <svg aria-hidden="true" class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>


                            <div wire:ignore aria-hidden="true" x-init="() => {
                                const words = gsap.utils.toArray($el.querySelectorAll('[data-word]'))
                                const tl = gsap.timeline({ repeat: -1, paused: true })

                                // Set all words hidden initially
                                gsap.set(words, {
                                    opacity: 0,
                                    y: 7,
                                })

                                words.forEach((word) => {
                                    tl.to(word, {
                                        opacity: 1,
                                        y: 0,
                                        duration: 0.4,
                                        ease: 'sine.out',
                                    }).to(
                                        word, {
                                            opacity: 0,
                                            y: -7,
                                            duration: 0.4,
                                            ease: 'sine.in',
                                        },
                                        '+=1',
                                    )
                                })

                                motion.inView($el, () => {
                                    tl.play()
                                    return () => tl.pause()
                                })
                            }"
                                class="pointer-events-none absolute top-2.5 left-8 transition duration-300 ease-out group-focus-within:-translate-y-2 group-focus-within:opacity-0"
                                :class="search.length > 0 ? 'opacity-0' : 'opacity-100'">
                                <div class="flex items-center gap-0.75 text-sm">
                                    <span>Search</span>
                                    <span class="grid font-medium text-stone-800">
                                        <span data-word class="self-center justify-self-start [grid-area:1/-1]">
                                            plugins
                                        </span>
                                        <span data-word
                                            class="self-center justify-self-start opacity-0 [grid-area:1/-1]">
                                            authors
                                        </span>
                                        <span data-word
                                            class="self-center justify-self-start opacity-0 [grid-area:1/-1]">
                                            descriptions
                                        </span>
                                        <span data-word
                                            class="self-center justify-self-start opacity-0 [grid-area:1/-1]">
                                            repos
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </search>


                    <div id="filters-panel" x-ref="filtersContainer" x-show="showFilters" x-collapse
                        style="display: none">
                        <div class="mt-5 flex flex-wrap items-center gap-x-7 gap-y-4">

                            <fieldset class="flex basis-full flex-col gap-2 sm:flex-row sm:items-center">
                                <legend class="float-left text-sm">Features:</legend>
                                <div class="flex flex-wrap gap-2">

                                    <button type="button" x-on:click="filterDarkMode = !filterDarkMode"
                                        :aria-pressed="filterDarkMode"
                                        :class="filterDarkMode ? 'bg-honey-100 font-medium text-stone-800' :
                                            'bg-cream-100 hover:bg-honey-100/50'"
                                        class="inline-flex h-9 cursor-pointer items-center justify-center gap-1.5 rounded-xs px-3 text-sm transition duration-300 ease-out select-none focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset active:scale-95">
                                        <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 18 18" fill="none">
                                            <path class="fill-current"
                                                d="M17.8202 6.5799C17.8202 6.86649 17.5879 7.09882 17.3013 7.09884H15.7445V8.65566C15.744 9.05515 15.3113 9.30431 14.9655 9.10418C14.8054 9.0115 14.7068 8.84063 14.7066 8.65566V7.09884H13.1497C12.7503 7.09837 12.5011 6.66563 12.7012 6.3199C12.7939 6.15982 12.9648 6.06116 13.1497 6.06095H14.7066V4.50412C14.707 4.10464 15.1398 3.85547 15.4855 4.05561C15.6456 4.14828 15.7442 4.31915 15.7445 4.50412V6.06095H17.3013C17.5879 6.06096 17.8202 6.29329 17.8202 6.5799ZM9.69013 2.94729H10.555V3.8122C10.5555 4.21168 10.9882 4.46085 11.334 4.26071C11.494 4.16804 11.5927 3.99717 11.5929 3.8122V2.94729H12.4578C12.8573 2.94683 13.1065 2.51409 12.9063 2.16835C12.8137 2.00827 12.6428 1.90963 12.4578 1.90941H11.5929V1.04451C11.5925 0.645021 11.1597 0.395847 10.814 0.595992C10.6539 0.688664 10.5552 0.859537 10.555 1.04451V1.90941H9.69013C9.29064 1.90987 9.04147 2.34262 9.24162 2.68834C9.33429 2.84842 9.50516 2.94708 9.69013 2.94729ZM15.8526 11.6206C15.9755 11.7638 16.011 11.9626 15.9451 12.1395C13.7932 18.0165 6.08626 19.3601 2.0726 14.558C-1.53851 10.2375 0.229642 3.64308 5.51783 1.70875C5.89324 1.57216 6.27573 1.89317 6.20632 2.28658C6.20576 2.28974 6.20518 2.29288 6.20457 2.29602C5.25629 7.1087 8.93646 11.5903 13.8417 11.5963C14.3506 11.5965 14.8584 11.5473 15.3578 11.4493C15.5416 11.4129 15.7306 11.4784 15.8526 11.6206ZM14.6097 12.6014C14.3548 12.6233 14.0988 12.6342 13.8417 12.6342C8.97177 12.6285 5.02536 8.6821 5.01965 3.8122C5.01965 3.55561 5.0306 3.2996 5.05251 3.04416C0.20274 5.55153 -0.114067 12.3687 4.48225 15.315C7.99855 17.569 12.6915 16.3115 14.6097 12.6014Z" />
                                        </svg>
                                        <span>Dark mode ready</span>
                                    </button>


                                    <button type="button" x-on:click="filterMultilingual = !filterMultilingual"
                                        :aria-pressed="filterMultilingual"
                                        :class="filterMultilingual ? 'bg-honey-100 font-medium text-stone-800' :
                                            'bg-cream-100 hover:bg-honey-100/50'"
                                        class="inline-flex h-9 cursor-pointer items-center justify-center gap-1.5 rounded-xs px-3 text-sm transition duration-300 ease-out select-none focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset active:scale-95">
                                        <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 18 18" fill="none">
                                            <path class="fill-current"
                                                d="M17.7694 16.162L13.2792 7.18163C13.1141 6.85017 12.652 6.82185 12.4475 7.13064C12.4367 7.14702 12.4269 7.16405 12.4181 7.18163L10.63 10.7577C9.13564 10.6958 7.69742 10.171 6.51429 9.25594C7.88973 7.84927 8.71042 5.99289 8.82514 4.02887H10.9243C11.2946 4.02886 11.5261 3.62794 11.3409 3.30722C11.255 3.15838 11.0962 3.06669 10.9243 3.06669H6.27374V1.62341C6.27374 1.25307 5.87284 1.0216 5.55211 1.20677C5.40326 1.29271 5.31156 1.45153 5.31156 1.62341V3.06669H0.661006C0.290663 3.06671 0.059194 3.46762 0.244376 3.78835C0.330319 3.93718 0.489141 4.02887 0.661006 4.02887H7.86055C7.74636 5.7576 7.01207 7.38702 5.79265 8.61769C5.04469 7.86391 4.4727 6.95403 4.11765 5.95324C4.00264 5.60121 3.54967 5.50569 3.3023 5.78132C3.18194 5.91543 3.14662 6.10557 3.2108 6.27397C3.60654 7.39169 4.24138 8.40962 5.07101 9.25674C3.80948 10.2355 2.25772 10.7659 0.661006 10.7642C0.290663 10.7642 0.059194 11.1651 0.244376 11.4858C0.330319 11.6347 0.489134 11.7263 0.661006 11.7263C2.52905 11.7281 4.34089 11.0874 5.79265 9.91183C7.044 10.9207 8.56464 11.539 10.165 11.6895L7.9287 16.162C7.76329 16.4935 8.01871 16.8797 8.38847 16.8572C8.56008 16.8468 8.71309 16.7456 8.78986 16.5918L9.93887 14.2922H15.7585L16.9083 16.5918C16.9897 16.755 17.1565 16.858 17.3389 16.858C17.4136 16.8582 17.4872 16.8406 17.5538 16.8067C17.7912 16.6881 17.8877 16.3996 17.7694 16.162ZM10.42 13.33L12.8487 8.47256L15.2774 13.33H10.42Z" />
                                        </svg>
                                        <span>Multilingual support</span>
                                    </button>


                                    <button type="button" x-on:click="filterFeatured = !filterFeatured"
                                        :aria-pressed="filterFeatured"
                                        :class="filterFeatured ?
                                            'bg-honey-100 font-medium text-stone-800 [--icon-stroke:var(--color-stone-800)]' :
                                            'bg-cream-100 hover:bg-honey-100/50 [--icon-stroke:var(--color-stone-600)]'"
                                        class="inline-flex h-9 cursor-pointer items-center justify-center gap-1.5 rounded-xs px-3 text-sm transition duration-300 ease-out select-none focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset active:scale-95">
                                        <svg class="size-4 text-transparent" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                                            <path
                                                d="M8.08887 0.989258C8.31973 0.427753 9.07211 0.326095 9.44336 0.806641C9.4865 0.862481 9.52201 0.923989 9.54883 0.989258V0.991211L11.3418 5.33105L11.458 5.61328L11.7637 5.63867L16.4102 6.0127V6.01367C17.0215 6.06538 17.3475 6.75913 16.9971 7.2627C16.9591 7.31722 16.9145 7.36673 16.8643 7.41016L15.5156 8.57422L15.5205 8.57324L13.3232 10.4697L13.0938 10.668L13.1631 10.9629L14.2432 15.5381L14.2441 15.54C14.3864 16.1331 13.8328 16.6577 13.248 16.4844C13.1823 16.4648 13.1191 16.4371 13.0605 16.4014H13.0615L9.08301 13.9531L8.82031 13.792L8.55859 13.9531L4.5791 16.4004C4.05796 16.7169 3.38971 16.3508 3.37598 15.7412C3.37445 15.6735 3.38178 15.6059 3.39746 15.54V15.5391L4.48145 10.9629L4.55176 10.668L4.32129 10.4697L0.776367 7.41016C0.312197 7.00899 0.456622 6.25511 1.03613 6.05371C1.09645 6.03279 1.1591 6.01868 1.22266 6.0127L1.22363 6.01367L5.87305 5.63867L6.17773 5.61328L6.29492 5.33105L8.08789 0.991211L8.08887 0.989258Z"
                                                class="fill-current stroke-(--icon-stroke) [stroke-width:var(--stroke-width,1)]" />
                                        </svg>
                                        <span>Featured</span>
                                    </button>


                                    <button type="button" x-on:click="filterOfficial = !filterOfficial"
                                        :aria-pressed="filterOfficial"
                                        :class="filterOfficial ? 'bg-honey-100 font-medium text-stone-800' :
                                            'bg-cream-100 hover:bg-honey-100/50'"
                                        class="inline-flex h-9 cursor-pointer items-center justify-center gap-1.5 rounded-xs px-3 text-sm transition duration-300 ease-out select-none focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset active:scale-95">
                                        <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                        <span>Official</span>
                                    </button>
                                </div>
                            </fieldset>


                            <fieldset class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                <legend class="float-left text-sm" id="version-filter-label">
                                    Version:
                                </legend>
                                <div class="tab-switcher relative grid auto-cols-fr grid-flow-col rounded-xs bg-cream-100 has-[input:nth-of-type(2)]:[--count:2] has-[input:nth-of-type(3)]:[--count:3] has-[input:nth-of-type(4)]:[--count:4] has-[input:nth-of-type(5)]:[--count:5] has-[input:nth-of-type(6)]:[--count:6] has-[input:nth-of-type(7)]:[--count:7] has-[input:nth-of-type(8)]:[--count:8] has-[:checked:nth-of-type(1)]:[--active:0] has-[:checked:nth-of-type(2)]:[--active:1] has-[:checked:nth-of-type(3)]:[--active:2] has-[:checked:nth-of-type(4)]:[--active:3] has-[:checked:nth-of-type(5)]:[--active:4] has-[:checked:nth-of-type(6)]:[--active:5] has-[:checked:nth-of-type(7)]:[--active:6] has-[:checked:nth-of-type(8)]:[--active:7]"
                                    aria-labelledby="version-filter-label" role="radiogroup">

                                    <div aria-hidden="true"
                                        class="pointer-events-none absolute inset-y-0 left-0 w-[calc(100%/var(--count,1))] translate-x-[calc(var(--active,0)*100%)] rounded-xs bg-honey-100 transition-all duration-400 ease-out">
                                    </div>

                                    <!--[if BLOCK]><![endif]-->
                                    <input type="radio" id="version-filter-0" name="version-filter" value="all"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedVersion" />

                                    <label for="version-filter-0"
                                        :class="{ 'font-medium text-stone-800': selectedVersion === 'all', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedVersion !== 'all', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16" fill="currentColor"
                                            preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">All</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">All</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    All
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="version-filter-1" name="version-filter" value="3"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedVersion" />

                                    <label for="version-filter-1"
                                        :class="{ 'font-medium text-stone-800': selectedVersion === '3', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedVersion !== '3', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16" fill="currentColor"
                                            preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">3.x</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">3.x</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    3.x
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="version-filter-2" name="version-filter" value="4"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedVersion" />

                                    <label for="version-filter-2"
                                        :class="{ 'font-medium text-stone-800': selectedVersion === '4', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedVersion !== '4', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16"
                                            fill="currentColor" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">4.x</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">4.x</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    4.x
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="version-filter-3" name="version-filter"
                                        value="5" class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedVersion" />

                                    <label for="version-filter-3"
                                        :class="{ 'font-medium text-stone-800': selectedVersion === '5', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedVersion !== '5', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">5.x</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">5.x</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    5.x
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </fieldset>


                            <fieldset class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                <legend class="float-left text-sm" id="price-filter-label">
                                    Price:
                                </legend>
                                <div class="tab-switcher relative grid auto-cols-fr grid-flow-col rounded-xs bg-cream-100 has-[input:nth-of-type(2)]:[--count:2] has-[input:nth-of-type(3)]:[--count:3] has-[input:nth-of-type(4)]:[--count:4] has-[input:nth-of-type(5)]:[--count:5] has-[input:nth-of-type(6)]:[--count:6] has-[input:nth-of-type(7)]:[--count:7] has-[input:nth-of-type(8)]:[--count:8] has-[:checked:nth-of-type(1)]:[--active:0] has-[:checked:nth-of-type(2)]:[--active:1] has-[:checked:nth-of-type(3)]:[--active:2] has-[:checked:nth-of-type(4)]:[--active:3] has-[:checked:nth-of-type(5)]:[--active:4] has-[:checked:nth-of-type(6)]:[--active:5] has-[:checked:nth-of-type(7)]:[--active:6] has-[:checked:nth-of-type(8)]:[--active:7]"
                                    aria-labelledby="price-filter-label" role="radiogroup">

                                    <div aria-hidden="true"
                                        class="pointer-events-none absolute inset-y-0 left-0 w-[calc(100%/var(--count,1))] translate-x-[calc(var(--active,0)*100%)] rounded-xs bg-honey-100 transition-all duration-400 ease-out">
                                    </div>

                                    <!--[if BLOCK]><![endif]-->
                                    <input type="radio" id="price-filter-0" name="price-filter" value="all"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedPrice" />

                                    <label for="price-filter-0"
                                        :class="{ 'font-medium text-stone-800': selectedPrice === 'all', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedPrice !== 'all', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16"
                                            fill="currentColor" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">All</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">All</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    All
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="price-filter-1" name="price-filter" value="free"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedPrice" />

                                    <label for="price-filter-1"
                                        :class="{ 'font-medium text-stone-800': selectedPrice === 'free', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedPrice !== 'free', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16"
                                            fill="currentColor" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">Free</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">Free</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    Free
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="price-filter-2" name="price-filter" value="paid"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedPrice" />

                                    <label for="price-filter-2"
                                        :class="{ 'font-medium text-stone-800': selectedPrice === 'paid', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedPrice !== 'paid', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">Paid</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">Paid</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    Paid
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </fieldset>


                            <fieldset class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                <legend class="float-left text-sm" id="score-filter-label">
                                    Score:
                                </legend>
                                <div class="tab-switcher relative grid auto-cols-fr grid-flow-col rounded-xs bg-cream-100 has-[input:nth-of-type(2)]:[--count:2] has-[input:nth-of-type(3)]:[--count:3] has-[input:nth-of-type(4)]:[--count:4] has-[input:nth-of-type(5)]:[--count:5] has-[input:nth-of-type(6)]:[--count:6] has-[input:nth-of-type(7)]:[--count:7] has-[input:nth-of-type(8)]:[--count:8] has-[:checked:nth-of-type(1)]:[--active:0] has-[:checked:nth-of-type(2)]:[--active:1] has-[:checked:nth-of-type(3)]:[--active:2] has-[:checked:nth-of-type(4)]:[--active:3] has-[:checked:nth-of-type(5)]:[--active:4] has-[:checked:nth-of-type(6)]:[--active:5] has-[:checked:nth-of-type(7)]:[--active:6] has-[:checked:nth-of-type(8)]:[--active:7]"
                                    aria-labelledby="score-filter-label" role="radiogroup">

                                    <div aria-hidden="true"
                                        class="pointer-events-none absolute inset-y-0 left-0 w-[calc(100%/var(--count,1))] translate-x-[calc(var(--active,0)*100%)] rounded-xs bg-honey-100 transition-all duration-400 ease-out">
                                    </div>

                                    <!--[if BLOCK]><![endif]-->
                                    <input type="radio" id="score-filter-0" name="score-filter" value="all"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedMinScore" />

                                    <label for="score-filter-0"
                                        :class="{ 'font-medium text-stone-800': selectedMinScore === 'all', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedMinScore !== 'all', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16"
                                            fill="currentColor" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">Any</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">Any</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    Any
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="score-filter-1" name="score-filter" value="60"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedMinScore" />

                                    <label for="score-filter-1"
                                        :class="{ 'font-medium text-stone-800': selectedMinScore === '60', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedMinScore !== '60', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16"
                                            fill="currentColor" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">60+</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">60+</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    60+
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="score-filter-2" name="score-filter" value="80"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedMinScore" />

                                    <label for="score-filter-2"
                                        :class="{ 'font-medium text-stone-800': selectedMinScore === '80', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedMinScore !== '80', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--> <svg aria-hidden="true"
                                            class="pointer-events-none absolute top-1/2 right-0 h-full w-px -translate-y-1/2 text-bone-300"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 16"
                                            fill="currentColor" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="4" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="9" width="1" height="2.5" rx="0.5" />
                                            <rect x="0" y="14" width="1" height="2.5" rx="0.5" />
                                        </svg>
                                        <!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">80+</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">80+</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    80+
                                                </span>
                                            </span>
                                        </span>
                                    </label>

                                    <input type="radio" id="score-filter-3" name="score-filter" value="100"
                                        class="peer absolute size-full cursor-pointer opacity-0"
                                        x-model="selectedMinScore" />

                                    <label for="score-filter-3"
                                        :class="{ 'font-medium text-stone-800': selectedMinScore === '100', 'hover:bg-honey-100/50 hover:font-medium hover:text-stone-800': selectedMinScore !== '100', }"
                                        class="relative z-10 flex h-9 cursor-pointer items-center justify-center px-3 text-sm transition-all duration-400 ease-out select-none peer-focus-visible:ring peer-focus-visible:ring-black/50 peer-focus-visible:ring-inset first:rounded-l-xs last:rounded-r-xs">

                                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                        <span class="sr-only">100</span>

                                        <span class="flex items-center gap-1.5" aria-hidden="true">
                                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                            <span class="grid [grid-template-areas:'text']">
                                                <span class="[grid-area:text]">100</span>
                                                <span class="invisible font-medium select-none [grid-area:text]">
                                                    100
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </fieldset>
                        </div>


                        <fieldset class="mt-4">
                            <legend class="mb-2 text-sm">Tags:</legend>
                            <div class="flex flex-wrap gap-2 pb-2 xs:pb-0" role="group"
                                aria-label="Filter by tags">
                                <template x-for="tag in availableTags" :key="tag">
                                    <button type="button" x-on:click="toggleTag(tag)"
                                        :aria-pressed="isTagSelected(tag)"
                                        class="inline-flex h-8 shrink-0 cursor-pointer items-center gap-1.25 rounded-xs pr-1.75 pl-2.5 text-sm transition-all duration-300 ease-out select-none focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset active:scale-95"
                                        :class="isTagSelected(tag) ?
                                            'bg-honey-100 font-medium text-stone-800' :
                                            'bg-cream-100 hover:bg-honey-100/50'">
                                        <span x-text="tagLabels[tag] || tag"></span>
                                        <span aria-hidden="true"
                                            class="inline-grid size-3.5 place-items-center overflow-hidden">

                                            <span
                                                class="self-center justify-self-center transition duration-300 ease-out [grid-area:1/-1]"
                                                :class="isTagSelected(tag) ? 'opacity-0 scale-0' : 'opacity-100 scale-100'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5v14" />
                                                </svg>
                                            </span>

                                            <span
                                                class="self-center justify-self-center transition duration-300 ease-out [grid-area:1/-1]"
                                                :class="isTagSelected(tag) ? 'opacity-100 scale-100' : 'opacity-0 scale-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                        </span>
                                    </button>
                                </template>
                            </div>
                        </fieldset>
                    </div>


                    <div class="custom-top-dashed-border mt-5 flex flex-wrap items-center justify-between gap-4 pt-5">

                        <div class="flex flex-wrap items-center gap-4">

                            <div class="flex items-center gap-1 text-xs">
                                <span>Sort by:</span>
                                <div class="relative" x-data="{ open: false }" @click.outside="open = false"
                                    @keydown.escape.window="open = false">
                                    <label for="sort-select" class="sr-only">
                                        Sort plugins by
                                    </label>
                                    <button id="sort-select" type="button" @click="open = !open"
                                        :aria-expanded="open" aria-haspopup="listbox"
                                        class="group inline-flex h-8 items-center gap-1.5 rounded-xs bg-cream-100 pr-1.5 pl-2.5 transition-colors duration-300 ease-out hover:bg-bone-100/70 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset">
                                        <span class="font-medium text-stone-800"
                                            x-text="JSON.parse('{\u0022newest\u0022:\u0022Newest\u0022,\u0022oldest\u0022:\u0022Oldest\u0022,\u0022popular\u0022:\u0022Popular\u0022,\u0022score\u0022:\u0022Health score\u0022,\u0022name-asc\u0022:\u0022Name A-Z\u0022,\u0022name-desc\u0022:\u0022Name Z-A\u0022}')[sortBy]">
                                            Newest
                                        </span>
                                        <div class="transition-transform duration-300 ease-out"
                                            :class="open && 'rotate-180'" aria-hidden="true">
                                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m6 9 6 6 6-6" />
                                            </svg>
                                        </div>
                                    </button>

                                    <div x-show="open" x-cloak
                                        x-transition:enter="transition duration-300 ease-out"
                                        x-transition:enter-start="-translate-y-1 opacity-0"
                                        x-transition:enter-end="translate-y-0 opacity-100"
                                        x-transition:leave="transition duration-150 ease-in"
                                        x-transition:leave-start="translate-y-0 opacity-100"
                                        x-transition:leave-end="-translate-y-1 opacity-0"
                                        class="absolute top-full left-0 z-20 mt-1 min-w-35 overflow-hidden rounded-xs border border-black/20 bg-cream-50 shadow-lg"
                                        role="listbox" aria-label="Sort options">
                                        <!--[if BLOCK]><![endif]--> <button type="button" role="option"
                                            :aria-selected="sortBy === 'newest'"
                                            @click="sortBy = 'newest'; open = false"
                                            class="flex w-full items-center gap-2 px-3 py-2 text-left transition-colors duration-150 hover:bg-bone-100/70"
                                            :class="sortBy === 'newest' && 'bg-bone-100 font-medium text-stone-800'">
                                            <span class="size-3.5"
                                                :class="sortBy === 'newest' ? 'opacity-100' : 'opacity-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                            Newest
                                        </button>
                                        <button type="button" role="option"
                                            :aria-selected="sortBy === 'oldest'"
                                            @click="sortBy = 'oldest'; open = false"
                                            class="flex w-full items-center gap-2 px-3 py-2 text-left transition-colors duration-150 hover:bg-bone-100/70"
                                            :class="sortBy === 'oldest' && 'bg-bone-100 font-medium text-stone-800'">
                                            <span class="size-3.5"
                                                :class="sortBy === 'oldest' ? 'opacity-100' : 'opacity-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                            Oldest
                                        </button>
                                        <button type="button" role="option"
                                            :aria-selected="sortBy === 'popular'"
                                            @click="sortBy = 'popular'; open = false"
                                            class="flex w-full items-center gap-2 px-3 py-2 text-left transition-colors duration-150 hover:bg-bone-100/70"
                                            :class="sortBy === 'popular' && 'bg-bone-100 font-medium text-stone-800'">
                                            <span class="size-3.5"
                                                :class="sortBy === 'popular' ? 'opacity-100' : 'opacity-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                            Popular
                                        </button>
                                        <button type="button" role="option"
                                            :aria-selected="sortBy === 'score'"
                                            @click="sortBy = 'score'; open = false"
                                            class="flex w-full items-center gap-2 px-3 py-2 text-left transition-colors duration-150 hover:bg-bone-100/70"
                                            :class="sortBy === 'score' && 'bg-bone-100 font-medium text-stone-800'">
                                            <span class="size-3.5"
                                                :class="sortBy === 'score' ? 'opacity-100' : 'opacity-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                            Health score
                                        </button>
                                        <button type="button" role="option"
                                            :aria-selected="sortBy === 'name-asc'"
                                            @click="sortBy = 'name-asc'; open = false"
                                            class="flex w-full items-center gap-2 px-3 py-2 text-left transition-colors duration-150 hover:bg-bone-100/70"
                                            :class="sortBy === 'name-asc' && 'bg-bone-100 font-medium text-stone-800'">
                                            <span class="size-3.5"
                                                :class="sortBy === 'name-asc' ? 'opacity-100' : 'opacity-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                            Name A-Z
                                        </button>
                                        <button type="button" role="option"
                                            :aria-selected="sortBy === 'name-desc'"
                                            @click="sortBy = 'name-desc'; open = false"
                                            class="flex w-full items-center gap-2 px-3 py-2 text-left transition-colors duration-150 hover:bg-bone-100/70"
                                            :class="sortBy === 'name-desc' && 'bg-bone-100 font-medium text-stone-800'">
                                            <span class="size-3.5"
                                                :class="sortBy === 'name-desc' ? 'opacity-100' : 'opacity-0'">
                                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            </span>
                                            Name Z-A
                                        </button>
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>


                            <div class="flex items-center gap-1 text-xs">
                                <span aria-hidden="true">Items found:</span>
                                <span
                                    class="inline-grid h-8 min-w-9 place-items-center rounded-xs bg-cream-100 px-1.5 font-medium text-stone-800"
                                    aria-label="1 items found" role="status">
                                    <number-flow x-ref="itemCountFlow" x-init="$nextTick(() => $refs.itemCountFlow.update(1))"
                                        aria-hidden="true">
                                        1
                                    </number-flow>
                                </span>
                            </div>
                        </div>


                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <h2 id="plugins-results-heading" class="sr-only">
                        Plugins
                    </h2>


                    <div wire:loading.class="opacity-50 pointer-events-none"
                        class="mt-5 grid grid-cols-[repeat(auto-fill,minmax(20rem,1fr))] items-start gap-7 transition-opacity duration-300"
                        x-init="autoAnimate($el, { duration: 250 })" aria-label="Plugin list">
                        <!--[if BLOCK]><![endif]--> <a href="https://filamentphp.com/plugins/aureus-erp-progress-bar"
                            class="group row-span-5 grid grid-rows-subgrid gap-0 rounded-xs p-5 bg-cream-100"
                            wire:key="plugin-019db4af-8a43-707a-bd4a-5afb5efa20e3"
                            aria-label="View Progress Bar plugin page">

                            <div class="flex flex-col gap-1">

                                <div class="shrink-0 self-start" aria-hidden="true">
                                    <svg class="h-2.25 text-stone-600" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>


                                <div class="px-3">
                                    <div
                                        class="aspect-video overflow-hidden rounded-xs ring ring-cocoa transition duration-300 ease-out group-hover:scale-101">
                                        <!--[if BLOCK]><![endif]--> <img
                                            src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019db4af-8b03-733c-9683-e6631409c99a/conversions/01KPTAZ2P684AJXC8CNY1AFR01-optimized.webp"
                                            alt="Progress Bar plugin thumbnail" class="size-full object-cover"
                                            loading="lazy" />
                                        <!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>


                                <div class="shrink-0 self-end" aria-hidden="true">
                                    <svg class="h-2.25 -scale-x-100 -scale-y-100 text-stone-600"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" fill="none">
                                        <path d="M9.5 0.5H0.5V9.5" class="stroke-current" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>


                            <div class="mt-3 flex flex-col gap-1">
                                <div
                                    class="relative transition duration-300 ease-out will-change-transform group-hover:translate-x-4.5">

                                    <div x-data x-init="() => {
                                        const tweens = []
                                        let playing = false

                                        const rotatingEl = $el.querySelector('[data-rotating]')
                                        const rotate = () => {
                                            gsap.to(rotatingEl, {
                                                rotation: '+=60',
                                                duration: 0.5,
                                                ease: 'sine.out',
                                                onComplete: () => {
                                                    if (playing) gsap.delayedCall(0.5, rotate)
                                                },
                                            })
                                        }

                                        const boxes = $el.querySelectorAll('[data-box]')
                                        const delays = [0, 0.2, 0.1]
                                        boxes.forEach((box, i) => {
                                            tweens.push(
                                                gsap.to(box, {
                                                    opacity: 0.3,
                                                    repeat: -1,
                                                    yoyo: true,
                                                    duration: 0.4,
                                                    delay: delays[i] || 0,
                                                    ease: 'power1.inOut',
                                                    paused: true,
                                                }),
                                            )
                                        })

                                        const group = $el.closest('.group')
                                        if (group) {
                                            group.addEventListener('mouseenter', () => {
                                                playing = true
                                                tweens.forEach((t) => t.resume())
                                                rotate()
                                            })
                                            group.addEventListener('mouseleave', () => {
                                                playing = false
                                                tweens.forEach((t) => t.pause())
                                            })
                                        }
                                    }"
                                        class="absolute top-1/2 -left-4 -translate-y-1/2">
                                        <div
                                            class="translate-x-0.5 opacity-0 transition duration-300 ease-out will-change-transform group-hover:translate-x-0 group-hover:opacity-100">
                                            <div data-rotating class="flex items-center gap-0.75">
                                                <div class="flex flex-col gap-1">

                                                    <div data-box class="size-0.75 bg-current"></div>


                                                    <div data-box class="size-0.75 bg-current"></div>
                                                </div>


                                                <div data-box class="size-0.75 bg-current"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <p class="line-clamp-1 font-outfit font-medium text-stone-800">
                                        Progress Bar
                                    </p>
                                </div>


                                <p class="line-clamp-2 text-sm">
                                    A feature-rich Filament v5 table column &amp; infolist entry that renders progress
                                    as a horizontal bar. Built for dashboards, task progress, capacity gauges, skill
                                    levels, and any numeric value that fits on a 0–100% (or custom min–max) scale.
                                </p>
                            </div>


                            <div class="mt-5 flex items-center justify-between gap-3">

                                <div class="ml-px flex min-w-0 items-center gap-2">


                                    <!--[if BLOCK]><![endif]--> <img
                                        src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019dafa6-fd22-73a8-a45b-1f6573e36360/conversions/01KPQTDZ752EJ1DFJAN717T1WM-optimized.webp"
                                        alt="Aureus ERP avatar"
                                        class="size-7 shrink-0 rounded-xs object-cover ring ring-black/50"
                                        loading="lazy" />
                                    <!--[if ENDBLOCK]><![endif]-->

                                    <span class="max-w-40 truncate text-sm">
                                        <span class="sr-only">Author:</span>
                                        <strong>Aureus ERP</strong>
                                    </span>
                                </div>


                                <div class="flex shrink-0 items-center gap-3 text-sm">

                                    <!--[if BLOCK]><![endif]-->
                                    <div class="flex items-center gap-1.5" title="Package health score: 65 / 100">
                                        <span class="bg-honey-200 size-2 shrink-0 rounded-full ring-1 ring-stone-800"
                                            aria-hidden="true"></span>
                                        <strong>65</strong>
                                        <span class="text-stone-500">/ 100</span>
                                        <span class="sr-only">package health score out of 100</span>
                                    </div>
                                    <!--[if ENDBLOCK]><![endif]-->

                                    <div class="flex items-center gap-1" title="1 star">
                                        <svg class="size-4 text-honey-200/70 [--icon-stroke:var(--color-stone-800)]"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 18 18" fill="none">
                                            <path
                                                d="M8.08887 0.989258C8.31973 0.427753 9.07211 0.326095 9.44336 0.806641C9.4865 0.862481 9.52201 0.923989 9.54883 0.989258V0.991211L11.3418 5.33105L11.458 5.61328L11.7637 5.63867L16.4102 6.0127V6.01367C17.0215 6.06538 17.3475 6.75913 16.9971 7.2627C16.9591 7.31722 16.9145 7.36673 16.8643 7.41016L15.5156 8.57422L15.5205 8.57324L13.3232 10.4697L13.0938 10.668L13.1631 10.9629L14.2432 15.5381L14.2441 15.54C14.3864 16.1331 13.8328 16.6577 13.248 16.4844C13.1823 16.4648 13.1191 16.4371 13.0605 16.4014H13.0615L9.08301 13.9531L8.82031 13.792L8.55859 13.9531L4.5791 16.4004C4.05796 16.7169 3.38971 16.3508 3.37598 15.7412C3.37445 15.6735 3.38178 15.6059 3.39746 15.54V15.5391L4.48145 10.9629L4.55176 10.668L4.32129 10.4697L0.776367 7.41016C0.312197 7.00899 0.456622 6.25511 1.03613 6.05371C1.09645 6.03279 1.1591 6.01868 1.22266 6.0127L1.22363 6.01367L5.87305 5.63867L6.17773 5.61328L6.29492 5.33105L8.08789 0.991211L8.08887 0.989258Z"
                                                class="fill-current stroke-(--icon-stroke) [stroke-width:var(--stroke-width,1)]" />
                                        </svg>
                                        <strong>1</strong>
                                        <span class="sr-only">
                                            star
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-3.75 mb-3 flex flex-wrap items-center gap-1.5">

                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]-->
                                <span
                                    class="inline-flex items-center rounded-xs font-medium text-stone-800 h-7 px-2 text-xs bg-bone-100">
                                    <span class="sr-only">Tag:</span>
                                    Developer Tool
                                </span>
                                <!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                <div class="grow"></div>


                                <span
                                    class="inline-grid size-8 place-items-center rounded-xs text-stone-800 bg-honey-100"
                                    title="Dark mode ready">
                                    <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 18 18" fill="none">
                                        <path class="fill-current"
                                            d="M17.8202 6.5799C17.8202 6.86649 17.5879 7.09882 17.3013 7.09884H15.7445V8.65566C15.744 9.05515 15.3113 9.30431 14.9655 9.10418C14.8054 9.0115 14.7068 8.84063 14.7066 8.65566V7.09884H13.1497C12.7503 7.09837 12.5011 6.66563 12.7012 6.3199C12.7939 6.15982 12.9648 6.06116 13.1497 6.06095H14.7066V4.50412C14.707 4.10464 15.1398 3.85547 15.4855 4.05561C15.6456 4.14828 15.7442 4.31915 15.7445 4.50412V6.06095H17.3013C17.5879 6.06096 17.8202 6.29329 17.8202 6.5799ZM9.69013 2.94729H10.555V3.8122C10.5555 4.21168 10.9882 4.46085 11.334 4.26071C11.494 4.16804 11.5927 3.99717 11.5929 3.8122V2.94729H12.4578C12.8573 2.94683 13.1065 2.51409 12.9063 2.16835C12.8137 2.00827 12.6428 1.90963 12.4578 1.90941H11.5929V1.04451C11.5925 0.645021 11.1597 0.395847 10.814 0.595992C10.6539 0.688664 10.5552 0.859537 10.555 1.04451V1.90941H9.69013C9.29064 1.90987 9.04147 2.34262 9.24162 2.68834C9.33429 2.84842 9.50516 2.94708 9.69013 2.94729ZM15.8526 11.6206C15.9755 11.7638 16.011 11.9626 15.9451 12.1395C13.7932 18.0165 6.08626 19.3601 2.0726 14.558C-1.53851 10.2375 0.229642 3.64308 5.51783 1.70875C5.89324 1.57216 6.27573 1.89317 6.20632 2.28658C6.20576 2.28974 6.20518 2.29288 6.20457 2.29602C5.25629 7.1087 8.93646 11.5903 13.8417 11.5963C14.3506 11.5965 14.8584 11.5473 15.3578 11.4493C15.5416 11.4129 15.7306 11.4784 15.8526 11.6206ZM14.6097 12.6014C14.3548 12.6233 14.0988 12.6342 13.8417 12.6342C8.97177 12.6285 5.02536 8.6821 5.01965 3.8122C5.01965 3.55561 5.0306 3.2996 5.05251 3.04416C0.20274 5.55153 -0.114067 12.3687 4.48225 15.315C7.99855 17.569 12.6915 16.3115 14.6097 12.6014Z" />
                                    </svg>
                                    <span class="sr-only">
                                        Dark mode ready
                                    </span>
                                </span>

                                <span
                                    class="inline-grid size-8 place-items-center rounded-xs text-stone-800 bg-honey-100"
                                    title="Multilingual support">
                                    <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 18 18" fill="none">
                                        <path class="fill-current"
                                            d="M17.7694 16.162L13.2792 7.18163C13.1141 6.85017 12.652 6.82185 12.4475 7.13064C12.4367 7.14702 12.4269 7.16405 12.4181 7.18163L10.63 10.7577C9.13564 10.6958 7.69742 10.171 6.51429 9.25594C7.88973 7.84927 8.71042 5.99289 8.82514 4.02887H10.9243C11.2946 4.02886 11.5261 3.62794 11.3409 3.30722C11.255 3.15838 11.0962 3.06669 10.9243 3.06669H6.27374V1.62341C6.27374 1.25307 5.87284 1.0216 5.55211 1.20677C5.40326 1.29271 5.31156 1.45153 5.31156 1.62341V3.06669H0.661006C0.290663 3.06671 0.059194 3.46762 0.244376 3.78835C0.330319 3.93718 0.489141 4.02887 0.661006 4.02887H7.86055C7.74636 5.7576 7.01207 7.38702 5.79265 8.61769C5.04469 7.86391 4.4727 6.95403 4.11765 5.95324C4.00264 5.60121 3.54967 5.50569 3.3023 5.78132C3.18194 5.91543 3.14662 6.10557 3.2108 6.27397C3.60654 7.39169 4.24138 8.40962 5.07101 9.25674C3.80948 10.2355 2.25772 10.7659 0.661006 10.7642C0.290663 10.7642 0.059194 11.1651 0.244376 11.4858C0.330319 11.6347 0.489134 11.7263 0.661006 11.7263C2.52905 11.7281 4.34089 11.0874 5.79265 9.91183C7.044 10.9207 8.56464 11.539 10.165 11.6895L7.9287 16.162C7.76329 16.4935 8.01871 16.8797 8.38847 16.8572C8.56008 16.8468 8.71309 16.7456 8.78986 16.5918L9.93887 14.2922H15.7585L16.9083 16.5918C16.9897 16.755 17.1565 16.858 17.3389 16.858C17.4136 16.8582 17.4872 16.8406 17.5538 16.8067C17.7912 16.6881 17.8877 16.3996 17.7694 16.162ZM10.42 13.33L12.8487 8.47256L15.2774 13.33H10.42Z" />
                                    </svg>
                                    <span class="sr-only">
                                        Multilingual support
                                    </span>
                                </span>
                            </div>

                            <div
                                class="flex h-11 items-stretch bg-bone-100 text-sm font-medium text-stone-800 transition-all duration-300 ease-out group-hover:bg-serenade-50">
                                <div class="inline-grid min-w-25 place-items-center border-r border-r-bone-500/50">
                                    <span>Free</span>
                                </div>
                                <div class="inline-flex grow items-center justify-between gap-3 px-4">
                                    <span>Get it now</span>
                                    <span class="transition duration-300 ease-out group-hover:translate-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3" viewBox="0 0 28 22"
                                            fill="none">
                                            <path class="fill-current"
                                                d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div>


                    <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                </section>
            </div>
        </div>
        <footer data-triangle-decoration="top" class="border-t border-bone-100">
            <div data-triangle-decoration="bottom" class="border-b border-bone-100 px-5 pt-5 pb-5 sm:px-8 sm:pt-8">

                <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">

                    <div class="flex flex-col items-start">

                        <div data-animate="enter-from-left">
                            <a href="https://filamentphp.com" aria-label="Filament homepage"
                                class="block transition duration-300 ease-out hover:-translate-x-2 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset">
                                <div x-init="() => {
                                    const logoInitialAnimation = $el.querySelectorAll('.logoInitialAnimation')
                                    const logoLightBulb = $el.querySelectorAll('.logoLightBulb')
                                    const logoF1 = $el.querySelectorAll('.logoF1')
                                    const logoF2 = $el.querySelectorAll('.logoF2')
                                    const logoI = $el.querySelector('.logoI')
                                    const logoIDot = $el.querySelector('.logoIDot')
                                    const logoL = $el.querySelector('.logoL')
                                    const logoA = $el.querySelector('.logoA')
                                    const logoM = $el.querySelector('.logoM')
                                    const logoE = $el.querySelector('.logoE')
                                    const logoN = $el.querySelector('.logoN')
                                    const logoT = $el.querySelector('.logoT')
                                    let isInitialAnimationComplete = false
                                    const isReversed = true

                                    if (isReversed) {
                                        gsap.set(logoLightBulb, {
                                            opacity: 1,
                                            y: 0,
                                            scale: 1,
                                            transformOrigin: '50% 50%',
                                        })
                                        gsap.set(logoF1, { x: 0, opacity: 0 })
                                        gsap.set(logoF2, { x: 0, opacity: 1 })
                                        gsap.set(logoI, { x: 0, opacity: 0 })
                                        gsap.set(logoIDot, { x: 0, opacity: 0 })
                                        gsap.set(logoL, { x: 0 })
                                        gsap.set(logoA, { x: 0 })
                                        gsap.set(logoM, { x: 0 })
                                        gsap.set(logoE, { x: 0 })
                                        gsap.set(logoN, { x: 0 })
                                        gsap.set(logoT, { x: 0 })
                                    } else {
                                        gsap.set(logoLightBulb, {
                                            opacity: 0,
                                            y: -2,
                                            scale: 0.5,
                                            transformOrigin: '50% 50%',
                                        })
                                        gsap.set(logoF1, { x: 8 })
                                        gsap.set(logoF2, { x: 8, opacity: 0 })
                                        gsap.set(logoI, { x: -2 })
                                        gsap.set(logoIDot, { x: -2 })
                                        gsap.set(logoL, { x: -11 })
                                        gsap.set(logoA, { x: -11 })
                                        gsap.set(logoM, { x: -10 })
                                        gsap.set(logoE, { x: -9 })
                                        gsap.set(logoN, { x: -9 })
                                        gsap.set(logoT, { x: -8 })
                                    }

                                    $el.removeAttribute('data-logo-pre-init')
                                    isInitialAnimationComplete = true

                                    let animation

                                    if (isReversed) {
                                        animation = gsap
                                            .timeline({ paused: true })
                                            .to(
                                                logoLightBulb, {
                                                    opacity: 0,
                                                    y: -2,
                                                    scale: 0.5,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoF1, {
                                                    x: 8,
                                                    rotation: 0,
                                                    opacity: 1,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoF2, {
                                                    x: 8,
                                                    rotation: 0,
                                                    opacity: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoI, {
                                                    x: -2,
                                                    opacity: 1,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                },
                                                0,
                                            )
                                            .to(
                                                logoIDot, {
                                                    x: -2,
                                                    opacity: 1,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                },
                                                0,
                                            )
                                            .to(
                                                logoL, {
                                                    x: -11,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoA, {
                                                    x: -11,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0.02,
                                            )
                                            .to(
                                                logoM, {
                                                    x: -10,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0.04,
                                            )
                                            .to(
                                                logoE, {
                                                    x: -9,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0.06,
                                            )
                                            .to(
                                                logoN, {
                                                    x: -9,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0.08,
                                            )
                                            .to(
                                                logoT, {
                                                    x: -8,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0.1,
                                            )
                                    } else {
                                        animation = gsap
                                            .timeline({ paused: true })
                                            .to(
                                                logoLightBulb, {
                                                    opacity: 1,
                                                    y: 0,
                                                    scale: 1,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoF1, {
                                                    x: 0,
                                                    rotation: 0,
                                                    opacity: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoF2, {
                                                    x: 0,
                                                    rotation: 0,
                                                    opacity: 1,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                            .to(
                                                logoI, {
                                                    x: 0,
                                                    color: '#efaf5d',
                                                    opacity: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                },
                                                0,
                                            )
                                            .to(
                                                logoIDot, {
                                                    x: 0,
                                                    color: '#efaf5d',
                                                    opacity: 0,
                                                    duration: 0.4,
                                                    ease: 'sine.inOut',
                                                },
                                                0,
                                            )
                                            .to(
                                                [logoL, logoA, logoM, logoE, logoN, logoT], {
                                                    x: 0,
                                                    rotation: 0,
                                                    duration: 0.4,
                                                    stagger: 0.02,
                                                    ease: 'sine.inOut',
                                                    keyframes: {
                                                        rotation: [0, -10, 0],
                                                        easeEach: 'sine.inOut',
                                                    },
                                                },
                                                0,
                                            )
                                    }

                                    motion.hover($el, () => {
                                        if (!isInitialAnimationComplete) {
                                            return
                                        }
                                        animation.play()

                                        return () => {
                                            if (!isInitialAnimationComplete) {
                                                return
                                            }
                                            animation.reverse()
                                        }
                                    })
                                }">
                                    <svg class="h-10" viewBox="0 0 144 43" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <path class="logoInitialAnimation logoF1 fill-cocoa"
                                            d="M7.223,12.685L7.223,11.42C7.223,9.471 7.871,8.001 9.813,8.001L11.55,8.001L11.55,4L9.813,4C5.349,4 3.033,6.769 3.033,11.42L3.033,12.685L0,12.685L0,16.035L3.033,16.035L3.033,28.651L7.223,28.651L7.223,16.035L12.348,16.035L12.348,12.685L7.223,12.685Z" />

                                        <path class="logoF2 fill-cocoa"
                                            d="M9.772,8.012L12.283,8.012C12.809,6.58 13.529,5.243 14.407,4.03L9.772,4.03C5.327,4.03 3.02,6.787 3.02,11.416L3.02,12.676L0,12.676L0,16.011L3.02,16.011L3.02,28.571L7.194,28.571L7.194,16.011L11.426,16.011C11.324,15.268 11.267,14.511 11.267,13.74C11.267,13.382 11.282,13.028 11.305,12.676L7.194,12.676L7.194,11.416C7.194,9.476 7.839,8.012 9.772,8.012" />

                                        <g transform="matrix(1,0,0,1,0.214531,-0.010962)">
                                            <path class="logoInitialAnimation logoI fill-cocoa"
                                                d="M27.909,12.766L28.056,11.476L25.39,11.554L25.406,11.654C25.43,11.8 25.41,11.976 25.388,12.162C25.344,12.545 25.293,12.98 25.642,13.278C25.763,13.38 26.155,13.601 26.579,13.844C26.846,13.997 27.188,14.19 27.358,14.301C27.25,14.337 27.091,14.333 26.942,14.325C26.845,14.319 26.746,14.313 26.656,14.321L26.527,14.329C26.105,14.357 25.731,14.384 25.614,14.44C25.411,14.537 25.35,14.963 25.379,15.308C25.393,15.481 25.454,15.885 25.723,16.056L27.356,17.047L25.64,17.201L25.607,17.211C25.439,17.295 25.422,17.661 25.423,17.855C25.423,18.173 25.496,18.582 25.716,18.77L27.404,19.805C27.34,19.806 27.276,19.809 27.212,19.81C26.661,19.824 26.087,19.844 25.58,19.991L25.553,20.005C25.426,20.1 25.423,20.764 25.518,21.135C25.572,21.349 25.66,21.467 25.757,21.527L27.408,22.526L25.756,22.678L25.725,22.686C25.376,22.852 25.512,23.777 25.602,24.048L25.616,24.092L27.479,25.289L25.831,25.401C25.719,25.406 25.664,25.468 25.621,25.525C25.485,25.705 25.496,26.429 25.524,27.426C25.538,27.916 25.551,28.379 25.52,28.568L25.498,28.709L27.883,28.717L27.895,27.157L30.718,26.868L30.742,26.865L30.761,26.852C30.861,26.76 30.903,26.505 30.904,26.318C30.905,26.172 30.894,25.621 30.715,25.424L28.93,24.298L30.712,24.133L30.732,24.118C30.879,24.008 30.898,23.375 30.8,22.99C30.738,22.751 30.648,22.585 30.522,22.531L28.874,21.527C29.036,21.519 29.206,21.514 29.381,21.51C29.777,21.5 30.188,21.489 30.531,21.418C30.652,21.392 30.739,21.291 30.788,21.115C30.888,20.759 30.811,20.157 30.643,19.925C30.564,19.815 30.216,19.606 29.376,19.131C29.128,18.991 28.896,18.845 28.772,18.768C28.904,18.762 29.074,18.76 29.25,18.759C29.976,18.752 30.514,18.738 30.662,18.584C30.778,18.464 30.832,17.878 30.727,17.478C30.671,17.262 30.592,17.109 30.474,17.054L28.826,16.048L30.491,15.909L30.524,15.9C30.725,15.798 30.76,15.321 30.735,15.029C30.718,14.828 30.655,14.456 30.428,14.308" />
                                        </g>

                                        <g transform="matrix(0.995789,0,0,0.995652,0.338179,0.317612)">
                                            <path class="logoInitialAnimation logoIDot fill-cocoa"
                                                d="M27.694,5C26.228,5 25,6.095 25,7.498C25,8.901 26.228,10.029 27.694,10.029C29.159,10.029 30.319,8.934 30.319,7.498C30.319,6.061 29.126,5 27.694,5Z" />
                                        </g>


                                        <rect class="logoInitialAnimation logoL fill-cocoa" x="44.27" y="4.029"
                                            width="4.139" height="24.542" />

                                        <path class="logoInitialAnimation logoA fill-cocoa"
                                            d="M59.517,24.895C57.243,24.895 55.139,23.159 55.139,20.606C55.139,18.052 57.243,16.317 59.517,16.317C61.791,16.317 63.86,17.848 63.86,20.606C63.86,23.363 61.757,24.895 59.517,24.895ZM63.86,14.649C62.706,12.879 60.365,12.335 58.94,12.335C54.766,12.335 50.864,15.5 50.864,20.606C50.864,25.711 54.766,28.877 58.94,28.877C60.501,28.877 62.842,28.162 63.86,26.528L63.86,28.571L67.999,28.571L67.999,12.675L63.86,12.675L63.86,14.649Z" />

                                        <path class="logoInitialAnimation logoM fill-cocoa"
                                            d="M89.815,12.335C88.56,12.335 86.32,12.709 84.827,15.331C83.945,13.39 82.282,12.505 79.772,12.369C78.278,12.369 76.106,13.084 75.225,15.024L75.225,12.676L71.085,12.676L71.085,28.572L75.225,28.572L75.225,20.096C75.225,17.374 76.853,16.386 78.55,16.386C80.247,16.386 81.434,17.611 81.468,19.824L81.468,28.571L85.608,28.571L85.608,20.096C85.608,17.679 86.965,16.385 88.832,16.385C90.528,16.385 91.818,17.645 91.818,19.925L91.818,28.571L95.924,28.571L95.924,19.483C95.924,14.819 93.65,12.335 89.816,12.335" />

                                        <path class="logoInitialAnimation logoE fill-cocoa"
                                            d="M102.121,19.176C102.427,17.031 104.123,15.806 106.295,15.806C108.331,15.806 109.959,16.997 110.265,19.176L102.121,19.176ZM106.261,12.335C101.748,12.335 98.05,15.569 98.05,20.572C98.05,25.576 101.748,28.912 106.261,28.912C109.179,28.912 112.233,27.788 113.658,25.065C112.64,24.52 111.487,23.908 110.503,23.363C109.757,24.725 108.128,25.406 106.533,25.406C104.192,25.406 102.427,24.112 102.156,22.002L114.235,22.002C114.269,21.628 114.303,20.981 114.303,20.573C114.303,15.569 110.775,12.335 106.262,12.335" />

                                        <path class="logoInitialAnimation logoN fill-cocoa"
                                            d="M125.97,12.335C124.137,12.335 122.135,13.322 121.253,15.023L121.253,12.675L117.113,12.675L117.113,28.571L121.253,28.571L121.253,20.096C121.253,17.338 122.848,16.385 124.714,16.385C126.579,16.385 127.734,17.61 127.734,19.925L127.734,28.571L131.874,28.571L131.874,19.176C131.874,14.682 129.668,12.334 125.97,12.334" />

                                        <path class="logoInitialAnimation logoT fill-cocoa"
                                            d="M136.535,6.616L136.535,12.675L133.65,12.675L133.65,16.011L136.535,16.011L136.535,28.571L140.641,28.571L140.641,16.011L144,16.011L144,12.675L140.641,12.675L140.641,6.616L136.535,6.616Z" />

                                        <path class="logoLightBulb fill-honey-200"
                                            d="M25.233,7.782C25.233,9.213 26.455,10.303 27.915,10.303C29.375,10.303 30.53,9.213 30.53,7.782C30.53,6.352 29.341,5.296 27.915,5.296C26.489,5.296 25.233,6.386 25.233,7.782Z" />

                                        <path class="logoLightBulb fill-honey-200"
                                            d="M33.7,1.323C30.892,-0.035 27.654,-0.361 24.586,0.407C22.56,0.916 20.657,1.909 19.088,3.277C18.809,3.513 18.539,3.765 18.277,4.029C17.4,4.915 16.623,5.955 15.965,7.135C15.802,7.423 15.652,7.715 15.511,8.011C14.805,9.496 14.374,11.08 14.241,12.674C14.211,13.046 14.194,13.419 14.195,13.792C14.185,14.526 14.244,15.266 14.368,16.01C14.511,16.859 14.736,17.712 15.051,18.56C15.565,19.922 16.262,21.168 16.929,22.322C17.603,23.527 18.154,24.541 18.648,25.566C19.044,26.406 19.395,27.283 19.698,28.178C19.796,28.469 19.889,28.762 19.977,29.057L20.155,29.691C20.299,30.209 20.577,30.648 20.957,30.959C21.656,31.533 22.585,31.667 23.464,31.308L25.825,30.177L28.861,28.723L28.786,27.072L30.929,26.852L30.953,26.85L30.971,26.837C31.092,26.751 31.113,26.425 31.114,26.24C31.115,26.094 31.105,25.604 30.928,25.408L29.139,24.285L30.922,24.119L30.941,24.105C31.088,23.996 31.107,23.333 31.008,22.95C30.948,22.712 30.845,22.56 30.72,22.507L29.086,21.516C29.248,21.507 29.416,21.503 29.59,21.498C29.985,21.488 30.393,21.478 30.736,21.406C30.857,21.381 30.944,21.279 30.993,21.104C31.092,20.75 31.021,20.131 30.855,19.901C30.775,19.791 30.413,19.576 29.577,19.103C29.33,18.963 29.096,18.831 28.973,18.754C29.105,18.748 29.273,18.747 29.448,18.745C30.171,18.738 30.696,18.723 30.862,18.584C31,18.469 31.042,17.837 30.938,17.438C30.881,17.224 30.787,17.083 30.67,17.029L29.036,16.038L30.701,15.899L30.735,15.889C30.934,15.789 30.97,15.291 30.946,15.001C30.929,14.801 30.867,14.444 30.642,14.296L28.125,12.755L28.271,11.465L25.604,11.543L25.621,11.643C25.644,11.788 25.624,11.963 25.602,12.149C25.559,12.531 25.509,12.963 25.856,13.259C25.976,13.361 26.375,13.59 26.797,13.831C27.063,13.984 27.406,14.18 27.575,14.29C27.467,14.327 27.315,14.318 27.167,14.31C27.071,14.304 26.971,14.299 26.882,14.306L26.754,14.314C26.334,14.342 25.946,14.371 25.829,14.426C25.627,14.522 25.565,14.936 25.594,15.281C25.608,15.454 25.669,15.873 25.937,16.043L27.573,17.036L25.859,17.187L25.825,17.197C25.658,17.281 25.634,17.616 25.634,17.809C25.634,18.125 25.706,18.558 25.924,18.745L27.619,19.793C27.556,19.794 27.492,19.797 27.429,19.798C26.879,19.812 26.31,19.827 25.805,19.973L25.778,19.987C25.652,20.082 25.643,20.734 25.731,21.104C25.784,21.327 25.874,21.47 25.986,21.523L27.623,22.515L25.973,22.666L25.942,22.674C25.594,22.84 25.725,23.76 25.814,24.029L25.828,24.073L27.694,25.278L26.048,25.389C25.936,25.395 25.881,25.457 25.838,25.513C25.736,25.649 25.716,26.064 25.725,26.687L22.928,28.121C22.526,26.781 22.026,25.473 21.44,24.227C20.905,23.117 20.325,22.049 19.616,20.782C18.982,19.686 18.377,18.607 17.949,17.469C17.494,16.244 17.272,15.013 17.289,13.806C17.281,12.04 17.755,10.261 18.66,8.658C19.335,7.45 20.154,6.435 21.099,5.635C22.315,4.575 23.78,3.809 25.335,3.418C25.403,3.4 25.471,3.386 25.539,3.371L25.601,3.358C27.314,2.978 29.114,3.038 30.807,3.528C31.353,3.686 31.877,3.886 32.366,4.122C34.263,5.023 35.908,6.558 36.999,8.449C38.197,10.474 38.699,12.799 38.413,14.999C38.278,16.152 37.912,17.369 37.328,18.611C37.019,19.238 36.663,19.862 36.318,20.466C36.1,20.849 35.882,21.233 35.67,21.623C35.027,22.81 33.998,25.213 33.66,26.003C33.6,26.143 33.562,26.233 33.546,26.266C33.191,27.089 32.681,28.272 32.517,28.649L29.277,30.223L22.526,33.501C21.759,33.811 21.307,34.598 21.426,35.422C21.542,36.23 22.207,36.854 23.065,36.954L27.329,37.104L21.883,40.192L23.155,42.998L34.252,37.646C35.135,37.238 35.527,36.211 35.146,35.309C34.893,34.709 34.312,34.295 33.63,34.228L29.608,33.244L34.727,31.075C34.852,31.018 34.859,31.013 36.174,27.988C36.234,27.849 36.296,27.705 36.362,27.553C36.363,27.551 36.374,27.525 36.394,27.479C36.797,26.527 37.799,24.195 38.388,23.107C38.582,22.747 38.784,22.392 38.987,22.038L39.004,22.009C39.355,21.395 39.752,20.699 40.115,19.961C40.849,18.399 41.31,16.857 41.483,15.382C41.856,12.51 41.211,9.489 39.667,6.877C38.271,4.459 36.15,2.487 33.699,1.321" />
                                    </svg>
                                </div>
                            </a>
                        </div>


                        <p data-animate="text-reveal-words" class="mt-1 max-w-sm text-pretty" role="note">
                            An open-source
                            <strong>UI framework,</strong>
                            built with Livewire to help you ship apps & admin panels
                            fast.
                        </p>
                    </div>

                    <div data-animate="enter-from-right" x-init="async () => {
                        await window.FilamentAnimations.waitForFonts()

                        const button = $el.querySelector('button')
                        const textWrapper = button.querySelector('[data-text]')
                        const arrow = button.querySelector('svg')

                        const split = new SplitText(textWrapper, { type: 'chars' })
                        const chars = split.chars

                        const tl = gsap.timeline({ paused: true })

                        tl.to(chars, {
                            keyframes: [
                                { y: -10, opacity: 0, duration: 0.2, ease: 'power2.in' },
                                { y: 10, opacity: 0, duration: 0 },
                                { y: 0, opacity: 1, duration: 0.2, ease: 'power2.out' },
                            ],
                            stagger: 0.02,
                        })

                        tl.to(
                            arrow, {
                                keyframes: [
                                    { y: -30, duration: 0.25, ease: 'power2.in' },
                                    { y: 30, duration: 0 },
                                    { y: 0, duration: 0.25, ease: 'power2.out' },
                                ],
                            },
                            0.1,
                        )

                        motion.hover(button, () => {
                            tl.tweenTo(tl.duration())

                            return () => {
                                tl.tweenTo(0)
                            }
                        })
                    }">
                        <button data-button-pulse type="button" aria-label="Back to top"
                            x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                            class="inline-flex h-13 items-center gap-2 rounded-full bg-cream-100 pr-5 pl-1.25 font-medium text-stone-900 transition duration-300 ease-out will-change-transform hover:scale-y-102 hover:bg-minty-100 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset">
                            <div
                                class="relative isolate grid size-11 place-items-center overflow-hidden rounded-full bg-stone-900 text-cream-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.25 -rotate-90"
                                    viewBox="0 0 28 22" fill="none">
                                    <path class="fill-current"
                                        d="M1 10H5.96046e-08V12H1V10ZM27 12C27.5523 12 28 11.5523 28 11C28 10.4477 27.5523 10 27 10V12ZM18 1V5.96046e-08H16V1H18ZM26.4207 11.7774C26.9055 12.0419 27.5129 11.8632 27.7774 11.3783C28.0419 10.8935 27.8632 10.286 27.3783 10.0216L26.4207 11.7774ZM15.9999 20.8995V21.8995H17.9999V20.8995H15.9999ZM1 12H26.8994V10H1V12ZM26.8994 12H27V10H26.8994V12ZM16 1C16 2.47241 16.7953 3.87873 17.7716 5.0769C18.7678 6.29956 20.0716 7.44977 21.3383 8.42854C22.6109 9.41186 23.8784 10.2469 24.825 10.835C25.2993 11.1295 25.6952 11.3635 25.9738 11.5245C26.1131 11.605 26.2233 11.6674 26.2993 11.71C26.3374 11.7314 26.3669 11.7478 26.3873 11.7591C26.3975 11.7647 26.4055 11.7691 26.411 11.7721C26.4138 11.7737 26.416 11.7749 26.4176 11.7758C26.4184 11.7762 26.4191 11.7765 26.4196 11.7768C26.4199 11.777 26.4201 11.7771 26.4202 11.7772C26.4205 11.7773 26.4207 11.7774 26.8995 10.8995C27.3783 10.0216 27.3784 10.0217 27.3785 10.0217C27.3785 10.0217 27.3785 10.0217 27.3785 10.0217C27.3784 10.0216 27.3781 10.0215 27.3777 10.0213C27.3769 10.0208 27.3756 10.0201 27.3736 10.019C27.3697 10.0168 27.3634 10.0134 27.3549 10.0087C27.3378 9.99926 27.3118 9.98479 27.2773 9.96547C27.2084 9.92682 27.1058 9.86878 26.9745 9.79288C26.7117 9.64102 26.3342 9.41799 25.8804 9.13606C24.9708 8.57104 23.7635 7.77501 22.5612 6.84596C21.353 5.91235 20.182 4.86894 19.322 3.81356C18.4422 2.73371 18 1.77759 18 1H16ZM26.8994 11C26.5248 10.0728 26.5245 10.0729 26.5242 10.0731C26.524 10.0731 26.5237 10.0733 26.5234 10.0734C26.5228 10.0736 26.522 10.0739 26.5211 10.0743C26.5193 10.0751 26.5169 10.076 26.5138 10.0773C26.5078 10.0797 26.4994 10.0832 26.4888 10.0876C26.4674 10.0964 26.4369 10.1091 26.3979 10.1257C26.3199 10.1587 26.2077 10.2071 26.0662 10.2703C25.7834 10.3967 25.3826 10.5825 24.903 10.824C23.9463 11.3055 22.6639 12.0142 21.3751 12.919C20.0914 13.8201 18.7665 14.94 17.7546 16.2535C16.7415 17.5685 15.9999 19.1342 15.9999 20.8995H17.9999C17.9999 19.715 18.4958 18.5685 19.3389 17.4742C20.1831 16.3784 21.333 15.3922 22.5242 14.5559C23.7103 13.7232 24.9028 13.0632 25.8022 12.6104C26.2507 12.3846 26.6233 12.2119 26.8818 12.0965C27.011 12.0388 27.1115 11.9955 27.1785 11.967C27.212 11.9528 27.2371 11.9424 27.2533 11.9357C27.2613 11.9324 27.2671 11.93 27.2706 11.9286C27.2724 11.9279 27.2735 11.9274 27.2741 11.9271C27.2744 11.927 27.2745 11.927 27.2745 11.927C27.2745 11.927 27.2744 11.927 27.2744 11.927C27.2742 11.9271 27.274 11.9272 26.8994 11Z" />
                                </svg>
                            </div>
                            <div class="overflow-hidden whitespace-nowrap" data-text>
                                Back to top
                            </div>
                        </button>
                    </div>
                </div>


                <div class="mt-5 flex flex-wrap items-start justify-between gap-5">

                    <div data-animate="enter-from-left" class="order-last sm:order-first">
                        <nav class="inline-flex divide-x divide-bone-100 border-bone-100 md:w-10 md:flex-col md:divide-x-0 md:divide-y rounded-md border"
                            aria-label="Social media links">
                            <a href="https://x.com/filamentphp" target="_blank" rel="external noopener noreferrer"
                                aria-label="X (Twitter) (opens in a new tab)"
                                class="group relative inline-grid place-items-center transition duration-300 ease-out focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset size-10 hover:bg-bone-100/30">
                                <svg class="transition duration-300 will-change-transform group-hover:scale-95 h-4.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M16.9685 16.6804L11.2208 7.64748L16.8923 1.40851C17.2675 0.985507 17.0441 0.31493 16.4902 0.201466C16.2393 0.150075 15.9797 0.233093 15.8052 0.420553L10.4027 6.36295L6.68501 0.520636C6.55027 0.308566 6.31649 0.18007 6.06525 0.179993H1.65802C1.09258 0.179719 0.738876 0.791655 1.02136 1.28149C1.02678 1.2909 1.03242 1.30018 1.03826 1.30935L6.786 10.3414L1.11447 16.5849C0.729173 16.9988 0.936384 17.6746 1.48744 17.8013C1.74935 17.8615 2.02324 17.7739 2.20158 17.5729L7.6041 11.6305L11.3218 17.4728C11.4576 17.6831 11.6912 17.8098 11.9415 17.8089H16.3488C16.9142 17.8087 17.2674 17.1965 16.9845 16.7069C16.9794 16.6979 16.974 16.6891 16.9685 16.6804ZM12.3446 16.3398L2.9958 1.64907H5.65849L15.011 16.3398H12.3446Z"
                                        class="fill-current" />
                                </svg>


                                <div
                                    class="pointer-events-none absolute inset-y-0 hidden items-center gap-3 md:flex left-[calc(100%+theme(spacing.3))] flex-row-reverse">
                                    <div
                                        class="font-roboto-mono text-sm whitespace-nowrap text-stone-500 opacity-0 transition delay-20 duration-300 will-change-transform group-hover:translate-x-0 group-hover:opacity-100 -translate-x-1">
                                        X (Twitter)
                                    </div>
                                    <div
                                        class="h-px w-10 scale-x-0 bg-bone-300/80 transition duration-300 will-change-transform group-hover:scale-x-100 origin-left">
                                    </div>
                                </div>
                            </a>
                            <a href="/discord" target="_blank" rel="external noopener noreferrer"
                                aria-label="Discord (opens in a new tab)"
                                class="group relative inline-grid place-items-center transition duration-300 ease-out focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset size-10 hover:bg-bone-100/30">
                                <svg class="transition duration-300 will-change-transform group-hover:scale-95 h-4.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151 107" fill="none">
                                    <path class="stroke-current [stroke-width:var(--stroke-width,8)]"
                                        d="M60.0637 21.5798V13H36.5301L18 77.6812L60.0637 93L65.9349 76.3188" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,8)]"
                                        d="M89.9877 21.5798V13H113.521L132.043 77.6812L89.9877 93L84.1084 76.3188" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,8)]"
                                        d="M100.157 73.2778C94.3831 75.8404 85.3978 77.4866 75.3096 77.4866H75.3259C65.2377 77.4866 56.2606 75.8404 50.4785 73.2778" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,8)]"
                                        d="M50.4863 24.7345C56.2603 22.1719 65.2455 20.5256 75.3337 20.5256H75.3175C85.4056 20.5256 94.3828 22.1719 100.165 24.7345" />
                                    <path class="fill-current"
                                        d="M58.5061 60.8784C61.3814 60.8784 63.7123 58.5475 63.7123 55.6721C63.7123 52.7968 61.3814 50.4658 58.5061 50.4658C55.6307 50.4658 53.2998 52.7968 53.2998 55.6721C53.2998 58.5475 55.6307 60.8784 58.5061 60.8784Z" />
                                    <path class="fill-current"
                                        d="M92.3645 60.8784C95.2398 60.8784 97.5707 58.5475 97.5707 55.6721C97.5707 52.7968 95.2398 50.4658 92.3645 50.4658C89.4891 50.4658 87.1582 52.7968 87.1582 55.6721C87.1582 58.5475 89.4891 60.8784 92.3645 60.8784Z" />
                                </svg>


                                <div
                                    class="pointer-events-none absolute inset-y-0 hidden items-center gap-3 md:flex left-[calc(100%+theme(spacing.3))] flex-row-reverse">
                                    <div
                                        class="font-roboto-mono text-sm whitespace-nowrap text-stone-500 opacity-0 transition delay-20 duration-300 will-change-transform group-hover:translate-x-0 group-hover:opacity-100 -translate-x-1">
                                        Discord
                                    </div>
                                    <div
                                        class="h-px w-10 scale-x-0 bg-bone-300/80 transition duration-300 will-change-transform group-hover:scale-x-100 origin-left">
                                    </div>
                                </div>
                            </a>
                            <a href="https://github.com/filamentphp/filament" target="_blank"
                                rel="external noopener noreferrer" aria-label="GitHub (opens in a new tab)"
                                class="group relative inline-grid place-items-center transition duration-300 ease-out focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset size-10 hover:bg-bone-100/30">
                                <svg class="transition duration-300 will-change-transform group-hover:scale-95 h-4.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127 133" overflow="visible"
                                    fill="none">
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M0.480469 71.73C0.480469 71.73 13.9205 76.31 18.0405 91.9C22.1605 107.49 27.5705 110.18 31.8505 112.36C34.6505 113.79 47.5905 117.46 57.7505 113.78" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M103.18 132.95V106.13C103.18 93.54 92.9796 83.34 80.3896 83.34C67.7996 83.34 57.5996 93.54 57.5996 106.13V132.95" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M64.75 22.65C68.38 21.04 74.02 20 80.36 20H80.35" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M45.4302 30.98C45.4302 30.98 35.4802 34.08 35.4902 51.46V57.25C35.4902 71.66 47.1702 83.34 61.5802 83.34H80.3902" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M40.0302 35.23C40.0302 35.23 29.4502 17.64 44.1802 1.57999C44.1802 1.57999 70.2802 4.67999 72.5502 21.33" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M95.6295 22.65C91.9995 21.04 86.3595 20 80.0195 20H80.0295" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M114.95 30.98C114.95 30.98 124.9 34.08 124.89 51.46V57.25C124.89 71.66 113.21 83.34 98.8002 83.34H79.9902" />
                                    <path class="stroke-current [stroke-width:var(--stroke-width,10)]"
                                        d="M120.35 35.23C120.35 35.23 130.93 17.64 116.2 1.57999C116.2 1.57999 90.1001 4.67999 87.8301 21.33" />
                                </svg>


                                <div
                                    class="pointer-events-none absolute inset-y-0 hidden items-center gap-3 md:flex left-[calc(100%+theme(spacing.3))] flex-row-reverse">
                                    <div
                                        class="font-roboto-mono text-sm whitespace-nowrap text-stone-500 opacity-0 transition delay-20 duration-300 will-change-transform group-hover:translate-x-0 group-hover:opacity-100 -translate-x-1">
                                        GitHub
                                    </div>
                                    <div
                                        class="h-px w-10 scale-x-0 bg-bone-300/80 transition duration-300 will-change-transform group-hover:scale-x-100 origin-left">
                                    </div>
                                </div>
                            </a>
                            <a href="https://phpc.social/@filament" target="_blank"
                                rel="external noopener noreferrer" aria-label="Mastodon (opens in a new tab)"
                                class="group relative inline-grid place-items-center transition duration-300 ease-out focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset size-10 hover:bg-bone-100/30">
                                <svg class="transition duration-300 will-change-transform group-hover:scale-95 h-4.5"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M13.9396 0.179993H4.0612C2.11275 0.179993 0.533203 1.75953 0.533203 3.70799V14.292C0.533203 16.2404 2.11275 17.82 4.0612 17.82H11.8228C12.366 17.82 12.7055 17.232 12.4339 16.7616C12.3078 16.5433 12.0749 16.4088 11.8228 16.4088H4.0612C2.89217 16.4087 1.9444 15.461 1.9444 14.292V13.5864H13.9396C15.888 13.5863 17.4676 12.0068 17.4676 10.0584V3.70799C17.4676 1.75953 15.8881 0.179993 13.9396 0.179993ZM16.0564 10.0584C16.0564 11.2275 15.1087 12.1752 13.9396 12.1752H1.9444V3.70799C1.9444 2.53891 2.89212 1.59119 4.0612 1.59119H13.9396C15.1087 1.59119 16.0564 2.53891 16.0564 3.70799V10.0584ZM13.9396 6.53039V9.35279C13.9396 9.89596 13.3516 10.2354 12.8812 9.96386C12.6629 9.83782 12.5284 9.60488 12.5284 9.35279V6.53039C12.5284 5.44405 11.3524 4.76509 10.4116 5.30826C9.97498 5.56035 9.706 6.02622 9.706 6.53039V9.35279C9.706 9.89596 9.118 10.2354 8.6476 9.96386C8.42929 9.83782 8.2948 9.60488 8.2948 9.35279V6.53039C8.2948 5.44405 7.1188 4.76509 6.178 5.30826C5.74138 5.56035 5.4724 6.02622 5.4724 6.53039V9.35279C5.4724 9.89596 4.8844 10.2354 4.414 9.96386C4.19569 9.83782 4.0612 9.60488 4.0612 9.35279V6.53039C4.06365 4.35771 6.41717 3.00243 8.29755 4.09089C8.56139 4.24361 8.79875 4.43808 9.0004 4.66672C10.4375 3.03721 13.0997 3.57446 13.7923 5.63378C13.8895 5.92274 13.9393 6.22553 13.9396 6.53039Z"
                                        class="fill-current" />
                                </svg>


                                <div
                                    class="pointer-events-none absolute inset-y-0 hidden items-center gap-3 md:flex left-[calc(100%+theme(spacing.3))] flex-row-reverse">
                                    <div
                                        class="font-roboto-mono text-sm whitespace-nowrap text-stone-500 opacity-0 transition delay-20 duration-300 will-change-transform group-hover:translate-x-0 group-hover:opacity-100 -translate-x-1">
                                        Mastodon
                                    </div>
                                    <div
                                        class="h-px w-10 scale-x-0 bg-bone-300/80 transition duration-300 will-change-transform group-hover:scale-x-100 origin-left">
                                    </div>
                                </div>
                            </a>
                        </nav>
                    </div>


                    <div class="flex flex-wrap gap-x-20 gap-y-5 pr-8 sm:gap-x-30">

                        <div data-animate="enter-from-left-staggered" class="flex flex-col items-start gap-1.5">
                            <strong>Explore</strong>
                            <div class="group/footer-links flex flex-col items-start">
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Home
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="/docs" target="_blank" rel="noopener"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Documentation
                                            <span class="sr-only">(opens in a new tab)</span>
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/build-a-laravel-admin-panel"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Build an admin panel
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/custom-dashboards-plugin"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Custom Dashboards Plugin
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://shop.filamentphp.com" target="_blank" rel="noopener"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Shop
                                            <span class="sr-only">(opens in a new tab)</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div data-animate="enter-from-left-staggered" class="flex flex-col items-start gap-1.5">
                            <strong>Community</strong>
                            <div class="group/footer-links flex flex-col items-start">
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/plugins"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Plugins
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/insights"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Insights
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/team"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Team
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/wall-of-love"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Wall of Love
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/media-kit"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Media Kit
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://github.com/sponsors/danharrin" target="_blank"
                                        rel="noopener"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Sponsor
                                            <span class="sr-only">(opens in a new tab)</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div data-animate="enter-from-left-staggered" class="flex flex-col items-start gap-1.5">
                            <strong>Support</strong>
                            <div class="group/footer-links flex flex-col items-start">
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="/docs/introduction/help" target="_blank" rel="noopener"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Help
                                            <span class="sr-only">(opens in a new tab)</span>
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/consulting"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Consulting
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://status.filamentphp.com" target="_blank" rel="noopener"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Status
                                            <span class="sr-only">(opens in a new tab)</span>
                                        </div>
                                    </a>
                                </div>
                            </div>


                            <strong class="mt-4">Legal</strong>
                            <div class="group/footer-links flex flex-col items-start">
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/legal/terms-of-service"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Terms of Service
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/legal/privacy-policy"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Privacy Policy
                                        </div>
                                    </a>
                                </div>
                                <div
                                    class="transition duration-300 group-has-hover/footer-links:opacity-50 hover:opacity-100!">
                                    <a x-data href="https://filamentphp.com/legal/trademark-policy"
                                        class="relative block py-1.5 transition duration-300 ease-out hover:text-stone-800 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset"
                                        x-init="() => {
                                            const label = $refs['footer-link-label']
                                            const polygon = $refs['footer-link-polygon']

                                            gsap.set(polygon, { opacity: 0, x: -8, y: -5, rotation: -90, scale: 0.5 })

                                            motion.hover($el, () => {
                                                gsap.to(label, {
                                                    x: 15,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })
                                                gsap.to(polygon, {
                                                    x: 0,
                                                    y: 0,
                                                    rotation: 0,
                                                    scale: 1,
                                                    opacity: 1,
                                                    duration: 0.85,
                                                    ease: 'elastic.out(1,0.5)',
                                                    overwrite: true,
                                                })

                                                return () => {
                                                    gsap.to(label, {
                                                        x: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                    gsap.to(polygon, {
                                                        x: -8,
                                                        y: -5,
                                                        rotation: -90,
                                                        scale: 0.5,
                                                        opacity: 0,
                                                        duration: 0.85,
                                                        ease: 'elastic.out(1,0.5)',
                                                        overwrite: true,
                                                    })
                                                }
                                            })
                                        }">
                                        <div class="absolute top-1/2 left-0 -translate-y-1/2">
                                            <svg class="size-2 text-honey-200" x-ref="footer-link-polygon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"
                                                fill="none">
                                                <path d="M4 0L8 4L4 8L0 4L4 0Z" class="fill-current" />
                                            </svg>
                                        </div>

                                        <div x-ref="footer-link-label">
                                            Trademark Policy
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div data-animate="enter-from-top-staggered"
                    class="mt-5 flex flex-wrap items-center justify-center gap-5">
                    <div>
                        <a x-data x-init="() => {
                            const card = $el
                            const sponsorImage = $refs.sponsorImage
                            const sponsorTier = $refs.sponsorTier

                            gsap.set(sponsorTier, { opacity: 0, y: -10, x: -5 })

                            const tl = gsap.timeline({ paused: true })

                            // Feature image scales down slightly
                            tl.to(
                                sponsorImage, {
                                    scale: 0.9,
                                    rotation: 0.01,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0,
                            )

                            // Sponsor tier fades in and slides down
                            tl.to(
                                sponsorTier, {
                                    opacity: 1,
                                    y: 0,
                                    x: 0,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0.1,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }"
                            href="https://kirschbaumdevelopment.com/solutions/filament-development" target="_blank"
                            rel="noopener noreferrer" aria-label="Visit Kirschbaum (opens in new window)"
                            class="relative inline-grid place-items-center overflow-hidden bg-cream-100 transition duration-300 ease-out hover:bg-cream-50 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">

                            <div x-ref="sponsorTier"
                                class="absolute top-0 left-0 z-2 bg-stone-800 px-2 pt-px pb-0.5 font-roboto-mono text-xs text-stone-100 hidden"
                                data-corner-cut="sm" aria-hidden="true">
                                Agency Partner
                            </div>


                            <img x-ref="sponsorImage"
                                src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c953a-0c78-7283-b894-3af9e1e2fa72/kirschbaum.svg"
                                alt="Kirschbaum" loading="lazy" width="auto" height="auto"
                                class="relative z-1 object-contain mix-blend-luminosity max-h-7" />


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-80">
                            </div>
                        </a>
                    </div>
                    <div>
                        <a x-data x-init="() => {
                            const card = $el
                            const sponsorImage = $refs.sponsorImage
                            const sponsorTier = $refs.sponsorTier

                            gsap.set(sponsorTier, { opacity: 0, y: -10, x: -5 })

                            const tl = gsap.timeline({ paused: true })

                            // Feature image scales down slightly
                            tl.to(
                                sponsorImage, {
                                    scale: 0.9,
                                    rotation: 0.01,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0,
                            )

                            // Sponsor tier fades in and slides down
                            tl.to(
                                sponsorTier, {
                                    opacity: 1,
                                    y: 0,
                                    x: 0,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0.1,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }" href="https://serpapi.com/?utm_source=filamentphp"
                            target="_blank" rel="noopener noreferrer"
                            aria-label="Visit SerpApi (opens in new window)"
                            class="relative inline-grid place-items-center overflow-hidden bg-cream-100 transition duration-300 ease-out hover:bg-cream-50 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">

                            <div x-ref="sponsorTier"
                                class="absolute top-0 left-0 z-2 bg-stone-800 px-2 pt-px pb-0.5 font-roboto-mono text-xs text-stone-100 hidden"
                                data-corner-cut="sm" aria-hidden="true">
                                Gold sponsor
                            </div>


                            <img x-ref="sponsorImage"
                                src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c953a-0eac-705c-8def-601fa4a28164/serpapi.svg"
                                alt="SerpApi" loading="lazy" width="auto" height="auto"
                                class="relative z-1 object-contain mix-blend-luminosity max-h-7" />


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-80">
                            </div>
                        </a>
                    </div>
                    <div>
                        <a x-data x-init="() => {
                            const card = $el
                            const sponsorImage = $refs.sponsorImage
                            const sponsorTier = $refs.sponsorTier

                            gsap.set(sponsorTier, { opacity: 0, y: -10, x: -5 })

                            const tl = gsap.timeline({ paused: true })

                            // Feature image scales down slightly
                            tl.to(
                                sponsorImage, {
                                    scale: 0.9,
                                    rotation: 0.01,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0,
                            )

                            // Sponsor tier fades in and slides down
                            tl.to(
                                sponsorTier, {
                                    opacity: 1,
                                    y: 0,
                                    x: 0,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0.1,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }" href="https://baiz.ai" target="_blank"
                            rel="noopener noreferrer" aria-label="Visit Baiz.ai (opens in new window)"
                            class="relative inline-grid place-items-center overflow-hidden bg-cream-100 transition duration-300 ease-out hover:bg-cream-50 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">

                            <div x-ref="sponsorTier"
                                class="absolute top-0 left-0 z-2 bg-stone-800 px-2 pt-px pb-0.5 font-roboto-mono text-xs text-stone-100 hidden"
                                data-corner-cut="sm" aria-hidden="true">
                                Gold sponsor
                            </div>


                            <img x-ref="sponsorImage"
                                src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c953a-0dc5-739f-bcb3-25c033523707/baiz-ai.svg"
                                alt="Baiz.ai" loading="lazy" width="auto" height="auto"
                                class="relative z-1 object-contain mix-blend-luminosity max-h-7" />


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-80">
                            </div>
                        </a>
                    </div>
                    <div>
                        <a x-data x-init="() => {
                            const card = $el
                            const sponsorImage = $refs.sponsorImage
                            const sponsorTier = $refs.sponsorTier

                            gsap.set(sponsorTier, { opacity: 0, y: -10, x: -5 })

                            const tl = gsap.timeline({ paused: true })

                            // Feature image scales down slightly
                            tl.to(
                                sponsorImage, {
                                    scale: 0.9,
                                    rotation: 0.01,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0,
                            )

                            // Sponsor tier fades in and slides down
                            tl.to(
                                sponsorTier, {
                                    opacity: 1,
                                    y: 0,
                                    x: 0,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0.1,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }"
                            href="https://mailtrap.io/email-sending?utm_source=community&amp;utm_medium=referral&amp;utm_campaign=filament"
                            target="_blank" rel="noopener noreferrer"
                            aria-label="Visit Mailtrap (opens in new window)"
                            class="relative inline-grid place-items-center overflow-hidden bg-cream-100 transition duration-300 ease-out hover:bg-cream-50 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">

                            <div x-ref="sponsorTier"
                                class="absolute top-0 left-0 z-2 bg-stone-800 px-2 pt-px pb-0.5 font-roboto-mono text-xs text-stone-100 hidden"
                                data-corner-cut="sm" aria-hidden="true">
                                Gold sponsor
                            </div>


                            <img x-ref="sponsorImage"
                                src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c953a-0e2b-7127-9e05-8d899d66321e/mailtrap.svg"
                                alt="Mailtrap" loading="lazy" width="auto" height="auto"
                                class="relative z-1 object-contain mix-blend-luminosity max-h-7" />


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-80">
                            </div>
                        </a>
                    </div>
                    <div>
                        <a x-data x-init="() => {
                            const card = $el
                            const sponsorImage = $refs.sponsorImage
                            const sponsorTier = $refs.sponsorTier

                            gsap.set(sponsorTier, { opacity: 0, y: -10, x: -5 })

                            const tl = gsap.timeline({ paused: true })

                            // Feature image scales down slightly
                            tl.to(
                                sponsorImage, {
                                    scale: 0.9,
                                    rotation: 0.01,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0,
                            )

                            // Sponsor tier fades in and slides down
                            tl.to(
                                sponsorTier, {
                                    opacity: 1,
                                    y: 0,
                                    x: 0,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0.1,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }"
                            href="https://www.agiledrop.com/laravel?utm_source=filament" target="_blank"
                            rel="noopener noreferrer" aria-label="Visit Agiledrop (opens in new window)"
                            class="relative inline-grid place-items-center overflow-hidden bg-cream-100 transition duration-300 ease-out hover:bg-cream-50 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">

                            <div x-ref="sponsorTier"
                                class="absolute top-0 left-0 z-2 bg-stone-800 px-2 pt-px pb-0.5 font-roboto-mono text-xs text-stone-100 hidden"
                                data-corner-cut="sm" aria-hidden="true">
                                Gold sponsor
                            </div>


                            <img x-ref="sponsorImage"
                                src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c953a-0d2c-738d-9bb5-594888161dd8/agiledrop.svg"
                                alt="Agiledrop" loading="lazy" width="auto" height="auto"
                                class="relative z-1 object-contain mix-blend-luminosity max-h-7" />


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-80">
                            </div>
                        </a>
                    </div>
                    <div>
                        <a x-data x-init="() => {
                            const card = $el
                            const sponsorImage = $refs.sponsorImage
                            const sponsorTier = $refs.sponsorTier

                            gsap.set(sponsorTier, { opacity: 0, y: -10, x: -5 })

                            const tl = gsap.timeline({ paused: true })

                            // Feature image scales down slightly
                            tl.to(
                                sponsorImage, {
                                    scale: 0.9,
                                    rotation: 0.01,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0,
                            )

                            // Sponsor tier fades in and slides down
                            tl.to(
                                sponsorTier, {
                                    opacity: 1,
                                    y: 0,
                                    x: 0,
                                    duration: 0.3,
                                    ease: 'sine.out',
                                },
                                0.1,
                            )

                            motion.hover(card, () => {
                                tl.tweenTo(tl.duration())

                                return () => {
                                    tl.tweenTo(0)
                                }
                            })
                        }" href="https://cmsmax.com?ref=filamentphp.com"
                            target="_blank" rel="noopener noreferrer"
                            aria-label="Visit CMS Max (opens in new window)"
                            class="relative inline-grid place-items-center overflow-hidden bg-cream-100 transition duration-300 ease-out hover:bg-cream-50 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">

                            <div x-ref="sponsorTier"
                                class="absolute top-0 left-0 z-2 bg-stone-800 px-2 pt-px pb-0.5 font-roboto-mono text-xs text-stone-100 hidden"
                                data-corner-cut="sm" aria-hidden="true">
                                Gold sponsor
                            </div>


                            <img x-ref="sponsorImage"
                                src="https://fls-a148a526-7ce4-465e-b283-9b405912858a.laravel.cloud/019c953a-0df8-73b8-bb35-5bc9517949e2/cms-max.svg"
                                alt="CMS Max" loading="lazy" width="auto" height="auto"
                                class="relative z-1 object-contain mix-blend-luminosity max-h-7" />


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-80">
                            </div>
                        </a>
                    </div>

                    <div>
                        <a x-data href="https://github.com/sponsors/danharrin" target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Sponsor Filament - your logo here (opens in new window)"
                            class="custom-dashed-border group relative inline-grid place-items-center overflow-hidden bg-minty-100/30 transition duration-300 ease-out hover:bg-bubblegum/30 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset h-15 w-35 p-4">
                            <div
                                class="relative z-1 flex items-center gap-1 transition duration-300 ease-out will-change-transform group-hover:scale-105">

                                <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>

                                <span class="font-medium text-xs">
                                    Your logo here
                                </span>
                            </div>


                            <div
                                class="bg-line-pattern absolute inset-0 z-0 h-full w-full mask-y-from-70% mask-x-from-70% bg-repeat opacity-60">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-wrap items-center justify-around gap-x-5 gap-y-3 px-5 py-5 sm:justify-between md:px-8">
                <div data-animate="enter-from-left" x-data x-init="async () => {
                    await window.FilamentAnimations.waitForFonts()

                    const container = $el
                    const originalText = $refs.originalText
                    const warningText = $refs.warningText

                    const tl = gsap.timeline({ paused: true })

                    // Original text exits upward
                    tl.to(
                        originalText, {
                            y: -20,
                            opacity: 0,
                            duration: 0.25,
                            ease: 'circ.in',
                        },
                        0,
                    )

                    // Warning text enters from below
                    tl.fromTo(
                        warningText, {
                            y: 20,
                            opacity: 0,
                        }, {
                            y: 0,
                            opacity: 1,
                            duration: 0.25,
                            ease: 'circ.out',
                        },
                        0.15,
                    )

                    motion.hover(container, () => {
                        tl.tweenTo(tl.duration())

                        return () => {
                            tl.tweenTo(0)
                        }
                    })
                }"
                    class="relative grid cursor-default overflow-hidden">
                    <p x-ref="originalText" class="[grid-area:1/-1]">
                        &copy; 2026 Filament. All rights reserved.
                    </p>
                    <p x-ref="warningText" class="whitespace-nowrap [grid-area:1/-1]">
                        Copying? Our lawyers are faster than you! 😈
                    </p>
                </div>

                <p data-animate="enter-from-right" class="flex gap-1.5" role="contentinfo">
                    <span>Website designed by</span>
                    <a href="https://zahirnia.com" target="_blank" rel="external noopener noreferrer"
                        aria-label="Hassan Zahirnia website (opens in new window)"
                        class="group relative transition duration-200 focus:outline-none focus-visible:ring focus-visible:ring-black/50 focus-visible:ring-inset">
                        <span class="flex items-center gap-1 font-medium">
                            <span
                                class="text-amber-500 transition duration-300 ease-out group-hover:-translate-x-0.5 group-hover:text-bubblegum">
                                {
                            </span>
                            <span class="font-outfit text-stone-800">
                                Hassan Zahirnia
                            </span>
                            <span
                                class="text-amber-500 transition duration-300 ease-out group-hover:translate-x-0.5 group-hover:text-bubblegum">
                                }
                            </span>
                        </span>
                        <span
                            class="absolute -bottom-0.5 left-3 h-px w-[84%] origin-right scale-x-0 bg-current transition duration-300 ease-out will-change-transform group-hover:origin-left group-hover:scale-x-100"></span>
                    </a>
                </p>
            </div>
        </footer>
    </main>

    <div x-data="searchModal()" x-on:keydown.escape.window="open && closeModal()" class="relative z-101">

        <div x-show="open" x-cloak x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition duration-150 ease-in" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="bg-dots-pattern fixed inset-0 bg-black/21 bg-repeat backdrop-blur-sm" aria-hidden="true"></div>


        <div x-show="open" x-cloak class="fixed inset-0 z-10 overflow-y-auto" role="dialog" aria-modal="true"
            aria-label="Search the site" x-trap.noscroll="open">
            <div class="flex min-h-full items-start justify-center px-4 pt-[15vh] pb-12" x-on:click="closeModal()">

                <div x-show="open" x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="translate-y-1 scale-95 opacity-0"
                    x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="translate-y-0 scale-100 opacity-100"
                    x-transition:leave-end="translate-y-1 scale-95 opacity-0"
                    class="flex w-full max-w-2xl flex-col overflow-hidden rounded-xl border border-bone-100 bg-serenade-50 shadow-lg"
                    x-on:click.stop>

                    <div class="relative border-b border-bone-100">
                        <label for="search-input" class="sr-only">
                            Search docs, plugins and insights
                        </label>
                        <input x-ref="searchInput" x-model="query" x-on:input="search()"
                            x-on:keydown.arrow-up.prevent="navigateUp()"
                            x-on:keydown.arrow-down.prevent="navigateDown()"
                            x-on:keydown.enter.prevent="selectResult()" type="text" id="search-input"
                            class="h-12 w-full bg-transparent pr-14 pl-11 text-sm tracking-tight text-stone-800 placeholder:text-stone-400 focus:outline-none"
                            placeholder="Search docs, plugins, insights..." autocomplete="off" role="combobox"
                            aria-autocomplete="list" aria-controls="search-results"
                            :aria-expanded="results.length > 0"
                            :aria-activedescendant="results.length > 0 ? 'search-result-' + selectedIndex : null" />
                        <svg class="absolute top-1/2 left-4 size-4 -translate-y-1/2 text-stone-400"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M15.6631 14.811L11.8927 11.0414C15.1616 7.11685 12.9562 1.12536 7.92306 0.256672C2.8899 -0.612009 -1.19622 4.29362 0.568066 9.08681C2.15179 13.3895 7.51813 14.8274 11.041 11.893L14.8107 15.6635C15.1388 15.9916 15.699 15.8414 15.8191 15.3932C15.8749 15.1852 15.8154 14.9633 15.6631 14.811ZM1.38115 6.80331C1.38115 2.6296 5.89933 0.0210223 9.51387 2.10788C13.1284 4.19474 13.1284 9.41188 9.51387 11.4987C8.68972 11.9746 7.75461 12.2251 6.80297 12.2251C3.80996 12.2218 1.38447 9.79632 1.38115 6.80331Z"
                                class="fill-current" />
                        </svg>
                        <div
                            class="absolute top-1/2 right-4 flex -translate-y-1/2 items-center justify-center rounded-xs bg-bone-100 px-1.5 py-0.5 text-xs font-medium text-stone-600">
                            ESC
                        </div>
                    </div>


                    <div x-ref="resultsList" id="search-results" class="max-h-96 scrollbar-thin overflow-y-auto"
                        role="listbox">

                        <template x-if="loading">
                            <div class="flex items-center justify-center py-12 text-stone-400">
                                <svg class="size-5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </div>
                        </template>


                        <template x-if="error && !loading">
                            <div class="px-4 py-8 text-center text-sm text-stone-500">
                                <span x-text="error"></span>
                            </div>
                        </template>


                        <template x-if="query.length >= 2 && ! loading && ! error && results.length === 0">
                            <div class="px-4 py-8 text-center text-sm text-stone-500">
                                No results found for "
                                <span x-text="query" class="font-medium text-stone-800"></span>
                                "
                            </div>
                        </template>


                        <template x-if="query.length < 2 && ! loading">
                            <div class="px-4 py-8 text-center text-sm text-stone-500">
                                Search documentation, plugins and insights...
                            </div>
                        </template>


                        <template x-if="! loading && ! error && results.length > 0">
                            <div class="p-2">
                                <template x-for="(result, index) in results"
                                    :key="result.type + '-' + (result.path || result.url || '') + '-' + index">
                                    <div>

                                        <div x-show="isSectionStart(index)"
                                            :class="index === 0 ?
                                                'px-2 pt-1 pb-1.5 font-outfit text-sm font-medium text-stone-800' :
                                                'mt-2 border-t border-bone-100 px-2 pt-3 pb-1.5 font-outfit text-sm font-medium text-stone-800'"
                                            x-text="sectionLabel(result.type)"></div>


                                        <div :id="'search-result-' + index" role="option"
                                            :aria-selected="selectedIndex === index"
                                            :data-selected="selectedIndex === index">
                                            <a :href="getResultUrl(result)"
                                                class="group flex items-center gap-3 rounded-lg px-3 py-2.5 transition duration-150 ease-out"
                                                :class="selectedIndex === index ? 'bg-cream-100' : 'hover:bg-cream-50'"
                                                x-on:mouseenter="selectedIndex = index">

                                                <template x-if="result.type === 'plugin' && result.image">
                                                    <img :src="result.image" :alt="result.title"
                                                        class="aspect-video h-8 shrink-0 rounded-xs object-cover ring ring-bone-500/30"
                                                        loading="lazy" />
                                                </template>

                                                <template x-if="result.type === 'plugin' && ! result.image">
                                                    <div class="inline-grid aspect-video h-8 shrink-0 place-items-center rounded-xs bg-bone-100 text-stone-500"
                                                        aria-hidden="true">
                                                        <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M14 4h4a2 2 0 0 1 2 2v4M10 4H6a2 2 0 0 0-2 2v4m0 4v4a2 2 0 0 0 2 2h4m4 0h4a2 2 0 0 0 2-2v-4M9 10a2 2 0 1 1 4 0v0a1 1 0 0 0 1 1h2v2a2 2 0 1 1 0 4v0a1 1 0 0 0-1 1h-2v-2a2 2 0 1 1-4 0v0a1 1 0 0 0-1-1H6v-2a2 2 0 1 1 0-4v0a1 1 0 0 0 1-1z" />
                                                        </svg>
                                                    </div>
                                                </template>


                                                <div class="flex min-w-0 flex-1 flex-col gap-0.5">

                                                    <div x-show="result.type === 'doc' && getBreadcrumbs(result).length > 0"
                                                        class="flex items-center gap-1 text-xs text-stone-400">
                                                        <template x-for="(crumb, i) in getBreadcrumbs(result)"
                                                            :key="i">
                                                            <div class="flex items-center">
                                                                <span x-text="crumb" class="truncate"></span>
                                                                <svg x-show="i < getBreadcrumbs(result).length - 1"
                                                                    class="mx-0.5 size-3 shrink-0"
                                                                    viewBox="0 0 24 24" fill="currentColor">
                                                                    <path
                                                                        d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z" />
                                                                </svg>
                                                            </div>
                                                        </template>
                                                    </div>


                                                    <div class="truncate text-sm font-medium text-stone-800"
                                                        x-text="getTitle(result)"></div>


                                                    <div x-show="result.type !== 'doc' && getSubtitle(result)"
                                                        class="truncate text-xs text-stone-400"
                                                        x-text="getSubtitle(result) ? 'by ' + getSubtitle(result) : ''">
                                                    </div>
                                                </div>


                                                <svg class="size-4 shrink-0 text-stone-400 opacity-0 transition-opacity duration-150"
                                                    :class="selectedIndex === index ? 'opacity-100' : 'group-hover:opacity-100'"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="m9 18 6-6-6-6" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>


                    <div x-show="results.length > 0" x-cloak
                        class="flex items-center gap-4 border-t border-bone-100 px-4 py-2.5 text-xs text-stone-400">
                        <div class="flex items-center gap-1">
                            <kbd class="rounded-xs bg-bone-100 px-1.5 py-0.5 font-mono text-[10px] text-stone-600">
                                &uarr;
                            </kbd>
                            <kbd class="rounded-xs bg-bone-100 px-1.5 py-0.5 font-mono text-[10px] text-stone-600">
                                &darr;
                            </kbd>
                            <span>to navigate</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <kbd class="rounded-xs bg-bone-100 px-1.5 py-0.5 font-mono text-[10px] text-stone-600">
                                &crarr;
                            </kbd>
                            <span>to select</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <kbd class="rounded-xs bg-bone-100 px-1.5 py-0.5 font-mono text-[10px] text-stone-600">
                                esc
                            </kbd>
                            <span>to close</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://filamentphp.com/livewire-aee9962d/livewire.min.js?id=657d57c2"
        data-csrf="hbPRt0z6eUblpI285Jt3Q6qZ4HX91WCf8R9EO9Uq" data-module-url="https://filamentphp.com/livewire-aee9962d"
        data-update-uri="https://filamentphp.com/livewire-aee9962d/update" data-navigate-once="true"></script>
    <link rel="modulepreload" as="script" href="https://filamentphp.com/build/assets/app-B5h1W_V9.js" />
    <script type="module" src="https://filamentphp.com/build/assets/app-B5h1W_V9.js" data-navigate-track="reload"></script>
</body>

</html>
