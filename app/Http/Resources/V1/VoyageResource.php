<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoyageResource extends JsonResource
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
            'vesselId' => $this->vessel_id,
            'code' => $this->code,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
            'revenues' => $this->revenues,
            'expenses' => $this->expenses,
            'profit' => $this->profit
        ];
    }
}
