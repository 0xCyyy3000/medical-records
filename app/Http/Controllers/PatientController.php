<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $patient_info = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'civil_status' => 'required',
            'gender' => 'required',
            'birthdate' => ['required', 'date'],
            'birthplace' => ['required', 'max:255'],
            'email' => $request->email ? ['email:rfc,dns, unique:patients', 'max:255'] : '',
            'phone_number' => ['required', 'unique:patients', 'digits:11', 'numeric'],
        ]);


        $patient_address = $request->validate([
            'street' => ['required', 'max:255'],
            'city' => ['required', 'max:255', 'string'],
            'province' => ['required', 'max:255', 'string'],
            'zip_code' => ['required', 'numeric', 'digits:4']
        ]);

        $address = Address::create($patient_address);

        // Retrieving the patient address before storing
        $patient_info['address'] = $address->id;
        $patient_info['city'] = $address->city;

        // Computing age based on birthdate
        $today = date('m/d/Y');
        $difference = date_diff(date_create($patient_info['birthdate']), date_create(Carbon::parse($today)->format('m/d/Y')));
        $age = $difference->format('%y');
        $patient_info['age'] = $age;

        $patient_created = Patient::create($patient_info);

        if ($patient_created) {
            return redirect()->route('index.patient')->with('success', 'Patient has been added!');
        } else
            return redirect()->route('index.patient')->with('error', 'There was a problem adding the patient. Please try contact the administrator');
    }

    public function select($id)
    {
        $patient = Patient::find($id);
        $full_name = "$patient->first_name {$patient->middle_name[0]}. $patient->last_name";
        $patient->full_name = $full_name;
        $address = Address::find($patient->address);

        return view(
            'pages.patient',
            [
                'title' => $full_name,
                'patient' => $patient,
                'address' => $address
            ]
        );
    }

    public function destroy(
        Request $rqe
    ) {
        echo 'soft delete';
    }
}
