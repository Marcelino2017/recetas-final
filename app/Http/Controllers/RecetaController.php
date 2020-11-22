<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    //para que se ingrse solo los registrado
    public function __construct(){
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // auth()->user()->recetas->dd();
       // Auth::user()->recetas->dd();
        // $usuario = auth()->user();
        // $recetas = auth()->user()->recetas;
        $usuario = auth()->user()->id;

        //Rectas con paginacion
        $recetas = Receta::where('user_id', $usuario)->paginate(10);

        return view('recetas.index', compact('recetas', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categoria_recetas')->get()->pluck('nombre', 'id')->add();
        //Obtener categoria(sin modelo)
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
    
        //con modelo
        $categorias = CategoriaReceta::all('id', 'nombre');

        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request['imagen']->store('uploads-recetas', 'public');
        $data = $request->validate([
            'titulo'       => 'required | min:6',
            'preparacion'  => 'required',
            'ingredientes' => 'required',
            'imagen'       => 'required | image',
            'categoria'    => 'required',
        ]);
        //obtenre las rutas de la imagen
        $ruta_imagen = $request['imagen']->store('uploads-recetas', 'public');

        //Resize la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
        $img->save();
        
        //almacenar el base de datos y (modelos)
        DB::table('recetas')->insert([
            'titulo'       => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion'  => $data['preparacion'],
            'user_id'      => Auth::user()->id,
            'imagen'       => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);
        
        //redireccion
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        
        return view('recetas.show', compact('receta')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta       
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //revisar policy
       // $this->authorize('view', $receta);

        $categorias = CategoriaReceta::all('id', 'nombre');
       // return $receta;
        return view('recetas.edit', compact('receta','categorias'));
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
        //revisa el Policy
       // $this->authorize('update', $receta);

        $data = $request->validate([
            'titulo'       => 'required | min:3',
            'preparacion'  => 'required',
            'ingredientes' => 'required',
            'categoria'    => 'required',
        ]);

        //asignar valor
        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];        

        //si el usuario sube una nueva imagen
        if(request('imagen')){
            //obtenre las rutas de la imagen
            $ruta_imagen = $request['imagen']->store('uploads-recetas', 'public');

            //Resize la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,550);
            
            $img->save();

            $receta->imagen = $ruta_imagen;

        }

        $receta->save();
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        
        //revisa el Policy
        $this->authorize('delete', $receta);
    
        $receta->delete();
        return redirect()->action('RecetaController@index');
    }
}
