<?php

declare(strict_types=1);

namespace App\Pages\profiles\investProject;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyInvestProject;
use App\Models\User;
use App\MoonShine\Resources\CompanyInvestProjectResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use MoonShine\Components\FormBuilder;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

//use MoonShine\Pages\Pages;

class InvestProjectForm extends page
{
    protected string $layout = 'userprofile';
    protected string $title = 'investprojectform';

    public function companyId()
    {
        return User::find(auth()->id())->companyForm;
//        dd($company);
//       return CompanyInvestProject::find($company);
//       $t = $rel;
//       return $t->companies;
    }

    public function fields(): array
    {
        return [
            id::make()->sortable()->showonexport(),
            BelongsTo::make('Компания', 'company', formatted: fn(Company $company) => $company->id.$company->name, resource: new UserCompanyResource()),
            text::make('название', 'name')->required()->showonexport(),
            text::make('Краткая информация', 'basic_information')->required()->showonexport(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function components(): array
    {
        return [
            formbuilder::make(route('invest.projects.store', parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->fields($this->fields())
                ->cast(modelcast::make(CompanyInvestProject::class))
                ->async(),
        ];
    }

}
