<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesPiercing extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function piercingbodyparts()
    {
        return $this->belongsToMany(PiercingBodyPart::class);
    }

    public function piercingappointments()
    {
        return $this->belongsToMany(PiercingAppointment::class);
    }
}
