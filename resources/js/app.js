import { gsap } from "gsap";
import autoAnimate from "@formkit/auto-animate";

import { CustomEase } from "gsap/CustomEase";
import { CustomBounce } from "gsap/CustomBounce";
import { CustomWiggle } from "gsap/CustomWiggle";
import { RoughEase, ExpoScaleEase, SlowMo } from "gsap/EasePack";
import { Draggable } from "gsap/Draggable";
import { DrawSVGPlugin } from "gsap/DrawSVGPlugin";
import { EaselPlugin } from "gsap/EaselPlugin";
import { Flip } from "gsap/Flip";
import { GSDevTools } from "gsap/GSDevTools";
import { MotionPathHelper } from "gsap/MotionPathHelper";
import { MotionPathPlugin } from "gsap/MotionPathPlugin";
import { MorphSVGPlugin } from "gsap/MorphSVGPlugin";
import { Observer } from "gsap/Observer";
import { Physics2DPlugin } from "gsap/Physics2DPlugin";
import { PixiPlugin } from "gsap/PixiPlugin";
import { ScrambleTextPlugin } from "gsap/ScrambleTextPlugin";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollSmoother } from "gsap/ScrollSmoother";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import { SplitText } from "gsap/SplitText";
import { TextPlugin } from "gsap/TextPlugin";

gsap.registerPlugin(
    Draggable,
    DrawSVGPlugin,
    EaselPlugin,
    Flip,
    GSDevTools,
    MotionPathHelper,
    MotionPathPlugin,
    MorphSVGPlugin,
    Observer,
    Physics2DPlugin,
    PixiPlugin,
    ScrambleTextPlugin,
    ScrollTrigger,
    ScrollSmoother,
    ScrollToPlugin,
    SplitText,
    TextPlugin,
    RoughEase,
    ExpoScaleEase,
    SlowMo,
    CustomEase,
    CustomBounce,
    CustomWiggle,
);

// Rendre disponibles globalement (utile dans les données Alpine)
globalThis.gsap = globalThis.gsap || gsap;
globalThis.SplitText = globalThis.SplitText || SplitText;
globalThis.ScrollTrigger = globalThis.ScrollTrigger || ScrollTrigger;
globalThis.autoAnimate = globalThis.autoAnimate || autoAnimate;

if (typeof window !== "undefined") {
    window.gsap = window.gsap || gsap;
    window.SplitText = window.SplitText || SplitText;
    window.ScrollTrigger = window.ScrollTrigger || ScrollTrigger;
    window.autoAnimate = window.autoAnimate || autoAnimate;
}

// ---------- Utilitaires sécurisés ----------
const safeGsapFromTo = (target, fromVars, toVars) => {
    if (typeof gsap === "undefined") return;
    const arr = gsap.utils
        ? gsap.utils.toArray(target)
        : Array.isArray(target)
          ? target
          : [target];
    if (!arr || arr.length === 0) return;
    gsap.fromTo(arr, fromVars, toVars);
};

const safeGsapTo = (target, vars) => {
    if (typeof gsap === "undefined") return;
    const arr = gsap.utils
        ? gsap.utils.toArray(target)
        : Array.isArray(target)
          ? target
          : [target];
    if (!arr || arr.length === 0) return;
    gsap.to(arr, vars);
};

// ---------- Scroll to top (Alpine data global) ----------
document.addEventListener("alpine:init", () => {
    Alpine.data("scrollToTop", () => ({
        show: false,
        init() {
            window.addEventListener("scroll", () => {
                this.show = window.scrollY > 300;
            });
            this.show = window.scrollY > 300;

            this.$nextTick(() => {
                const button = this.$el.querySelector("button");
                if (!button) return;

                const textWrapper = button.querySelector("[data-text]");
                const arrow = button.querySelector("svg");

                if (
                    typeof window.SplitText !== "undefined" &&
                    typeof window.gsap !== "undefined"
                ) {
                    try {
                        const split = new window.SplitText(textWrapper, {
                            type: "chars",
                        });
                        const chars = split.chars;
                        const tl = window.gsap.timeline({ paused: true });
                        tl.to(chars, {
                            keyframes: [
                                {
                                    y: -10,
                                    opacity: 0,
                                    duration: 0.2,
                                    ease: "power2.in",
                                },
                                { y: 10, opacity: 0, duration: 0 },
                                {
                                    y: 0,
                                    opacity: 1,
                                    duration: 0.2,
                                    ease: "power2.out",
                                },
                            ],
                            stagger: 0.02,
                        });
                        tl.to(
                            arrow,
                            {
                                keyframes: [
                                    {
                                        y: -30,
                                        duration: 0.25,
                                        ease: "power2.in",
                                    },
                                    { y: 30, duration: 0 },
                                    {
                                        y: 0,
                                        duration: 0.25,
                                        ease: "power2.out",
                                    },
                                ],
                            },
                            0.1,
                        );
                        button.addEventListener("mouseenter", () => tl.play());
                        button.addEventListener("mouseleave", () =>
                            tl.reverse(),
                        );
                    } catch (e) {
                        console.warn(
                            "GSAP animation failed (scroll-to-top)",
                            e,
                        );
                    }
                }
            });
        },
    }));
});

// ---------- Cookie Consent (Alpine data global) ----------
const registerCookieConsentAlpineData = () => {
    const register = () => {
        Alpine.data("cookieConsent", () => ({
            show: false,
            preferences: false,

            init() {
                const getWireId = () => {
                    let element = this.$el;
                    while (element) {
                        if (
                            element.hasAttribute &&
                            element.hasAttribute("wire:id")
                        ) {
                            return element.getAttribute("wire:id");
                        }
                        element = element.parentElement;
                    }
                    return null;
                };

                const bindEntangle = () => {
                    const wireId = getWireId();
                    const component = wireId
                        ? window.Livewire?.find(wireId)
                        : null;
                    if (!component) {
                        document.addEventListener(
                            "livewire:load",
                            bindEntangle,
                            { once: true },
                        );
                        return;
                    }
                    this.show = component.entangle("showBanner");
                    this.preferences = component.entangle("showPreferences");
                };
                bindEntangle();

                if (this.show && typeof window.gsap !== "undefined") {
                    const banner = this.$refs.banner;
                    if (banner) {
                        window.gsap.set(banner, { yPercent: 120, opacity: 0 });
                        setTimeout(() => {
                            window.gsap.to(banner, {
                                yPercent: 0,
                                opacity: 1,
                                duration: 0.7,
                                ease: "power4.out",
                                clearProps: "transform",
                            });
                        }, 400);
                    }
                }

                this.$watch("show", (value) => {
                    if (
                        !value &&
                        this.$refs.banner &&
                        typeof window.gsap !== "undefined"
                    ) {
                        window.gsap.to(this.$refs.banner, {
                            yPercent: 120,
                            opacity: 0,
                            duration: 0.5,
                            ease: "power3.in",
                        });
                    }
                });

                this.$watch("preferences", (value) => {
                    if (typeof window.gsap === "undefined") return;
                    if (value) {
                        window.gsap.fromTo(
                            this.$refs.modal,
                            { y: 40, opacity: 0, scale: 0.96 },
                            {
                                y: 0,
                                opacity: 1,
                                scale: 1,
                                duration: 0.5,
                                ease: "back.out(1.1)",
                            },
                        );
                        window.gsap.fromTo(
                            this.$refs.backdrop,
                            { opacity: 0 },
                            { opacity: 1, duration: 0.4 },
                        );
                    } else {
                        window.gsap.to(this.$refs.modal, {
                            y: 20,
                            opacity: 0,
                            scale: 0.96,
                            duration: 0.25,
                            ease: "power2.in",
                        });
                        window.gsap.to(this.$refs.backdrop, {
                            opacity: 0,
                            duration: 0.25,
                        });
                    }
                });
            },
        }));
    };

    if (window.Alpine) {
        register();
    }
    document.addEventListener("alpine:init", register, { once: true });
};

registerCookieConsentAlpineData();

// ---------- Global Pro Animations (Filament style) ----------
const initGlobalAnimations = () => {
    if (
        typeof window.gsap === "undefined" ||
        typeof window.ScrollTrigger === "undefined"
    )
        return;

    window.ScrollTrigger.refresh();

    // 1. Titres avec SplitText
    const headings = window.gsap.utils.toArray(
        "main h1, main h2, main h3, .prose h1, .prose h2, .prose h3",
    );
    headings.forEach((heading) => {
        if (heading.dataset.gsapAnimated || heading.closest(".no-animate"))
            return;
        heading.dataset.gsapAnimated = "true";

        try {
            const split = new window.SplitText(heading, {
                type: "words,lines",
            });
            const splitWords =
                split && split.words
                    ? window.gsap.utils.toArray(split.words)
                    : [];
            if (!splitWords.length) {
                if (typeof split.revert === "function") split.revert();
                return;
            }
            safeGsapFromTo(
                splitWords,
                { opacity: 0, y: 20, rotateX: -20 },
                {
                    opacity: 1,
                    y: 0,
                    rotateX: 0,
                    duration: 0.8,
                    stagger: 0.03,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: heading,
                        start: "top 92%",
                        once: true,
                    },
                },
            );
        } catch (e) {
            console.warn("SplitText animation failed on heading", e);
        }
    });

    // 2. Content blocks batch fade-up
    const contentBlocks = window.gsap.utils.toArray(
        "main p, main img, main ul, .flux-card, .prose > div, article, .rounded-3xl, .grid > a.group, .grid > div.group, .gsap-reveal",
    );
    const blocksToAnimate = contentBlocks.filter((block) => {
        if (
            block.dataset.gsapAnimated ||
            block.closest(".no-animate") ||
            block.closest('[x-data="cookieConsent()"]') ||
            block.closest("header") ||
            block.closest("nav")
        ) {
            return false;
        }
        return true;
    });
    blocksToAnimate.forEach((block) => {
        block.dataset.gsapAnimated = "true";
    });

    window.ScrollTrigger.batch(blocksToAnimate, {
        start: "top 92%",
        once: true,
        onEnter: (batch) => {
            const items = window.gsap.utils.toArray(batch);
            if (!items.length) return;
            safeGsapFromTo(
                items,
                { opacity: 0, y: 30, scale: 0.98 },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    stagger: 0.08,
                    duration: 0.8,
                    ease: "power3.out",
                    overwrite: true,
                },
            );
        },
    });

    // 3. Page load fade-in
    const mainContainer = document.querySelector(".flex-1");
    if (mainContainer && !mainContainer.dataset.pageAnimated) {
        mainContainer.dataset.pageAnimated = "true";
        window.gsap.fromTo(
            mainContainer,
            { opacity: 0, y: 15 },
            { opacity: 1, y: 0, duration: 0.6, ease: "power2.out", delay: 0.1 },
        );
    }
};

document.addEventListener("livewire:navigated", () => {
    setTimeout(initGlobalAnimations, 50);
});

document.addEventListener("DOMContentLoaded", () => {
    initGlobalAnimations();
});
