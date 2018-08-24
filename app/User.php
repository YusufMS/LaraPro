<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'profileImage' => 'PP_not_available.jpg',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }


    // User Roles

    public function authorizeRoles($roles){
        if (is_array($roles)) {return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');}
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

/**

* Check multiple roles

* @param array $roles

*/

    public function hasAnyRole($roles){
        return null !== $this->roles()->whereIn(‘name’, $roles)->first();
    }

/**

* Check one role

* @param string $role

*/

    public function hasRole($role){
        return null !== $this->roles()->where(‘name’, $role)->first();
    }
}
