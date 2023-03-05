<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient',
        'blood_pressure', 'respiratory_rate',
        'capillary_refill', 'temperature',
        'pulse_rate', 'weight'
    ];
}
