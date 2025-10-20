<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;  // <-- Ajoute cette ligne
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate([
            'email' => 'gbedebernard60@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('VisaBernard6142@'),
            // autres champs
        ]);
    }
}
