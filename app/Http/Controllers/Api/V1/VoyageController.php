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
        return Voyage::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoyageRequest $request)
    {
        // Retrieve validated data
        $validatedData = $request->validated();

        // Set a default value of null for non required data if it's not provided

        $vessel = Vessel::find($request->vessel_id);
        if (!$vessel) {
            return response()->json(['error' => 'Vessel not found'], 404);
        }

        // Create the voyage record
        $voyage = new Voyage;

        $voyage->fill($validatedData);

        $voyage->code = str_replace(" ", "_", $vessel->name).'-'.$validatedData['start']; //Creating code from vessel name and start date.
        $voyage->status = 'pending'; // Status starts by default at 'pending'

        $voyage->profit = $voyage->revenues - $voyage->expenses; // Profit = revenues - expenses

        $voyage->save();

        return response()->json([
            'message' => 'Voyage created successfully.',
            'data' => $voyage
        ]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoyageRequest $request, Voyage $voyage)
    {
        $voyage->fill($request->validated());

        if ($voyage->status == 'submitted') {
            $voyage->profit = $voyage->revenues - $voyage->expenses;
        }

        //Update the code based on the starting date
        $vessel = Vessel::find($voyage->vessel_id);
        if (!$vessel) {
            return response()->json(['error' => 'Voyage appears to have a non existent vessel'], 404);
        }

        $newStart = $voyage->start;
        $voyage->code = str_replace(" ", "_", $vessel->name).'-'.$newStart;
        $voyage->save();


        return response()->json([
            'message' => 'Voyage updated successfully.',
            'data' => $voyage
        ]);
    }

}
