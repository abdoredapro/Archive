<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService {
    public function create($roleName) {

        $role = Role::create([
                'name' => $roleName
        ]);

        return $role;

    }

    public function PermissionsCreate($role, $permissions) {
        
        foreach($permissions as $key => $value) {

            $role->givePermissionTo($key);
        }
        
    }   

}