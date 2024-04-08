<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['description' => 'Confirmed'],
            ['description' => 'paid'],
            ['description' => 'Cancelled'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
