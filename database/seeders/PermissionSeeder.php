<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'home.view',
            'category.view',
            'category.create',
            'category.update',
            'category.delete',
            'files.view',
            'files.create',
            'files.update',
            'files.delete',
            'films.view',
            'films.create',
            'films.update',
            'films.delete',
        ];

        foreach($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
