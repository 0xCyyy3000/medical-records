<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Patient;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Position::create([
            'position' => 'Doctor'
        ]);

        Position::create([
            'position' => 'Secretary'
        ]);

        Address::create([
            'street' => 'Liko-liko street',
            'city' => 'Tacloban City',
            'province' => 'Leyte',
            'zip_code' => 6500
        ]);

        Address::create([
            'street' => 'Kalawakan street',
            'city' => 'Tacloban City',
            'province' => 'Leyte',
            'zip_code' => 6500
        ]);

        User::create([
            'first_name' => 'Cy',
            'middle_name' => 'Pogi',
            'last_name' => 'Always',
            'email' => 'cy@pogi.com',
            'password' => Hash::make('asdfasdf'),
            'position' => 1,
            'phone_number' => '091234567889',
            'address' => 1
        ]);

        Patient::create([
            'first_name' => 'Test',
            'middle_name' => 'Patient',
            'last_name' => 'One',
            'gender' => 'Male',
            'civil_status' => 'Single',
            'email' => 'test_patient@one.com',
            'phone_number' => '09987654321',
            'birthdate' => '01/01/2000',
            'birthplace' => 'Secret birthplace',
            'address' => 2
        ]);
    }
}
