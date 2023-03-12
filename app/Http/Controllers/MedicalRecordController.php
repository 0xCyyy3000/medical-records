<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function destroy(Request $request)
    {
        $deleted = MedicalRecord::where('id', $request->diagnosis)->delete();
        if ($deleted) {
            return back()->with('status', 'Deleted successfully!');
        }
        return back()->with('status', 'There was a problem deleting the record');
    }

    public function store(Request $request)
    {
        $stored = MedicalRecord::create([
            'patient' => intval($request->patient),
            'diagnosis' => $request->diagnosis,
            'findings' => $request->findings,
            'plan' => $request->plan,
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
        $updated = MedicalRecord::where('id', $request->did)->update([
            'date' => $request->date,
            'diagnosis' => $request->diagnosis,
            'findings' => $request->findings,
            'doctor' => $request->doctor,
            'plan' => $request->plan
        ]);

        if ($updated) {
            return back()->with('status', 'Medical Record has been updated!');
        }
        return back()->with('status', 'There was a problem updating the record!');
    }
}
