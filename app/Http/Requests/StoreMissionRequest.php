<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'mission'=>'bail|required|string|max:255',
            'title'=>'bail|required|string|max:255',
            'ville'=>'bail|required|string|max:255',
            'code_postal'=>'bail|required|string|max:255',
            'peage'=>'bail|required|double|max:8.2',
            'parking'=>'bail|required|double|max:8.2',
            'divers'=>'bail|required|double|max:8.2',
            'repas'=>'bail|required|double|max:8.2',
            'hotel'=>'bail|required|double|max:8.2',
            'km'=>'bail|required|double|max:8.2'
        ];
    }
}
