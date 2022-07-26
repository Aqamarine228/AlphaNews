<?php

namespace Aqamarine\AlphaNews\Http\Controllers;

use Aqamarine\AlphaNews\Components\SessionAlerts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class AlphaNewsController extends Controller
{
    use ValidatesRequests;

    protected function view($view, array $data = []): Factory|View|Application
    {
        return view('alphanews::'.$view, $data);
    }

    protected function showSuccessMessage($message): void
    {
        (new SessionAlerts())->success($message);
    }

    protected function showErrorMessage($message): void
    {
        (new SessionAlerts())->error($message);
    }

    protected function showWarningMessage($message): void
    {
        (new SessionAlerts())->warning($message);
    }
}
