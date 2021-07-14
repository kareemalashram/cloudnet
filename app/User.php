<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;


    protected $fillable = [
        'name','email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $withCount = ['movies'];


    public function getNameAttribute($value){


        return ucfirst($value);

    }//end of get  name

    public function scopeWhenSearch($query , $search ){

        return $query->when($search, function ($q) use ($search){

            return $q->where('name','like',"%$search%");
        });


    } // end of scope

    public function scopeWhenRole($query , $role_id){

        return $query->when($role_id, function ($q) use ($role_id){

            return $this->scopeWhereRole($q , $role_id);
        });
    } // end of scope role


    public function scopeWhereRole($query , $role_name){

        return $query->whereHas('roles', function ($q) use ($role_name){

            return $q->whereIn('name',(array)$role_name)
                ->orWhereIn('id', (array)$role_name);
        });
    } // end of scope role

    public function scopeWhereRoleNot($query , $role_name){

        return $query->whereHas('roles', function ($q) use ($role_name){

            return $q->whereNotIn('name',(array)$role_name)

                ->orWhereNotIn('id', (array)$role_name);

        });
    } // end of scope role_not


    public  function  getImagePathAttribute(){

        return asset('uploads/user_images/'. $this->image);
    }//end of get last image


    //relation --------------------------
    public function movies() {

        return $this->belongsToMany(Movie::class,'user_movie');
    }

}
