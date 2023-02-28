<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\VesselOpex;
use App\Http\Requests\StoreVesselOpexRequest;
use App\Http\Requests\UpdateVesselOpexRequest;
use App\Http\Controllers\Controller;
use App\Rules\UniqueVesselOpex;

class VesselOpexController extends Controller
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
    public function store(StoreVesselOpexRequest $request, $vesselId)
    {
        $validatedData = $request->validated();

        $vesselOpex = new VesselOpex();
        $vesselOpex->vessel_id = $vesselId;
        $vesselOpex->date = $validatedData['date'];
        $vesselOpex->expenses = $validatedData['expenses'];
        $vesselOpex->save();

        return response()->json([
            'message' => 'Vessel opex added successfully.',
            'data' => $vesselOpex
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VesselOpex $vesselOpex)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VesselOpex $vesselOpex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVesselOpexRequest $request, VesselOpex $vesselOpex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VesselOpex $vesselOpex)
    {
        //
    }
}
