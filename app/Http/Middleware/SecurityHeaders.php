<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Headers de sécurité à ajouter à toutes les réponses.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // HSTS (Strict-Transport-Security) — uniquement en production avec HTTPS
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // Build CSP depending on environment
        $nonce = base64_encode(random_bytes(12));

        // Detect Vite dev server usage via Referer or host and relax CSP similarly to local/testing
        $referer = (string) $request->headers->get('referer', '');
        $host = (string) $request->getHost();
        $isViteDev = false;

        if (str_contains($referer, ':5173') || str_contains($referer, ':5174') || str_contains($host, 'localhost') || str_contains($host, '127.0.0.1')) {
            $isViteDev = true;
        }

        if (app()->environment('local') || app()->environment('testing') || $isViteDev || config('app.debug')) {
            // Désactiver totalement le CSP en local pour éviter de bloquer Vite, HMR, ou d'autres outils de dev
            return $response;
        } else {
            // Production CSP — Alpine.js/Livewire require unsafe-eval for expression evaluation,
            // and Tailwind/GSAP/Flux UI manipulate inline styles extensively so unsafe-inline is needed for style-src.
            // External script sources include Google Analytics, Flowbite CDN, and Stripe.
            $csp = [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://js.stripe.com https://www.googletagmanager.com https://www.google-analytics.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com",
                "style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://fonts.googleapis.com https://cdn.jsdelivr.net",
                "img-src 'self' data: https: blob:",
                "font-src 'self' data: https://fonts.bunny.net https://fonts.gstatic.com https://cdn.jsdelivr.net",
                "connect-src 'self' https://api.stripe.com https://www.google-analytics.com https://region1.google-analytics.com",
                "frame-src 'self' https://js.stripe.com https://hooks.stripe.com",
                "media-src 'self'",
                "object-src 'none'",
                "base-uri 'self'",
                "form-action 'self'",
                "worker-src 'self' blob:",
            ];

            $policy = implode('; ', $csp).';';

            // If CSP_REPORT_URI is set in config (use config to be safe when config is cached), enable report-only header during roll-out
            $reportUri = config('app.csp_report_uri');
            if ($reportUri) {
                // Add a report-uri for older user-agents and a report-to for modern ones
                $policyReportOnly = $policy." report-uri {$reportUri};";

                // 'Report-To' header requires a JSON structure
                $reportTo = json_encode([
                    'group' => 'csp-endpoint',
                    'max_age' => 10886400,
                    'endpoints' => [['url' => $reportUri]],
                ]);

                $response->headers->set('Report-To', $reportTo);
                $response->headers->set('Content-Security-Policy-Report-Only', $policyReportOnly);
            }

            // Always set the enforcement CSP header in production
            $response->headers->set('Content-Security-Policy', $policy);

            // Expose nonce to the response for use in views if needed
            $response->headers->set('X-CSP-Nonce', $nonce);
        }

        return $response;
    }
}
