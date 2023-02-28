<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Vessel;
use App\Models\Voyage;
use App\Http\Requests\StoreVesselRequest;
use App\Http\Requests\UpdateVesselRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vessel::all();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVesselRequest $request, Vessel $vessel)
    {

        $vessel->fill($request->validated());
        $vessel->save();
        $newName = $vessel->name;
        $counter = 0;
        //If name was changed, update all voyages of vessel
        $voyages = Voyage::where('vessel_id', $vessel->id)->get();

        foreach ($voyages as $voyage) {
            $voyage->code = str_replace(" ", "_", $newName). '-' . $voyage->start;
            $voyage->save();
            $counter++;
        }

        return response()->json([
            'message' => 'Vessel updated successfully. Updated '. $counter . ' voyage(s) of this vessel.',
            'data' => $vessel
        ]);
    }


    public function financialReport($vesselId){
        $results = DB::select('
SELECT
    v.id as voyage_id,
	v.start as start,
	v.end as end,
    v.revenues as voyage_revenues,
    v.expenses as voyage_expenses,
    v.profit as voyage_profit,
	v.profit / ((EXTRACT(EPOCH FROM (v.end - v.start)) / 86400) + 1)  AS voyage_profit_daily_average,
	COALESCE(SUM(vo.expenses),0) as vessel_expenses_total,
    v.profit - COALESCE(SUM(vo.expenses),0) as net_profit,
	((v.profit - SUM(vo.expenses)) / (EXTRACT(EPOCH from v.end - v.start) / 86400) + 1) AS net_profit_daily_average
FROM
    voyages v
	LEFT JOIN vessels ON vessels.id = v.vessel_id
    LEFT JOIN vessel_opex vo ON vo.vessel_id = vessels.id AND vo.date >= v.start AND vo.date <= v.end
WHERE
	v.vessel_id = ?
GROUP BY
    v.id', [$vesselId]);
        $json = json_encode($results, JSON_PRETTY_PRINT);

        return $json;
    }
}
