<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = "guests";
    protected $primaryKey = "idPerson";

    public $timestamps=false;

    public $fillable=[
        'idPerson'
    ];

    public function person(){
        return $this->belongsTo(User::class, 'idPerson');
    }


    public function timeSlots(){
        return $this->hasMany(TimeSlots::class,'idPerson','idPerson');
    }
}
