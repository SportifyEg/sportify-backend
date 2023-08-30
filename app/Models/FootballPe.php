<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FootballPe extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'country',
        'city',
        'age',
        'university',
        'college',
        'gender',
        'phone_number',
        'whatsapp_number',
        'cv'];
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

}
