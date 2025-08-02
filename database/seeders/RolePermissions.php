<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'medecin']);
    Role::create(['name' => 'infirmier']);
    Role::create(['name' => 'receptionniste']);

    // Exemple : attribuer un rôle à l'utilisateur #1
    $user = \App\Models\User::find(1);
    $user->assignRole('admin');
}
}
