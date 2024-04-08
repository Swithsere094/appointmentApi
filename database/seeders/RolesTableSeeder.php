<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['description' => 'Business']);
        Role::create(['description' => 'Client']);

        $roles = [
            ['description' => 'Business'],
            ['description' => 'Client'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
