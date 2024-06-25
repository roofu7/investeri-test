<?php

namespace App\Models\profiles\Individual;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndividualUserContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'individual_user_id',
        'email',
        'phone',
    ];

    public function individualUser(): BelongsTo
    {
        return $this->belongsTo(IndividualUser::class);
    }
}
