<?php

namespace App\Http\Resources\V1;

use App\Models\VesselOpex;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VesselOpexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vessel_id' => $this->vessel_id,
            'date' => $this->date,
            'expenses' => $this->expenses,
            'profit' => $this->id
        ];
    }
}
