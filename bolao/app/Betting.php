<?php

namespace App;

use App\User;
use App\Round;
use Illuminate\Database\Eloquent\Model;

class Betting extends Model
{
    protected $fillable = ['user_id', 'title', 'current_round', 'value_result', 'extra_value', 'value_free'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function bettors()
    {
        return $this->belongsToMany(User::class);
    }

    //Acessor
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getTitleAttribute($value)
    {
        return ucwords(\mb_strtolower($value, 'UTF-8'));
    }
}
