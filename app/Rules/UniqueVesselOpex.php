<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\VesselOpex;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UniqueVesselOpex implements Rule
{
    private $vesselId;
    private $date;

    public function __construct($vesselId, $date)
    {
        $this->vesselId = $vesselId;
        $this->date = $date;
    }

    public function passes($attribute, $value)
    {
        $count = DB::table('vessel_opex')
            ->where('vessel_id', $this->vesselId)
            ->where('date', $this->date)
            ->count();

        $passes = ($count == 0);

        Log::info('Validation for UniqueVesselOpex', [
            'vessel_id' => $this->vesselId,
            'date' => $this->date,
            'passes' => $passes
        ]);

        return $passes;
    }

    public function message()
    {
        return 'A vessel cannot have two different opex amounts for the same date.';
    }
}
