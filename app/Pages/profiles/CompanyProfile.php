<?php
declare(strict_types=1);

namespace App\Pages\profiles;

use App\Models\Company;
use App\Models\CompanyActualLocation;
use App\Models\CompanyContact;
use App\Models\User;
use App\MoonShine\Resources\CompanyActualLocationResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ActionButtons\ActionButton;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class CompanyProfile extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'Профиль компании';

    public function fieldsCompany(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Название', 'name')->required()->showOnExport(),
            Text::make('ИНН', 'inn')->required()->showOnExport(),
            Text::make('ОГРН', 'ogrn')->required()->showOnExport(),
        ];
    }

    public function fieldsCompanyContact(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('email', 'email')->required()->showOnExport(),
            Text::make('phone', 'phone')->required()->showOnExport(),
        ];
    }

    public function fieldsCompanyActualLocation(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('email', 'email')->required()->showOnExport(),
            Text::make('phone', 'phone')->required()->showOnExport(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            FormBuilder::make(route('companyprofilestore'))
                ->fields($this->fieldsCompany())
                ->Cast(ModelCast::make(Company::class)),

            FormBuilder::make(route('companyprofilestore'))
                ->fields($this->fieldsCompanyContact())
                ->Cast(ModelCast::make(CompanyContact::class)),
        ];
    }
}
