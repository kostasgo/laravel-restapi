<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Vessel;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVesselRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vessel $vessel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vessel $vessel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVesselRequest $request, Vessel $vessel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vessel $vessel)
    {
        //
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
