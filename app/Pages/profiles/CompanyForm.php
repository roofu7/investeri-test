<?php

namespace App\Pages\profiles;

use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\User;
use App\MoonShine\Resources\CompanyContactResource;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_User_C;
use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Hidden;
use MoonShine\Fields\ID;

//use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsTo;
//use MoonShine\Fields\Relationships\HasManyThrough;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;
use MoonShine\Fields\Relationships\HasMany;

class CompanyForm extends Page
{
//    protected ?User $item = null;
    protected string $layout = 'userprofile';
    protected string $title = 'Компания';
    /*public function fields(): array
    {
        return [
            Block::make([
                ID::make(),
                Text::make('tttt')->required(),
            ])
        ];
    }

    protected function hasItem(): bool
    {
        return request()->filled('_id');
    }

    protected function getItem(): Model
    {
//        return User::query()->where('id', auth()->id())->paginate();
        if (!is_null($this->item)) {
            return $this->item;
            }
        return User::query()->find(request()->input('_id'));
    }*/

    /**
     * @inheritDoc
     */

    public function components(): array
    {
        return [
            FormBuilder::make(route('store'))
                ->fields([
//                    Hidden::make('user_id', 'user_id', formatted: fn() => User::query()->where('id', auth()->id())->paginate()),
//                    BelongsTo::make('eee', 'user', resource: new UserProfileResource()),
//                    HasMany::make('uuu', 'CompanyForm', resource: new UserCompanyResource())->getParentResource(),
//                    Text::make('sss', 'user_id', fn() => User::query()->where('id', auth()->id()))->required(),
//                    ID::make('uuu', 'user_id')->parent(),
//                    Hidden::make('', 'id', formatted: fn() => Text::make('User', 'user_id'))->required(),
//                    Auth::class(),
                    Text::make('Название', 'name')->required(),
                    Text::make('ИНН', 'inn')->required(),
                    Text::make('ОГРН', 'ogrn')->required(),
//                    Hidden::make('sss', 'user_id'),
                ])//->FillCast(Company::query()->where('user_id', auth()->id()) ,ModelCast::make(Company::class))
        ];
    }
}
