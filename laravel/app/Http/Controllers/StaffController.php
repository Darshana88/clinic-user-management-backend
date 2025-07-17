<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource, with optional filtering by status and role.
     */
    public function index(Request $request)
    {
        $query = Staff::query();
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
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
        $staff = $query->get();
        return response()->json($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string',
            'role' => 'required|in:Practice Owner,Director,Front Office Admin,Records Custodian',
            'status' => 'required|in:Active,Inactive',
        ]);
        $staff = Staff::create($validated);
        return response()->json($staff, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return response()->json($staff);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:staff,email,' . $id,
            'phone' => 'nullable|string',
            'role' => 'sometimes|required|in:Practice Owner,Director,Front Office Admin,Records Custodian',
            'status' => 'sometimes|required|in:Active,Inactive',
        ]);
        $staff->update($validated);
        return response()->json($staff);
    }

    /**
     * Archive the specified resource (set is_archived = true).
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->is_archived = true;
        $staff->save();
        return response()->json(['message' => 'Staff archived successfully.']);
    }

    /**
     * Restore the specified resource (set is_archived = false).
     */
    public function restore($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->is_archived = false;
        $staff->save();
        return response()->json(['message' => 'Staff restored successfully.']);
    }
}
