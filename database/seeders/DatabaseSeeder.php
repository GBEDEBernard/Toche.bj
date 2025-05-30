<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class, // 👈 D'abord on crée les users
            RolePermissionSeeder::class, // 👈 Ensuite on assigne les rôles
        ]);
    }
}
