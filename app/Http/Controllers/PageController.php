<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Muestra una página estática.
     *
     * @param string $page
     * @return View
     */
    public function show($page): View
    {
        // Permite solo páginas permitidas (por seguridad)
        $allowed = ['about'];
        if (!in_array($page, $allowed)) {
            abort(404);
        }
        return view('pages.' . $page);
    }
}
