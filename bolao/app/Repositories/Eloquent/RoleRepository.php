<?php

namespace App\Repositories\Eloquent;

use App\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $model = Role::class;

    public function create(array $data):Bool
    {
        $register = $this->model->create($data);

        //relacionamento
        if(isset($data['permissions']) && count($data['permissions'])){
            foreach($data['permissions'] as $key => $value){
                $register->permissions()->attach($value);
            }
        }
        return (bool) $register;
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        if($register){

            //relacionamento
            $permissions = $register->permissions; // trago a lista de permissoes do perfil
            if(count($permissions)){
                foreach($permissions as $key => $value){
                    $register->permissions()->detach($value->id); //removo as permissoes vinculadas antes de cadastrar novamente
                }
            }

            if(isset($data['permissions']) && count($data['permissions'])){
                foreach($data['permissions'] as $key => $value){
                    $register->permissions()->attach($value);
                }
            }
            return (bool) $register->update($data);
        }
        return false;
    }
}
