<?php

declare(strict_types=1);

namespace App\Pages\profiles\companies;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyLegalLocation;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Collapse;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\HiddenIds;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

//use Illuminate\Database\Eloquent\Relations\HasMany;

//use MoonShine\Fields\Relationships\BelongsTo;

//use MoonShine\Fields\Relationships\HasManyThrough;

class CompanyForm extends Page
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
            Hidden::make('user_id')->setValue(auth()->id())->required()->showOnExport(),
        ];
    }


    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            FormBuilder::make(route('company.store'))
                ->fields($this->fieldsCompany())
                ->Cast(ModelCast::make(Company::class))
                ->async(),
        ];
    }
}
