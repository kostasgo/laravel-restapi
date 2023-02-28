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


}
