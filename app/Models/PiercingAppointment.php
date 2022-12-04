<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiercingAppointment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function piercingbodypart(){
        return $this->belongsTo(PiercingBodyPart::class);
    }

    public function servicespiercing(){
        return $this->belongsToMany(ServicesPiercing::class);
    }
}
