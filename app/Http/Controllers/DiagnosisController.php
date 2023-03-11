<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function destroy(Request $request)
    {
        $deleted = Diagnosis::where('id', $request->diagnosis)->delete();
        if ($deleted) {
            return back()->with('status', 'Deleted successfully!');
        }
        return back()->with('status', 'There was a problem deleting diagnosis');
    }

    public function store(Request $request)
    {
        $stored = Diagnosis::create([
            'patient' => intval($request->patient),
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'date' => $request->date,
            'doctor' => $request->doctor
        ]);

        if ($stored) {
            return back()->with('status', 'Medical Record has been saved!');
        }
        return back()->with('status', 'There was a problem saving the record!');
    }

    public function update(Request $request)
    {
        $updated = Diagnosis::where('id', $request->did)->update([
            'date' => $request->date,
            'diagnosis' => $request->diagnosis,
            'doctor' => $request->doctor,
            'prescription' => $request->prescription
        ]);

        if ($updated) {
            return back()->with('status', 'Medical Record has been updated!');
        }
        return back()->with('status', 'There was a problem updating the record!');
    }
}
