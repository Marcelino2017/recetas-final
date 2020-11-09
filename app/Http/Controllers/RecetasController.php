<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetasController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $recetas = [
            'Pizza',
            'Hamburgesa',
            'postre'

        ];
        return view('recetas.index', compact('recetas'));
    }
}
