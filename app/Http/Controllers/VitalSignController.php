<?php

namespace App\Http\Controllers;

use App\Models\VitalSign;
use Illuminate\Http\Request;

class VitalSignController extends Controller
{
    public function update(Request $request)
    {
        $vital_signs = $request->validate([
            'blood_pressure' => 'required',
            'respiratory_rate' => 'required',
            'capillary_refill' => 'required',
            'temperature' => 'required',
            'pulse_rate' => 'required',
            'weight' => 'required',
        ]);

        $updated = VitalSign::where('patient', $request->patient)->update($vital_signs);

        if ($updated) {
            return back()->with('alert', 'Changes has been saved!');
        }

        return back()->with('error', 'Opps! There was an error, please try again later.');
    }
}
