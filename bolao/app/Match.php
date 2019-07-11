<?php

namespace App;

use App\Round;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['round_id', 'title', 'stadium', 'team_a', 'team_b', 'result', 'scoreboard_a', 'scoreboard_b', 
                           'date'];

    public function round()
    {
        return $this->belongsTo(Round::class);
    }  
    
    //acessor
    public function getDateSiteAttribute()
    {
        $date = \date_create($this->date);
        return \date_format($date, 'd/m/Y H:i:s');
    }

    public function getRoundTitleAttribute()
    {
        // pego o titulo da rodada por meio do relacionamento round() acima e concateno com o titulo do campeonato
        //por meio do acessor betting_title que está no model Round
        return $this->round->title .' - '. $this->round->betting_title; 
    }

    //mutator
    public function setDateAttribute($value)
    {
        $date = \date_create($value);
        $this->attributes['date'] = \date_format($date, 'Y-m-d H:i:s');
    }
}
