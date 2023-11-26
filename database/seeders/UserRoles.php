<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class UserRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::truncate();

        Roles::create([
            'role' => 'admin',
        ]);

        Roles::create([
            'role' => 'moderator',
        ]);

        Roles::create([
            'role' => 'writer',
        ]);

        Roles::create([
            'role' => 'reader',
        ]);
    }
}
