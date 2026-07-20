<div x-cloak x-data="{}" class="flex flex-wrap w-full items-center pt-10">
    <div x-data="{}" x-ref="sunset_section" x-init="() => {
        if (reducedMotion) return
        gsap.timeline({
                delay: 0.4,
                scrollTrigger: {
                    trigger: $refs.sunset_section,
                    start: 'top bottom-=100px',
                },
            })
            .fromTo(
                $refs.left_mountain, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                    duration: 0.7,
                    ease: 'circ.out',
                },
            )
            .fromTo(
                $refs.right_mountain, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                    duration: 0.7,
                    ease: 'circ.out',
                },
                '>-0.5',
            )
            .fromTo(
                $refs.sun, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                    duration: 0.7,
                    ease: 'circ.out',
                },
                '>-0.5',
            )
            .fromTo(
                $refs.cloud1, {
                    autoAlpha: 0,
                    x: 20,
                }, {
                    autoAlpha: 1,
                    x: 0,
                    duration: 3,
                    ease: 'sine.out',
                },
                '>-0.5',
            )
            .fromTo(
                $refs.cloud2, {
                    autoAlpha: 0,
                    x: -20,
                }, {
                    autoAlpha: 1,
                    x: 0,
                    duration: 3,
                    ease: 'sine.out',
                },
                '<',
            )
            .fromTo(
                $refs.cloud3, {
                    autoAlpha: 0,
                    x: 20,
                }, {
                    autoAlpha: 1,
                    x: 0,
                    duration: 3,
                    ease: 'sine.out',
                },
                '<',
            )
            .fromTo(
                $refs.left_birds, {
                    autoAlpha: 0,
                    y: 20,
                    x: 20,
                    rotate: -5,
                }, {
                    autoAlpha: 1,
                    y: 0,
                    x: 0,
                    rotate: 0,
                    duration: 2,
                    ease: 'back.out',
                },
                '<',
            )
            .fromTo(
                $refs.right_birds, {
                    autoAlpha: 0,
                    y: -20,
                    x: -20,
                    rotate: 5,
                }, {
                    autoAlpha: 1,
                    y: 0,
                    x: 0,
                    rotate: 0,
                    duration: 2,
                    ease: 'back.out',
                },
                '<',
            )
            .fromTo(
                $refs.giraffes, {
                    autoAlpha: 0,
                }, {
                    autoAlpha: 1,
                    duration: 0.7,
                    ease: 'circ.out',
                },
                '<',
            )
            .fromTo(
                $refs.supercar, {
                    autoAlpha: 0,
                    x: -500,
                }, {
                    autoAlpha: 1,
                    x: 0,
                    duration: 1,
                    ease: 'circ.out',
                },
                '<',
            )
            .fromTo(
                $refs.take_off, {
                    autoAlpha: 0,
                    y: -30,
                }, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'circ.out',
                },
                '<0.2',
            )
            .fromTo(
                $refs.take_off_message, {
                    autoAlpha: 0,
                    y: 30,
                }, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'circ.out',
                },
                '>-0.3',
            )
            .fromTo(
                $refs.getstarted, {
                    autoAlpha: 0,
                    y: 30,
                }, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'circ.out',
                },
                '>-0.3',
            )
    }">
        <div x-ref="supercar">
            <a wire:navigate href="{{ route('register') }}" x-ref="discord" class="relative block group w-full">
                <div
                    class="flex items-center justify-center text-lg text-white gap-3 rounded-br-3xl rounded-tl-3xl bg-accent  px-9 py-4 transition duration-200 will-change-transform group-hover:-translate-x-0.5 group-hover:-translate-y-0.5 motion-reduce:transition-none">
                    <div> {{ _('Visitez mes projects') }}</div>
                </div>

                <div
                    class="absolute inset-0 -z-10 h-full w-full translate-x-1.5 translate-y-1.5 rounded-br-3xl rounded-tl-3xl dark:hover:bg-transparent transition duration-300 will-change-transform group-hover:translate-x-2 group-hover:translate-y-2 border border-accent-content dark:border-accent-content group-hover:bg-transparent group-hover:border-accent motion-reduce:transition-none">
                </div>
            </a>
        </div>
    </div>
</div>
