<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PERMISSOES PARA USUARIOS
        \App\Permission::firstOrCreate(
            ['name' => 'add-user'],
            ['description' => 'Inserir usuário no sistema']
        );

        \App\Permission::firstOrCreate(
            ['name' => 'edit-user'],
            ['description' => 'Alterar dados do usuário']
        );

        \App\Permission::firstOrCreate(
            ['name' => 'del-user'],
            ['description' => 'Excluir usuário do sistema']
        );

        \App\Permission::firstOrCreate(
            ['name' => 'list-user'],
            ['description' => 'Listar usuários do sistema']
        );

        \App\Permission::firstOrCreate(
            ['name' => 'show-user'],
            ['description' => 'Visualizar dados do usuário']
        );

        \App\Permission::firstOrCreate(
            ['name' => 'acl'],
            ['description' => 'Acesso ao ACL']
        );

        echo "Registros de ACL criados com sucesso! \n";
    }
}
