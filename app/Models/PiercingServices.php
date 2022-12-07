<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiercingServices extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function piercing_bodyparts()
    {
        return $this->belongsToMany(PiercingBodyparts::class);
    }

    public function piercing_appointments()
    {
        return $this->belongsToMany(PiercingAppointment::class);
    }
}
