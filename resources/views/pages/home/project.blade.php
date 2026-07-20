  <section class="mx-auto max-w-7xl mt-16">
      <div x-cloak x-data="{}" class="mx-auto w-full max-w-screen-lg px-5">
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
              <div x-ref="header" class="text-center">
                  <div x-ref="header_introducing" class="font-bold text-dolphin text-4xl">
                      Découvrez
                  </div>
                  <div class="pt-2 text-5xl sm:text-5xl font-extrabold">
                      <span x-ref="header_new" class="inline-block">
                          Nos
                      </span>
                      <span x-ref="header_features" class="inline-block text-accent-content">
                          Projects
                      </span>
                  </div>
              </div>

          </div>

      </div>
  </section>
