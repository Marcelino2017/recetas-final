<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikeController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //almacenas los likesde un usuario en la receta
        return auth()->user()->meGusta()->toggle($receta);
    }

}
