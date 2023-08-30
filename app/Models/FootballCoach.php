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
}
