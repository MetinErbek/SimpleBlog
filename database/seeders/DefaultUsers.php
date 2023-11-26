<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
                "name"      => "Example Admin",
                "email"     => "admin@mobillium.com",
                "password"  => Hash::make("mobillium"),
                'role_id'   => 1
        ]);

        User::create([
                "name"      => "Example Writer",
                "email"     => "writer1@mobillium.com",
                "password"  => Hash::make("mobillium"),
                'role_id'   => 3
        ]);
    }
}
