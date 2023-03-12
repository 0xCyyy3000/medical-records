<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Patient;
use App\Models\VitalSign;
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
            'email' => 'nullable|unique:patients|email:rfc,dns|max:255',
            'phone_number' => ['required', 'unique:patients', 'digits:11', 'numeric'],
        ]);


        $patient_address = $request->validate([
            'street' => ['required', 'max:255'],
            'city' => ['required', 'max:255', 'string'],
            'province' => ['required', 'max:255', 'string'],
            'zip_code' => ['required', 'numeric', 'digits:4']
        ]);

        $vital_signs = $request->validate([
            'blood_pressure' => 'required',
            'respiratory_rate' => 'required',
            'capillary_refill' => 'required',
            'temperature' => 'required',
            'pulse_rate' => 'required',
            'weight' => 'required',
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
            $vital_signs['patient'] = $patient_created->id;
            VitalSign::create($vital_signs);
            return redirect()->route('index.patient')->with('success', 'Patient has been added!');
        }

        return redirect()->route('index.patient')->with('error', 'There was a problem adding the patient. Please try to contact the administrator');
    }

    public function select($id)
    {
        $patient = Patient::find($id);
        $full_name = "$patient->first_name {$patient->middle_name[0]}. $patient->last_name";
        $patient->full_name = $full_name;
        $address = Address::find($patient->address);

        $vital_signs = VitalSign::where('patient', $id)->first();

        return view(
            'pages.patient',
            [
                'title' => $full_name,
                'patient' => $patient,
                'address' => $address,
                'vital_signs' => $vital_signs
            ]
        );
    }

    public function update(Request $request)
    {
        $patient = Patient::where('id', $request->patient)->first();

        $patient_info = $request->validate([
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'civil_status' => 'required',
            'gender' => 'required',
            'birthdate' => ['required', 'date'],
            'birthplace' => ['required', 'max:255'],
            'email' => ($request->email and $request->email != $patient->email) ? ['email:rfc,dns, unique:patients', 'max:255'] : '',
            'phone_number' => ($request->phone_number and $request->phone_number != $patient->phone_number) ? ['required', 'unique:patients', 'digits:11', 'numeric'] :
                ['required', 'digits:11', 'numeric'],
            'city' => ['required', 'max:255']
        ]);

        $today = date('m/d/Y');
        $difference = date_diff(date_create($patient_info['birthdate']), date_create(Carbon::parse($today)->format('m/d/Y')));
        $age = $difference->format('%y');
        $patient_info['age'] = $age;

        $patient_address = $request->validate([
            'street' => ['required', 'max:255'],
            'city' => ['required', 'max:255', 'string'],
            'province' => ['required', 'max:255', 'string'],
            'zip_code' => ['required', 'numeric', 'digits:4']
        ]);

        if (Patient::where('id', $request->patient)->update($patient_info) and Address::where('id', $patient->address)->update($patient_address)) {
            return back()->with('alert', 'Changes has been saved!');
        }

        return back()->with('error', 'There was a problem adding the patient. Please try to contact the administrator');
    }

    public function destroy(Request $request)
    {
        if (Patient::where('id', $request->patient)->delete()) {
            return redirect()->route('index.patient')->with('alert', 'Patient has been deleted!');
        }

        return back()->with('error', 'There was an error during deletion. Please try to contact the administrator');
    }
}
