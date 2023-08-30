<?php

namespace App\Http\Requests\UserType;

use App\Rules\AgeWeightHeightRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country' => ['required','string'], //normal vaildation
            'city' => ['string','required'], // normal vaildation
            'age' => ['required','numeric','between:4,43'], // from 4 to 43
            'weight' => ['required', new AgeWeightHeightRule ], // from 20 to 100
            'height' => ['required', new AgeWeightHeightRule],  // 100 to 230
            'gender' => ['required' , 'in:male,famle'], //male or famle
            'skills_level' => ['required','in:beginner,professional'], // beginner or profissinal
            'foot_dominant' => ['required','in:right,left'], // reight or left
            'main_position' => ['required','in:goalkeeper,defender,midfielder,forward'], // enum 4 position
            'phone_number' => ['required','numeric','unique:football_players,phone_number'], //
            'whatsapp_number' => ['required','numeric','unique:football_players,whatsapp_number'], //
            // 'possibility_travel' => ['required','in:yes,no'], // yes or no
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:13312'], // required file
        ];
    }
}
