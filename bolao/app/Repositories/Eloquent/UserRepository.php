<?php

namespace App\Repositories\Eloquent;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    // Método específico para criar usuario. Definir criptografia no campo senha.
    // "Sobrescreve o método global em AbstractRepository
    public function create(array $data):Bool
    {
        $data['password'] = Hash::make($data['password']); //criptografando senha antes de criar registro
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        if($register){

            // Verifica se existe a variavel password no array
            if($data['password'] ?? false){
                $data['password'] = Hash::make($data['password']); //criptografando senha antes de editar registro
            }

            return (bool) $register->update($data);
        }

        return false;
    }
}
