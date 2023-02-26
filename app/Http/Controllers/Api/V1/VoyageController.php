<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Vessel;
use App\Http\Controllers\Controller;
use App\Models\Voyage;
use App\Http\Requests\StoreVoyageRequest;
use App\Http\Requests\UpdateVoyageRequest;

class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoyageRequest $request)
    {
        // Retrieve validated data
        $validatedData = $request->validated();

        $vessel = Vessel::find($request->vessel_id);
        if (!$vessel) {
            return response()->json(['error' => 'Vessel not found'], 404);
        }

        // Create the voyage record
        $voyage = new Voyage;
        $voyage->vessel_id = $validatedData['vessel_id'];
        $voyage->code = str_replace(" ", "_", $vessel->name).'-'.$validatedData['start'];
        $voyage->start = $validatedData['start'];
        $voyage->end = $validatedData['end'];
        $voyage->status = 'pending';
        $voyage->revenues = $validatedData['revenues'];
        $voyage->expenses = $validatedData['expenses'];
        $voyage->profit = $validatedData['revenues'] - $validatedData['expenses'];
        $voyage->save();

        return response()->json(['message' => 'Voyage created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Voyage $voyage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voyage $voyage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoyageRequest $request, Voyage $voyage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voyage $voyage)
    {
        //
    }
}
