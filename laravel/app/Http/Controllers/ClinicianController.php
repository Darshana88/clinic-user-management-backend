<?php

namespace App\Http\Controllers;

use App\Models\Clinician;
use Illuminate\Http\Request;

class ClinicianController extends Controller
{
    /**
     * Display a listing of the resource, with optional filtering by status and role.
     */
    public function index(Request $request)
    {
        $query = Clinician::query();
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
        }
        if ($request->has('location')) {
            $query->where('location', $request->input('location'));
        }
        if ($request->has('is_archived')) {
            $query->where('is_archived', filter_var($request->input('is_archived'), FILTER_VALIDATE_BOOLEAN));
        }
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
        $clinicians = $query->get();
        return response()->json($clinicians);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:clinicians,email',
            'phone' => 'nullable|string',
            'role' => 'required|in:Psychotherapist,Case Manager,Navigator',
            'location' => 'required|in:AL,AK,AZ,AR,CA,CO,CT,DE,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MD,MA,MI,MN,MS,MO,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY',
            'languages' => 'required|array',
            'languages.*' => 'in:English,Spanish,Portuguese',
            'supervising_clinician_id' => 'nullable|exists:clinicians,id',
            'status' => 'required|in:Active,Inactive',
        ]);
        $clinician = Clinician::create($validated);
        return response()->json($clinician, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clinician = Clinician::findOrFail($id);
        return response()->json($clinician);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clinician = Clinician::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:clinicians,email,' . $id,
            'phone' => 'nullable|string',
            'role' => 'sometimes|required|in:Psychotherapist,Case Manager,Navigator',
            'location' => 'sometimes|required|in:AL,AK,AZ,AR,CA,CO,CT,DE,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MD,MA,MI,MN,MS,MO,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY',
            'languages' => 'sometimes|required|array',
            'languages.*' => 'in:English,Spanish,Portuguese',
            'supervising_clinician_id' => 'nullable|exists:clinicians,id',
            'status' => 'sometimes|required|in:Active,Inactive',
        ]);
        $clinician->update($validated);
        return response()->json($clinician);
    }

    /**
     * Archive the specified resource (set is_archived = true).
     */
    public function destroy($id)
    {
        $clinician = Clinician::findOrFail($id);
        $clinician->is_archived = true;
        $clinician->save();
        return response()->json(['message' => 'Clinician archived successfully.']);
    }

    /**
     * Restore the specified resource (set is_archived = false).
     */
    public function restore($id)
    {
        $clinician = Clinician::findOrFail($id);
        $clinician->is_archived = false;
        $clinician->save();
        return response()->json(['message' => 'Clinician restored successfully.']);
    }
}
