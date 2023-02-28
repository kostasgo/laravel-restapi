<?php

namespace App\Http\Requests;

use App\Models\VesselOpex;
use App\Rules\UniqueVesselOpex;
use Illuminate\Foundation\Http\FormRequest;

class StoreVesselOpexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date_format:Y-m-d',
                new UniqueVesselOpex($this->vessel_id, $this->date)
            ],
            'expenses' => 'required|numeric'
        ];
    }
}
