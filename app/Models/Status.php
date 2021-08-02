<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = "Status";
    protected $primaryKey = "idStatus";

    public $timestamps=false;

    public $fillable=[
        "labelStatus"
    ];

    public function Timestamps(){
        return $this->hasMany(TimeSlots::class, 'idStatus');
    }

}
