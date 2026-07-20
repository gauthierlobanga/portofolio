<ul x-cloak x-data="{}">
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
    })">
        <div x-ref="header" class="flex items-center my-6 space-x-6">
            <!-- GitHub -->
            <div class="relative group/github" x-ref="header_introducing">
                <a wire:navigate href="https://github.com/yourusername" target="_blank"
                    class="transition duration-300 delay-75 peer text-gray-600 dark:text-gray-400 opacity-80 group-hover/github:opacity-100 group-hover/github:text-gray-900 dark:group-hover/github:text-white motion-reduce:transition-none">
                    <div class="gsap-fadein">
                        <svg fill="currentColor" viewBox="0 0 24 24" class="h-7 w-7">
                            <path
                                d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                    </div>
                </a>
                <div
                    class="invisible absolute right-1/2 top-7 -translate-y-2 translate-x-1/3 p-3 opacity-0 transition delay-75 duration-300 hover:visible hover:translate-y-0 hover:opacity-100 peer-hover:visible peer-hover:translate-y-0 peer-hover:opacity-100 motion-reduce:transition-none min-[1400px]:translate-x-1/2">
                    <div
                        class="flex items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-white dark:bg-gray-800 pl-2.5 pr-4 shadow-xl shadow-black/5 border border-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="scale-90 text-yellow-500" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M9.153 5.408C10.42 3.136 11.053 2 12 2c.947 0 1.58 1.136 2.847 3.408l.328.588c.36.646.54.969.82 1.182c.28.213.63.292 1.33.45l.636.144c2.46.557 3.689.835 3.982 1.776c.292.94-.546 1.921-2.223 3.882l-.434.507c-.476.557-.715.836-.822 1.18c-.107.345-.071.717.001 1.46l.066.677c.253 2.617.38 3.925-.386 4.506c-.766.582-1.918.051-4.22-1.009l-.597-.274c-.654-.302-.981-.452-1.328-.452c-.347 0-.674.15-1.329.452l-.595.274c-2.303 1.06-3.455 1.59-4.22 1.01c-.767-.582-.64-1.89-.387-4.507l.066-.676c.072-.744.108-1.116 0-1.46c-.106-.345-.345-.624-.821-1.18l-.434-.508c-1.677-1.96-2.515-2.941-2.223-3.882c.293-.941 1.523-1.22 3.983-1.776l.636-.144c.699-.158 1.048-.237 1.329-.45c.28-.213.46-.536.82-1.182l.328-.588Z" />
                        </svg>
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            20.7k Stars
                        </div>
                    </div>
                </div>
            </div>

            <!-- LinkedIn -->
            <div class="relative group/linkedin" x-ref="header_features">
                <a wire:navigate href="https://linkedin.com/in/yourusername" target="_blank"
                    class="transition duration-300 delay-75 peer text-gray-600 dark:text-gray-400 opacity-80 group-hover/linkedin:opacity-100 group-hover/linkedin:text-blue-600 motion-reduce:transition-none">
                    <div class="gsap-fadein">
                        <svg fill="currentColor" viewBox="0 0 24 24" class="h-7 w-7">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </div>
                </a>
                <div
                    class="invisible absolute right-1/2 top-7 -translate-y-2 translate-x-1/3 p-3 opacity-0 transition delay-75 duration-300 hover:visible hover:translate-y-0 hover:opacity-100 peer-hover:visible peer-hover:translate-y-0 peer-hover:opacity-100 motion-reduce:transition-none min-[1400px]:translate-x-1/2">
                    <div
                        class="flex items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-white dark:bg-gray-800 py-2.5 pl-2.5 pr-4 shadow-xl shadow-black/5 border border-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="scale-90 text-blue-500" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z" />
                        </svg>
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Follow on LinkedIn
                        </div>
                    </div>
                </div>
            </div>

            <!-- Twitter/X -->
            <div class="relative group/twitter" x-ref="header_new">
                <a wire:navigate href="https://twitter.com/yourusername" target="_blank"
                    class="transition duration-300 delay-75 peer text-gray-600 dark:text-gray-400 opacity-80 group-hover/twitter:opacity-100 group-hover/twitter:text-black dark:group-hover/twitter:text-white motion-reduce:transition-none">
                    <div class="gsap-fadein">
                        <svg fill="currentColor" viewBox="0 0 24 24" class="h-7 w-7">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </div>
                </a>
                <div
                    class="invisible absolute right-1/2 top-7 -translate-y-2 translate-x-1/3 p-3 opacity-0 transition delay-75 duration-300 hover:visible hover:translate-y-0 hover:opacity-100 peer-hover:visible peer-hover:translate-y-0 peer-hover:opacity-100 motion-reduce:transition-none min-[1400px]:translate-x-1/2">
                    <div
                        class="flex items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-white dark:bg-gray-800 py-2.5 pl-2.5 pr-4 shadow-xl shadow-black/5 border border-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="scale-90 text-gray-700 dark:text-gray-300"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                        </svg>
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Follow on X
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="relative group/email" x-ref="header_version4">
                <a wire:navigate href="{{ '#' }}"
                    class="transition duration-300 delay-75 peer text-gray-600 dark:text-gray-400 opacity-80 group-hover/email:opacity-100 group-hover/email:text-red-500 motion-reduce:transition-none">
                    <div class="gsap-fadein">
                        <svg fill="currentColor" viewBox="0 0 24 24" class="h-7 w-7">
                            <path
                                d="M12 12.713l-11.985-9.713h23.971l-11.986 9.713zm-5.425-1.822l-6.575-5.329v12.501l6.575-7.172zm10.85 0l6.575 7.172v-12.501l-6.575 5.329zm-1.557 1.261l-3.868 3.135-3.868-3.135-8.11 8.848h23.956l-8.11-8.848z" />
                        </svg>
                    </div>
                </a>
                <div
                    class="invisible absolute right-1/2 top-7 -translate-y-2 translate-x-1/3 p-3 opacity-0 transition delay-75 duration-300 hover:visible hover:translate-y-0 hover:opacity-100 peer-hover:visible peer-hover:translate-y-0 peer-hover:opacity-100 motion-reduce:transition-none min-[1400px]:translate-x-1/2">
                    <div
                        class="flex items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-white dark:bg-gray-800 py-2.5 pl-2.5 pr-4 shadow-xl shadow-black/5 border border-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="scale-90 text-red-500" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Send Email
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</ul>
