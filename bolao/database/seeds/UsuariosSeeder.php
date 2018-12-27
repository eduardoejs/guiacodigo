<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::firstOrCreate(
            ['email' => 'eduardo@mail.com'],
            ['name' => 'Eduardo', 'password' => Hash::make('123456')]
        );

        $admin = \App\User::firstOrCreate(
            ['email' => 'daiane@mail.com'],
            ['name' => 'Daiane', 'password' => Hash::make('123456')]
        );

        echo "Usuários criados com sucesso! \n";
    }
}
