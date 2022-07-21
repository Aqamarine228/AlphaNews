<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminPanelController extends AlphaNewsController
{
    public function dashboard(): Factory|View|Application
    {
        return view('alphanews::panel.dashboard');
    }

}
