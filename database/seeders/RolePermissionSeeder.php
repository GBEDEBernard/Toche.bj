<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Liste des entités et actions
        $entities = [
            'avis', 'categories', 'evenements', 'galeries', 'contacts',
            'reservations', 'roles', 'sti_touristique', 'tickets', 'users', 'visites', 'profil'
        ];
        $actions = ['create', 'edit', 'delete', 'index', 'update', 'show'];

        // Création des permissions
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$entity.$action"]);
            }
        }

        // Use firstOrCreate for access.welcome
        Permission::firstOrCreate(['name' => 'access.welcome']);

        // Création des rôles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Attribution de toutes les permissions au rôle admin
        $adminRole->syncPermissions(Permission::all());

        // Attribution de permissions spécifiques au rôle user (exemple)
        $userRole->syncPermissions([
            'evenements.show',
            'visites.show',
            'reservations.show',
            // ... autres permissions pour le rôle user
        ]);

        // Récupérer un user (par exemple id = 1)
        $user = User::find(1);

        if ($user) {
            $user->assignRole('admin'); // ou 'user'
        }
    }
}