<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiercingAppointment extends Model
{
    use HasFactory;


    public function piercingbodyparts(){
        return $this->belongsTo(PiercingBodyparts::class);
    }

    public function piercingservices(){
        return $this->belongsToMany(PiercingServices::class);
    }
}
