<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::all();

        return response()->json([
            'complaints' => $complaints
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComplaintRequest $request)
    {
        $request->validated();

        $complaint = Complaint::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'reason_for_complaint' => $request['reason_for_complaint'],
            'description' => $request['description'],
        ]);

        return response()->json([
            'message' => 'Complaint created successfully',
            'complaint' => $complaint
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        return response()->json([
            'complaint' => $complaint
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return response()->json([
            'message' => 'Complaint deleted successfully'
        ], 200);
    }
}
