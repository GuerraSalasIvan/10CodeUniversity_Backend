<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UbicationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'place'=>'required|max:200|min:3',
            'place_description'=>'required|max:600',
            'address'=>'required|max:255|min:2',
            // 'available_at' => ['required',new DateComparator()],
            // 'finish_at'=>'required',
            'capacity'=>'required',
            'opens_at'=>'required',
            'closes_at'=>'required',
            'image'=> "",
        ];
    }

    public function messages()
{
    return [
        'place.required' => 'El campo lugar es obligatorio.',
        'place.max' => 'El campo lugar no puede tener más de :max caracteres.',
        'place.min' => 'El campo lugar debe tener al menos :min caracteres.',
        'place_description.required' => 'La descripción del lugar es obligatoria.',
        'place_description.max' => 'La descripción del lugar no puede tener más de :max caracteres.',
        'address.required' => 'La dirección es obligatoria.',
        'address.max' => 'La dirección no puede tener más de :max caracteres.',
        'address.min' => 'La dirección debe tener al menos :min caracteres.',
        'capacity.required' => 'El campo capacidad es obligatorio.',
        'opens_at.required' => 'La hora de apertura es obligatoria.',
        'closes_at.required' => 'La hora de cierre es obligatoria.',
    ];
}
}
