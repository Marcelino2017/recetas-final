@extends('layouts.app')

@section('botones')
 <a class="btn btn-primary mr-2 text-white" href="{{ route('recetas.index')}}">Volver</a>
@endsection

@section('content')
<h2 class="text-center mb-5">Crear nuevas recetas</h2>

    <div class="row justify-content-center mt-5" >
        <div class="col-md-8">
            <form method="POST" >
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input type="text" 
                            name="titulo" 
                            class="form-control" 
                            id="titulo" 
                            placeholder="Titulo Recetas"/>
                </div>
                <div class="form-group">
                    
                    <input type="submit" class="btn btn-primary" value="Agregar Receta" />
                </div>
            </form>
        </div>
    </div>

@endsection
