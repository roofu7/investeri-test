<?php

namespace App\Http\ViewComposers;

use App\Models\Page;
use App\Models\profiles\companies\Company;
use Illuminate\Contracts\View\View;

class PagesComposer
{
    /**
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('company', Company::all());
        $view->with('page', Page::all());
    }
}
