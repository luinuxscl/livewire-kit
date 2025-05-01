<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaygroundController extends Controller
{
    public function __invoke(Request $request)
    {
        // Solo root puede acceder
        abort_unless(auth()->user() && auth()->user()->hasRole('root'), 403);
        return view('playground.index');
    }
}
