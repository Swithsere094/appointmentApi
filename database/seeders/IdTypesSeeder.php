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
        $idTypes = [
            ['description' => 'Cédula de Ciudadanía'],
            ['description' => 'Cédula de extranjería'],
            ['description' => 'NIT'],
        ];

        foreach ($idTypes as $idType) {
            IdType::create($idType);
        }
    }
}
