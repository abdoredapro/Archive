<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('role');

        $user = User::create($data);


        $role = Role::findOrFail($request->role);

        $user->assignRole($role->name);


        return to_route('dashboard.users.index')
        ->with([
            'message' => 'تم اضافه العضو بنجاح'
        ]);

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
    public function edit(User $user)
    {

        $roles = Role::all();

        return view('dashboard.users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => ['required', 'string', 'min:3', 'max:255'],
            'email'     => ['required', 'email', "unique:users,email,$user->id"],
            'role'      => ['required', 'exists:roles,id'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        $role = Role::findById($request->role);

        $user->syncRoles($role->name);

        return to_route('dashboard.users.index')
        ->with([
            'message' => 'تم تعديل المعلومات بنجاح'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        if($user->photo) {
            Storage::disk('public')->delete('users/'.$user->photo);
        }

        return to_route('dashboard.users.index')
        ->with([
            'message' => 'تم مسح العضو بنجاح'
        ]);
    }
}
