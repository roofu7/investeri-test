<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyActualLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'region',
        'city',
        'street',
        'house_number',
        'building_number',
        'room_number',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
