<?php

namespace Database\Seeders;

use App\Models\IdType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IdType::create(['description' => 'Cédula de Ciudadanía']);
        IdType::create(['description' => 'Cédula de extranjería']);
        IdType::create(['description' => 'NIT']);
    }
}
