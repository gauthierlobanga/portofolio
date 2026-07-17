<?php

namespace App\Concerns\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImageUrl
{
    /**
     * Retourne l'URL publique d'une image.
     * - Si c'est une URL absolue (http…), on la retourne telle quelle.
     * - Sinon, on nettoie le chemin (supprime un éventuel slash initial)
     *   et on génère l'URL via le disque 'public' (local ou S3).
     */
    public function imageUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        // Si c'est déjà une URL complète, on la retourne sans modification
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Nettoyer le chemin (retirer un éventuel slash devant et tout préfixe /storage/)
        $cleanPath = ltrim(preg_replace('#^/storage/#', '', $path), '/');

        return Storage::disk('public')->url($cleanPath);
    }
}
