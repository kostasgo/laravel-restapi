<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationalExpensesResource extends JsonResource
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
            'code' => $this->code,
            'start' => $this->start,
            'end' => $this->end,
            'expenses' => $this->id,
            'profit' => $this->id,
        ];
    }
}
