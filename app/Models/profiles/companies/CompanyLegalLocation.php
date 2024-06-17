<?php

namespace App\Models\profiles\companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyLegalLocation extends Model
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
