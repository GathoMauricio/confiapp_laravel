<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OriginalController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function appConfig()
    {
        return view('app_config');
    }

    public function appConfig2()
    {
        return view('app_config2');
    }

    public function opcion()
    {
        return view('opcion');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function recomienda()
    {
        return view('recomienda');
    }
}
