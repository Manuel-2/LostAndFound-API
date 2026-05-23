<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['in:Perdido,Encontrado'],
            'title' => ['required'],
            'description' => ['required'],
            'location_id' => ['in:locations,id'],
            'category_id' => ['in:cateogries,id', 'required'],
            'incident_date' => ['date', 'required'],
        ];
    }
}
