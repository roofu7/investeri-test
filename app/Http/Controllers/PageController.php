<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getPages(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $page = Page::all();
        return view('layouts.main', compact('page'));

    }
}
