<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FootballCoach extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'country',
        'city',
        'age',
        'jop_title',
        'gender',
        'phone_number',
        'whatsapp_number',
        'cv'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public static function rules(): array
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
