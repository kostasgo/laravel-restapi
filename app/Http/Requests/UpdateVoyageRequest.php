<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVoyageRequest extends FormRequest
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
    public function rules()
    {
        return [
            'start' => 'sometimes|required|date',
            'end' => [
                'sometimes',
                'required',
                'date',
                'after:start',
                function ($attribute, $value, $fail) {
                    $voyage = $this->route('voyage');
                    if (strtotime($value) <= strtotime($voyage->start)) {
                        $fail('The end date must be after the start date. Current start date is ' . $voyage->start);
                    }
                }
                ],
            'revenues' => 'sometimes|required|numeric',
            'expenses' => 'sometimes|required|numeric',
            'status' => [
                'sometimes',
                'required',
                Rule::in(['pending', 'ongoing', 'submitted']),
                function ($attribute, $value, $fail) {
                    $voyage = $this->route('voyage');
                    if ($value === 'ongoing') {
                        $vessel = $voyage->vessel;
                        $ongoingVoyage = $vessel->voyages()->where('status', 'ongoing')->first();
                        if ($ongoingVoyage && $ongoingVoyage->id !== $voyage->id) {
                            $fail('A vessel cannot have two ongoing voyages at the same time. Check voyage with id ' . $ongoingVoyage->id);
                        }
                    } elseif ($value === 'submitted') {
                        if (empty($voyage->start) || empty($voyage->end) || empty($voyage->revenues) || empty($voyage->expenses)) {
                            $fail('A voyage cannot be submitted unless start, end, revenues, and expenses fields are all provided.');
                        }
                    }
                },
            ],
        ];
    }
}
