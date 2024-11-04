<?php

namespace Database\Seeders;

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
        User::factory(1)->create();

        $user = User::first();
        $user->assignRole('Super-admin');

        // $this->call(RoleSeeder::class);
        // $this->call(PermissionSeeder::class);
    
    }
}
