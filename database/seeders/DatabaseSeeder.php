<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CourtSeeder::class,
            UserSeeder::class,
            ExpertSeeder::class,
            TypeSeeder::class,
            MatterSeeder::class,
            PartySeeder::class,
        ]);
    }
}
