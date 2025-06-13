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
        // Vider le cache des permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Liste des entités avec leurs permissions
        $entities = [
            'avis', 'categories', 'evenements', 'galeries', 'contacts',
            'reservations', 'roles', 'sti_touristique', 'tickets', 'users',
            'visites', 'profil', 'paiement', 'pieces', 'details', 'paragraphes',
            'hotels', 'newsletters', 'faqs', 'apropos'
        ];
        $actions = ['create', 'edit', 'delete', 'index', 'show', 'assign'];

        // Créer les permissions pour chaque entité et action
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$entity.$action"]);
            }
        }

        // Permissions supplémentaires
        Permission::firstOrCreate(['name' => 'access.welcome']); // Accès à la page de bienvenue
        Permission::firstOrCreate(['name' => 'access_admin']); // Accès à l'interface admin
        Permission::firstOrCreate(['name' => 'access_public']); // Accès aux pages publiques
        Permission::firstOrCreate(['name' => 'newsletter.subscribe']); // S'abonner à la newsletter
        Permission::firstOrCreate(['name' => 'commentaires.create']); // Poster un commentaire

        // Créer les rôles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Assigner toutes les permissions au rôle admin
        $adminRole->syncPermissions(Permission::all());

        // Assigner des permissions limitées au rôle user
        $userRole->syncPermissions([
            'access_public',
            'evenements.show',
            'visites.show',
            'reservations.show',
            'reservations.create',
            'profil.index',
            'profil.edit',
            'avis.create',
            'commentaires.create',
            'paiement.create',
            'newsletter.subscribe'
        ]);

        // Assigner le rôle admin au premier utilisateur
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

        // Vider le cache des permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}