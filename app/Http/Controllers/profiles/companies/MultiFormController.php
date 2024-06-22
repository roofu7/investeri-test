<?php
declare(strict_types=1);

namespace App\Http\Controllers\profiles\companies;

use App\Pages\profiles\companies\MultiForm;
use MoonShine\Http\Controllers\MoonShineController;

class MultiFormController extends MoonShineController
{
    public function create()
    {
        return MultiForm::make();
    }

    public function edit()
    {
        return MultiForm::make();
    }
    public function update()
    {

    }
}
