<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view(
            'pages.dashboard',
            [
                'title' => 'Dashboard'
            ]
        );
    }

    public function addPatient()
    {
        return view(
            'pages.add-patient',
            [
                'title' => 'Add Patient'
            ]
        );
    }

    public function patients()
    {
        return view(
            'pages.patients',
            [
                'title' => 'Patients'
            ]
        );
    }
}
