<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = "Admins";
    protected $primaryKey = "idPerson";

    public $timestamps=false;

    public $fillable=[
        "hireDateAdmin"
    ];

    public function person(){
        return $this->belongsTo(User::class, 'idPerson');
    }
}
