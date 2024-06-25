<?php

namespace App\Models\profiles\Individual;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndividualUserPassport extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'number',
        'issued_whom',
        'date_issue',
        'individual_user_id',
    ];
    public function individualUser(): BelongsTo
    {
        return $this->belongsTo(IndividualUser::class);
    }
}
