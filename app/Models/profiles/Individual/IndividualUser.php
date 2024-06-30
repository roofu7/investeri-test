<?php

namespace App\Models\profiles\Individual;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IndividualUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'inn',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function individualUserContact(): HasOne
    {
        return $this->hasOne(IndividualUserContact::class);
    }

    public function individualUserAddress(): HasOne
    {
        return $this->hasOne(IndividualUserAddress::class);
    }

    public function individualUserProject(): HasMany
    {
        return $this->hasMany(IndividualUserInvestProject::class);
    }
    public function individualUserOffer(): HasMany
    {
        return $this->hasMany(IndividualUserInvestOffer::class);
    }

    public function individualUserPassport(): HasOne
    {
        return $this->hasOne(IndividualUserPassport::class);
    }
}
