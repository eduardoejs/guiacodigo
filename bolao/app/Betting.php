<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Betting extends Model
{
    protected $fillable = ['user_id', 'title', 'current_round', 'value_result', 'extra_value', 'value_free'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
