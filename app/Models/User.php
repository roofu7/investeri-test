<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyInvestOffer;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\profiles\companies\CompanyLegalLocation;
use App\Models\profiles\Individual\IndividualUser;
use App\Models\profiles\Individual\IndividualUserAddress;
use App\Models\profiles\Individual\IndividualUserContact;
use App\Models\profiles\Individual\IndividualUserInvestOffer;
use App\Models\profiles\Individual\IndividualUserInvestProject;
use App\Models\profiles\Individual\IndividualUserPassport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*-------------------------------------------------- Company -----------------------------------------------------*/
    public function companyForm(): HasMany
    {
        return $this->hasMany(Company::class);
    }
    public function companyContacts(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyContact::class, Company::class);
    }
    public function companyInvestProjects(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyInvestProject::class, Company::class);
    }
    public function companyInvestOffers(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyInvestOffer::class, Company::class);
    }
    public function companyActualLocations(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyActualLocation::class, Company::class);
    }
    public function companyLegalLocations(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyLegalLocation::class, Company::class);
    }

    /*------------------------------------------- Individual User ----------------------------------------------------*/
    public function individualUsers(): HasOne
    {
        return $this->hasOne(IndividualUser::class);
    }
    public function individualUserContacts(): HasManyThrough
    {
        return $this->hasManyThrough(IndividualUserContact::class, IndividualUser::class);
    }
    public function individualUserAddresses(): HasManyThrough
    {
        return $this->hasManyThrough(IndividualUserAddress::class, IndividualUser::class);
    }
    public function individualUserInvestProjects(): HasManyThrough
    {
        return $this->hasManyThrough(IndividualUserInvestProject::class, IndividualUser::class);
    }
    public function individualUserInvestOffers(): HasManyThrough
    {
        return $this->hasManyThrough(IndividualUserInvestOffer::class, IndividualUser::class);
    }
    public function individualUserPassports(): HasManyThrough
    {
        return $this->hasManyThrough(IndividualUserPassport::class, IndividualUser::class);
    }
}
