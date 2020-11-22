<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginas
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(10);

        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //bloquear una vista paa que no la vean sin estar logueado
        $this->authorize('view', $perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $this->authorize('update', $perfil);
        
        //Validar la entrada de los datos
        $data = $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        //si un usuario sube una imagen
        if ($request['imagen']) 
        {
            //obtenre las rutas de la imagen
            $ruta_imagen = $request['imagen']->store('uploads-perfiles', 'public');

            //Resize la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            //crear un arreglode imagen
            $array_imagen = ['imagen' => $ruta_imagen] ;
        }
        
        //Asignar nobre y URl
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //eliminar url y name de $date
        unset($data['url']);
        unset($data['nombre']);
        //return $data;



        //Guardar información
        //Asignar Biografia e imagen(array_merge Combina dos o más arrays)
        auth()->user()->perfil()->update(array_merge(
            $data, 
            $array_imagen ?? [], //si no existe array_imagen pasa un arreglo vacio
        ));

        //si el usurio sube una imagen
        return redirect()->action('RecetaController@index');
    }
}
