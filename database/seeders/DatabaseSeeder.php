<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $seeders = [
            RolesTableSeeder::class,
            StatesTableSeeder::class,
            IdTypesSeeder::class
        ];

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }

        // $this->call(RolesTableSeeder::class);
        // $this->call(EstatesTableSeeder::class);
        // $this->call(IdTypesSeeder::class);
    }
}
