<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\profiles\companies\CompanyContact;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<CompanyContact>
 */
class CompanyContactResource extends ModelResource
{
    protected string $model = CompanyContact::class;

    protected string $title = 'Контакты компании';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
            ]),
        ];
    }

    /**
     * @param \App\Models\profiles\companies\CompanyContact $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
