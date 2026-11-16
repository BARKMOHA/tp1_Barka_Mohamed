<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rental;
use App\Models\Review;
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
        // User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            SportSeeder::class,
            EquipmentSeeder::class,
            EquipmentSportSeeder::class,
        ]);

        // Generation de donnees de test
        User::factory(10)->create();
        Rental::factory(20)->create();
        Review::factory(30)->create();


    }
}
