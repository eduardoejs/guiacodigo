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
        $register = $this->model->create($data);

        //relacionamento
        if(isset($data['roles']) && count($data['roles'])){
            foreach($data['roles'] as $key => $value){
                $register->roles()->attach($value);
            }
        }

        return (bool) $register;
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        if($register){

            // Verifica se existe a variavel password no array
            if($data['password'] ?? false){
                $data['password'] = Hash::make($data['password']); //criptografando senha antes de editar registro
            }

            //relacionamento
            $roles = $register->roles; // trago a lista de permissoes do perfil
            if(count($roles)){
                foreach($roles as $key => $value){
                    $register->roles()->detach($value->id); //removo as permissoes vinculadas antes de cadastrar novamente
                }
            }

            if(isset($data['roles']) && count($data['roles'])){
                foreach($data['roles'] as $key => $value){
                    $register->roles()->attach($value);
                }
            }

            return (bool) $register->update($data);
        }

        return false;
    }
}
