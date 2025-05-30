<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $entities = [
            'avis', 'categories', 'evenements', 'galeries', 'contacts',
            'reservations', 'roles', 'sti_touristique', 'tickets', 'users', 
            'visites', 'profil', 'paiement', 'pieces'
        ];
        $actions = ['create', 'edit', 'delete', 'index', 'show'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$entity.$action"]);
            }
        }

        Permission::firstOrCreate(['name' => 'access.welcome']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $adminRole->syncPermissions(Permission::all());

        $userRole->syncPermissions([
            'evenements.show',
            'visites.show',
            'reservations.show',
        ]);

        $firstUser = User::orderBy('created_at')->first();

        if ($firstUser && !$firstUser->hasRole('admin')) {
            $firstUser->syncRoles([]); 
            $firstUser->assignRole('admin');
            $this->command->info("🎉 Rôle 'admin' donné à {$firstUser->email} (ID: {$firstUser->id})");
        } elseif ($firstUser) {
            $this->command->info("ℹ️ L'utilisateur {$firstUser->email} a déjà le rôle admin.");
        } else {
            $this->command->warn("😢 Aucun utilisateur trouvé. Aucun rôle assigné.");
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
