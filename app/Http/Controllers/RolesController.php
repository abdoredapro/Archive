<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct(protected RoleService $service) {}
    
    public function index()
    {
        $roles = Role::paginate();

        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('dashboard.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
            DB::beginTransaction();

            try {

                $role = $this->service->create($request->post('name'));

                $this->service->PermissionsCreate($role, $request->post('permissions'));

                DB::commit();

                return to_route('dashboard.roles.index')->with([
                    'message' =>  'Role added successfully'
                ]);
        

            }catch (Exception $e) {
                DB::rollBack();

                throw $e;
            }


        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findById($id);

        $permissions = Permission::all();

        return view('dashboard.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, $id)
    {

        $role = Role::findById($id);

        $role->update(['name' => $request->name]);

        // Update All Permission

        $permissions  = [];

        foreach($request->permissions as $key => $value) {
            $permissions[] = $key;
        }

        $role->syncPermissions($permissions);

        return to_route('dashboard.roles.index')->with([
            'message' =>  'Role Updated successfully'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findById($id);

        if($role->id == 1) {
            return to_route('dashboard.roles.index')->with([
                'message' => 'حدث خطأ يرجى المحاوله لاحقا.'
            ]);
        }

        $role->delete();

        return to_route('dashboard.roles.index')->with([
            'message' => 'تم مسح الدور بنجاح.'
        ]);
        
        
    }
}
