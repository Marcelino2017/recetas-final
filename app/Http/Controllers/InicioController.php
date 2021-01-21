<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //obtner la recetas mas nuevas
        $nuevas = Receta::latest('id')->take(3)->get();
        //$nuevas = Receta::orderBy('created_at','DESC')->get();

        //obtener Todas las categorias  
        $categorias = CategoriaReceta::all();

        //agrupar recetas por categorias
        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();  
        }
        //  return $recetas;
        return view('Inicio.index', compact('nuevas', 'recetas'));
    }
}
