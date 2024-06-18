<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DateTimeRules\DateComparator;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>'required|max:200|min:3',
            'description'=>'required|max:1600',
            'organizator'=>'required|max:255|min:2',
            'available_at' => ['required',new DateComparator()],
            'finish_at'=>'required',
            'ubication_id'=>'required',
            'capacity' => 'required|integer|min:1',
            'image'=> "",

        ];
    }

    public function messages()
    {
    return [
        'title.required' => 'El título es obligatorio.',
        'title.max' => 'El título no puede tener más de :max caracteres.',
        'title.min' => 'El título debe tener al menos :min caracteres.',
        'description.required' => 'La descripción es obligatoria.',
        'description.max' => 'La descripción no puede tener más de :max caracteres.',
        'organizator.required' => 'El organizador es obligatorio.',
        'organizator.max' => 'El organizador no puede tener más de :max caracteres.',
        'organizator.min' => 'El organizador debe tener al menos :min caracteres.',
        'available_at.required' => 'La fecha de inicio es obligatoria.',
        'finish_at.required' => 'La fecha de finalización es obligatoria.',
        'capacity.required' => 'La capacidad maxima del evento es obligatoria.',
        'ubication_id.required' => 'La ubicación es obligatoria.',
        'image' => 'El formato de la imagen no es válido.',
        ];
    }
}
