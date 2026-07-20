<div x-cloak x-data="{}" class="flex-1 h-full">
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
        <div x-ref="take_off">
            @if ($users->getHeroImageUrl())
                <img src="{{ $users->getHeroImageUrl() }}"
                    class="object-cover w-92 h-92 mx-auto rounded-full shadow-accent-content shadow-lg"
                    alt="{{ $users->getName() }}">
            @else
                <img src="{{ $users->getHeroImageUrl() }}" class="object-cover w-full" alt="{{ $users->getName() }}">
            @endif
        </div>
    </div>
</div>
