<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiercingBodyparts extends Model
{
    use HasFactory;
    protected $table = 'piercing_bodyparts';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function piercing_services()
    {
        return $this->belongsToMany(PiercingServices::class);
    }
}
