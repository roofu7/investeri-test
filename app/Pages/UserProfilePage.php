<?php

declare(strict_types=1);

namespace App\Pages;

use App\Models\profiles\companies\Company;
use App\Models\profiles\companies\CompanyContact;
use App\Models\User;
use App\MoonShine\Resources\UserCompanyResource;
use App\MoonShine\Resources\UserProfileResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use MoonShine\Components\TableBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\LineBreak;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Pages\Page;
use MoonShine\TypeCasts\ModelCast;

class UserProfilePage extends Page
{
//    protected ?User $itemUser = null;
    protected string $layout = 'userprofile';
    protected string $title = 'UserProfilePage';

//    public function breadcrumbs(): array
//    {
//        return [
//            '/user_profile' => 'Профиль'
//        ];
//    }

    protected function getItemsUser(): LengthAwarePaginator
    {
        return User::query()
            ->where('id', auth()->id())
            ->paginate();
    }

    protected function getItemsCompany(): LengthAwarePaginator
    {
        return Company::query()
            ->where('user_id', auth()->id())
            ->paginate();
    }

    public function fieldsUser(): array
    {
        return [
            ID::make(),
            Text::make('name')->required(),
        ];
    }

    public function fieldsCompany(): array
    {
        return [
            ID::make(),
            Text::make('name')->required(),
        ];
    }

    public function components(): array
    {
        return [
            LineBreak::make(),
            Grid::make([
                Column::make([
                    Block::make('User', [
                        TableBuilder::make()
                            ->items($this->getItemsUser())
                            ->fields($this->fieldsUser())
                            ->cast(ModelCast::make(User::class)),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('Мои компании', [
                        TableBuilder::make()
                            ->items($this->getItemsCompany())
                            ->fields($this->fieldsCompany())
                            ->cast(ModelCast::make(Company::class)),
                    ]),
                ])->columnSpan(6),
            ]),

        ];
    }
}
