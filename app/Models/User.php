<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected  $table="Persons";

    protected $primaryKey = "idPerson";

    public $timestamps = false;

    protected $fillable = [
        'namePerson',
        'emailPerson',
        'pwdPerson',
    ];

    //getting the password for the user because it s hidden
    public function getAuthPassword()
    {
        return $this->pwdPerson;
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pwdPerson',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function guest(){
        return $this->hasOne(Guest::class,'idPerson');
    }

    public function admin(){
        return $this->hasOne(Admin::class,'idPerson');
    }



}
