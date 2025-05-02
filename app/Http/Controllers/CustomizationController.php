<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function __invoke()
    {
        return view('settings.customization');
    }
}
