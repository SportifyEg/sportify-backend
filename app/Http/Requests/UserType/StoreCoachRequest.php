<?php

namespace App\Http\Requests\UserType;

use App\Rules\AgeWeightHeightRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCoachRequest extends FormRequest
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
            'jop_title' => ['required','numeric','between:0,60'], // from 4 to 43
            'gender' => ['required' , 'in:male,famle'], //male or famle
            'phone_number' => ['required','numeric','unique:football_coaches,phone_number'], //
            'whatsapp_number' => ['required','numeric','unique:football_coaches,whatsapp_number'], //
            // 'possibility_travel' => ['required','in:yes,no'], // yes or no
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:13312'], // required file
        ];
    }
}
