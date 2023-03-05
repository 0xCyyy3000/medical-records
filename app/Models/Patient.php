<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Enum;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name',
        'gender', 'civil_status',
        'email', 'phone_number',
        'birthdate', 'birthplace', 'age',
        'address', 'city'
    ];

    public function genders()
    {
        return $this->distinct()->get('gender');
    }
}
