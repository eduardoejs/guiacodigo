<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminACL = \App\Role::firstOrCreate(
            ['name' => 'administrador'],
            ['description' => 'Administrador do sistema']
        );

        $managerACL = \App\Role::firstOrCreate(
            ['name' => 'gerente'],
            ['description' => 'Gerente do sistema']
        );

        $userACL = \App\Role::firstOrCreate(
            ['name' => 'usuario'],
            ['description' => 'Usuário do sistema']
        );

        $userAdmin = \App\User::find(1);
        $userManager = \App\User::find(2);

        $userAdmin->roles()->attach($adminACL);
        $userManager->roles()->attach($managerACL);


        echo "Registros de Roles criados com sucesso! \n";
    }
}
