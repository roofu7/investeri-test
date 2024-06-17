<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\profiles\companies\CompanyActualLocation;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;

/**
 * @extends ModelResource<CompanyActualLocation>
 */
class CompanyActualLocationResource extends ModelResource
{
    protected string $model = CompanyActualLocation::class;

    protected string $title = 'Юридический адрес';

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
     * @param CompanyActualLocation $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
