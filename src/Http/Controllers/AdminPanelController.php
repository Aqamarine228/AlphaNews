<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

class AdminPanelController extends AlphaNewsController
{
    public function home()
    {
        return view('alphanews::panel.home');
    }

}
