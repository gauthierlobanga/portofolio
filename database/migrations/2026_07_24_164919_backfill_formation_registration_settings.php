<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('formations')
            ->select(['id', 'meta'])
            ->orderBy('id')
            ->chunkById(100, function ($formations): void {
                foreach ($formations as $formation) {
                    $meta = is_string($formation->meta)
                        ? json_decode($formation->meta, true)
                        : ($formation->meta ?? []);
                    $format = mb_strtolower(trim((string) ($meta['format'] ?? '')));

                    $deliveryMode = match (true) {
                        str_contains($format, 'présentiel') || str_contains($format, 'presentiel') => 'in_person',
                        str_contains($format, 'hybride') => 'hybrid',
                        default => 'online',
                    };

                    DB::table('formations')
                        ->where('id', $formation->id)
                        ->update([
                            'delivery_mode' => $deliveryMode,
                            'price' => isset($meta['prix']) && is_numeric($meta['prix']) ? $meta['prix'] : null,
                            'capacity' => isset($meta['places_limit']) && is_numeric($meta['places_limit'])
                                ? (int) $meta['places_limit']
                                : null,
                        ]);
                }
            });
    }

    public function down(): void
    {
        DB::table('formations')->update([
            'delivery_mode' => null,
            'price' => null,
            'capacity' => null,
        ]);
    }
};
