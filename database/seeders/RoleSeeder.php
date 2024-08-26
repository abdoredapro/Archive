<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::find(9)->assignRole('Super-admin');

        // $permissions = ;

        foreach(App::make('permissions') as $key => $value) {
            Permission::firstOrCreate(['name' => $key]);
        }

    }
}
