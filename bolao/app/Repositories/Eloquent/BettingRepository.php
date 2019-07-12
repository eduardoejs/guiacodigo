<?php

namespace App\Repositories\Eloquent;

use App\Betting;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\BettingRepositoryInterface;

class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{
    protected $model = Betting::class;

    public function create(array $data):Bool
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        if($register){
          $user = Auth()->user();
          $data['user_id'] = $user->id;
          return (bool) $register->update($data);
        }else{
          return false;
        }
    }

    public function list():Collection
    {
      return Betting::all();
    }  
    
    public function BettingUser($id)
    {
        $user = Auth()->user();
        $betting = Betting::find($id);
        if($betting){
          $result = $user->myBetting()->toggle($betting->id);
          if(count($result['attached'])){
            return true;
          }
        }
        return false;
    }
}
