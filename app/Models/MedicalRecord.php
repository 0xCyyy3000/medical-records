<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'patient',
        'diagnosis',
        'findings',
        'plan',
        'doctor',
        'date'
    ];
}
