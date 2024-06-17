<?php

namespace App\Models\profiles\companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyInvestProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'basic_information',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
