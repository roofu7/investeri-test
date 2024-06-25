<?php

namespace App\Models\profiles\Individual;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndividualUserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',
        'city',
        'street',
        'house_number',
        'building_number',
        'room_number',
        'individual_user',
    ];

    public function individualUser(): BelongsTo
    {
        return $this->belongsTo(IndividualUser::class);
    }
}
