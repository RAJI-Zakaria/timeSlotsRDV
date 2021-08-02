<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    use HasFactory;


    protected $table = "TimeSlots";
    protected $primaryKey = "idTimeSlot";

    public $timestamps=false;
//`idTimeSlot`, `startDateTimeSlot`, `reasonTimeSlot`, `idPerson`, `idStatus`
    public $fillable=[
        "startDateTimeSlot",
        "reasonTimeSlot",
        "idPerson",
        "idStatus",
    ];


    public function person(){
        return $this->belongsTo(User::class, 'idPerson');
    }

    public function status(){
        return $this->hasOne(Status::class, 'idStatus', 'idStatus');
    }
}
