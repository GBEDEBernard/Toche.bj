<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin', 'permission:roles.index']);
    }

    /**
     * Display a listing of roles.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        $users = User::with('roles')->get();
        return view('Admin.Roles.index', compact('roles', 'permissions', 'users'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('Admin.Roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Rôle créé avec succès.');
    }

    /**
     * Show the form for editing the specified role.
     */
  public function edit($id)
{
    if (Auth::user()->email !== 'gbedebernard60@gmail.com') {
        return redirect()->route('admin.roles.index')->with('error', 'Accès refusé.');
    }

    $role = Role::findOrFail($id);
    $permissions = Permission::all();
    return view('Admin.Roles.edit', compact('role', 'permissions'));
}


  
  public function update(Request $request, $id)
{
    if (Auth::user()->email !== 'gbedebernard60@gmail.com') {
        return redirect()->route('admin.roles.index')->with('error', 'Accès refusé.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'permissions' => 'array|exists:permissions,name',
    ]);

    $role = Role::findOrFail($id);
    
    if ($role->name === 'admin') {
        return redirect()->route('admin.roles.index')->with('error', 'Le rôle admin ne peut pas être modifié.');
    }

    // Protéger les permissions sensibles
    $protectedPermissions = ['roles.index', 'roles.create', 'roles.edit', 'roles.delete', 'roles.show', 'access_admin'];
    $submittedPermissions = $request->permissions ?? [];

    foreach ($protectedPermissions as $protected) {
        if ($role->hasPermissionTo($protected) && !in_array($protected, $submittedPermissions)) {
            $submittedPermissions[] = $protected;
        }
    }

    $role->update(['name' => $request->name]);
    $role->syncPermissions($submittedPermissions);

    return redirect()->route('admin.roles.index')->with('success', 'Rôle mis à jour avec succès.');
}


    /**
     * Remove the specified role from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if ($role->name === 'admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Le rôle admin ne peut pas être supprimé.');
        }
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé avec succès.');
    }

    /**
     * Assign roles to a user.
     */
        public function assignRoles(Request $request, $userId)
        {
            // 👇 Autoriser uniquement l’utilisateur spécifique
            if (Auth::user()->email !== 'gbedebernard60@gmail.com') {
                return redirect()->route('admin.roles.index')->with('error', 'Vous n\'êtes pas autorisé à assigner des rôles.');
            }

            $request->validate([
                'roles' => 'array',
            ]);

            $user = User::findOrFail($userId);
            $user->syncRoles($request->roles ?? []);

            return redirect()->route('admin.roles.index')->with('success', 'Rôles assignés à l\'utilisateur avec succès.');
        }

}