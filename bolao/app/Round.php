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

    public function getDateStartSiteAttribute()
    {
        $date = \date_create($this->date_start);
        return \date_format($date, 'd/m/Y H:i:s');
    }

    public function getDateEndSiteAttribute()
    {
        $date = \date_create($this->date_end);
        return \date_format($date, 'd/m/Y H:i:s');
    }

    //mutators
    public function setDateStartAttribute($value)
    {
        $date = \date_create($value);
        $this->attributes['date_start'] = \date_format($date, 'Y-m-d H:i:s');
    }

    public function setDateEndAttribute($value)
    {
        $date = \date_create($value);
        $this->attributes['date_end'] = \date_format($date, 'Y-m-d H:i:s');
    }

}
