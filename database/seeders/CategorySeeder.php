<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * prompt: la commande pour excuter un fichier sql dans notre seeder laravel
     */
    public function run(): void
    {
        DB::unprepared(
            file_get_contents(database_path('seeders/categories.sql'))
            );
    }
}
