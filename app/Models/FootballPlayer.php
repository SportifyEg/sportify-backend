<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FootballPlayer extends Model
{
    use HasFactory;


    protected $fillable =[
        'user_id',
        'country',
        'city',
        'age',
        'weight',
        'height',
        'gender',
        'skills_level',
        'foot_dominant',
        'main_position',
        'phone_number',
        'whatsapp_number',
        // 'possibility_travel',
        'cv'];


        public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
