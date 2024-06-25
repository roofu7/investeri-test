<?php

namespace App\Models\profiles\Individual;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndividualUserInvestProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'basic_information',
        'individual_user_id',
    ];
    public function individualUser(): BelongsTo
    {
        return $this->belongsTo(IndividualUser::class);
    }
}
