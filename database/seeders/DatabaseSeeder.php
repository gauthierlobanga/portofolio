<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            CreateAdminUserSeeder::class,
            BlogCategorySeeder::class,
            PostSeeder::class,
            PartnerSeeder::class,
            FaqSeeder::class,
            TeamSeeder::class,
            LegalPagesSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            WorldSeeder::class,
        ]);
    }
}
