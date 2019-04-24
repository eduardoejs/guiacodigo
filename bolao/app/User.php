<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles($roles)
    {
        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();
    }

    public function hasRole($role)
    {
        if(is_string($role)){
            $role = Role::where('name', $role)->firstOrFail();
        }
        return (boolean) $this->roles()->find($role->id);
    }

    public function bettings()
    {
        return $this->hasMany(Betting::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('administrador');
    }

    //acessor
    public function getRoundsAttribute()
    {
        $bettings = $this->bettings;
        $rounds = [];
        
        foreach ($bettings as $key => $value) {
            $rounds[] = $value->rounds;
        }

        return array_collapse($rounds); //array_collapse -> Sintaxe Laravel versao 5.6, a partir da versao 5.7 foi alterado
    }

}
