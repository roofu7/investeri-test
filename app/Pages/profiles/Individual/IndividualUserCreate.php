<?php

declare(strict_types=1);

namespace App\Pages\profiles\Individual;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyActualLocation;
use App\Models\profiles\companies\CompanyContact;
use App\Models\profiles\companies\CompanyLegalLocation;
use App\Models\profiles\Individual\IndividualUser;
use App\Models\profiles\Individual\IndividualUserAddress;
use App\Models\profiles\Individual\IndividualUserPassport;
use App\Models\User;
use App\MoonShine\Resources\CompanyContactResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
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
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class IndividualUserCreate extends Page
{
    protected string $layout = 'userprofile';
    protected string $title = 'IndividualUserCreate';


    public function fieldsIndividualUser(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('ФИО', 'full_name')->required()->showOnExport(),
            Text::make('ИНН', 'inn')->required()->showOnExport(),
            Hidden::make('user_id')->setValue(auth()->id())->required()->showOnExport(),
        ];
    }

    public function hasId(): bool
    {
        return IndividualUser::query()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function detId()
    {
        if (!$this->hasId()) {
            return 1;
        }
        return User::find(auth()->id())->individualUser->id;
    }

    public function fieldsIndividualUserPassport(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Серия', 'serial')->required()->showOnExport(),
            Text::make('Номер', 'number')->required()->showOnExport(),
            Text::make('Кем выдан', 'issued_whom')->required()->showOnExport(),
            Text::make('Дата выдачи', 'date_issue')->required()->showOnExport(),
            Hidden::make('individual_user_id')
                ->setValue($this->detId())
                ->required()
                ->showOnExport()
        ];
    }

    public function fieldsIndividualUserAddress(): array
    {
        return [
            ID::make()->sortable()->showOnExport(),
            Text::make('Регион', 'region')->required()->showOnExport(),
            Text::make('Город', 'city')->required()->showOnExport(),
            Text::make('Улица', 'street')->required()->showOnExport(),
            Text::make('Номер дома', 'house_number')->required()->showOnExport(),
            Text::make('Корпус', 'building_number')->required()->showOnExport(),
            Text::make('Квартира', 'room_number')->required()->showOnExport(),
            Hidden::make('individual_user_id')
                ->setValue($this->detId())
                ->required()
                ->showOnExport()
        ];
    }

    /**
     * @inheritDoc
     */
    public function components(): array
    {
        return [
            FormBuilder::make(route('individual.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->fields($this->fieldsIndividualUser())
                ->Cast(ModelCast::make(IndividualUser::class))
                ->async(),

            FormBuilder::make(route('individual.passport.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->fields($this->fieldsIndividualUserPassport())
                ->Cast(ModelCast::make(IndividualUserPassport::class))
                ->async(),

            FormBuilder::make(route('individual.address.store',
                parameters: ['user' => auth()->user()->getAttribute('name')]))
                ->fields($this->fieldsIndividualUserAddress())
                ->Cast(ModelCast::make(IndividualUserAddress::class))
                ->async(),
        ];
    }
}
