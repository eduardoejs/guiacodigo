<?php

namespace App\Repositories\Eloquent;

use App\Match;
use App\Repositories\Contracts\MatchRepositoryInterface;

class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{
    protected $model = Match::class;

    public function create(array $data):Bool
    {
        $user = auth()->user();
        $listRel = $user->rounds;
        $round_id = $data['round_id'];
        $exist = false;

        foreach ($listRel as $key => $value) {
            if($round_id == $value->id) {
                $exist = true;
            }
        }

        if($exist) {
            return (bool) $this->model->create($data);
        }

        return false;
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);

        if($register){
            $user = auth()->user();
            $listRel = $user->rounds;
            $round_id = $data['round_id'];
            $exist = false;

            foreach ($listRel as $key => $value) {
                if($round_id == $value->id) {
                    $exist = true;
                }
            }

            if($exist) {
                return (bool) $register->update($data);
            }
            
            return false;
        }
        return false;
    }
}
