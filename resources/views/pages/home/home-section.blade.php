<div x-cloak x-data="{}" class="mx-auto w-full max-w-screen-lg pt-20">
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
    }" class="text-center">
        <div class="mx-auto grid w-full max-w-4xl">

            <div x-ref="take_off" class="px-4 pt-3 text-5xl font-extrabold">
                Ready to take off?
            </div>
            <div x-ref="take_off_message" class="mx-auto max-w-md px-4 pt-2 text-dolphin">
                Give Filament a try, and we bet that you'll be amazed in the first
                few minutes.
            </div>
            <div x-ref="getstarted" class="px-4 pt-5">
                <a wire:navigate href="#"
                    class="group/getstarted relative flex w-full items-center justify-center gap-8 overflow-hidden rounded-lg  py-8 ring-2 ring-transparent transition duration-300 hover:ring-peach-orange/40 motion-reduce:transition-none sm:py-10">
                    <img src="{{ $users->getHeroImageUrl() }}"
                        class="object-cover w-92 h-92 mx-auto rounded-full shadow-accent-content shadow-lg"
                        alt="{{ $users->getName() }}">
                </a>
            </div>
        </div>
    </div>
</div>
