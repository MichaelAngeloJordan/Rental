<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = [
            ['name' => 'Administrator', 'slug' => 'admin'],
            ['name' => 'Owner', 'slug' => 'owner'],
            ['name' => 'Costumer', 'slug' => 'costumer'],
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'slug' => $role['slug'],
            ]);
        }

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'role_id' => Role::where('slug', 'admin')->first()->id,
        ]);
    }
}
