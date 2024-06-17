<?php

namespace App\Models\profiles\companies;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'inn',
        'ogrn',
        'name',
        'user_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function companyContact(): HasOne
    {
        return $this->hasOne(CompanyContact::class);
    }
    public function companyInvestProject(): HasOne
    {
        return $this->hasOne(CompanyInvestProject::class);
    }
    public function companyActualLocation(): HasOne
    {
        return $this->hasOne(CompanyActualLocation::class);
    }
    public function companyLegalLocation(): HasOne
    {
        return $this->hasOne(CompanyLegalLocation::class);
    }
}
