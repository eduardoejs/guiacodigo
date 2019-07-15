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
        $list = Betting::all();
        $user = Auth()->user();
        if($user){
          $myBetting = $user->myBetting;
          foreach ($list as $key => $value) {
            if($myBetting->contains($value)){
              $value->subscriber = true;
            }
          }
        }
        return $list;
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

    public function rounds($betting_id)
    {
        $user = Auth()->user();
        $betting = $user->myBetting()->find($betting_id);
        if($betting){
          return $betting->rounds()->orderBy('date_start', 'DESC')->get();
        }
        return false;
    }
}
