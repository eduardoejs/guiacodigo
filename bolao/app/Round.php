<?php

namespace App;

use App\Betting;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = ['betting_id', 'title', 'date_start', 'date_end'];

    public function betting()
    {
        return $this->belongsTo(Betting::class);
    }

    //accessor laravel
    public function getBettingTitleAttribute()
    {
        return $this->betting->title;
    }

}
