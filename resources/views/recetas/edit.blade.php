@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />

@endsection
@section('botones')
 <a class="btn btn-primary mr-2 text-white" href="{{ route('recetas.index')}}">Volver</a>
@endsection

@section('content')
<h2 class="text-center mb-5">Editar Recetas: {{ $receta->titulo }}</h2>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-8">
            {{-- para subir file o imagenes tenemos que poner en el form  enctype="multipart/form-data"--}}
            <form method="POST" action=" {{ route('recetas.update',['receta' => $receta->id]) }} " enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input type="text" 
                            name="titulo" 
                            class="form-control  @error('titulo')
                                is-invalid
                            @enderror"
                            id="titulo" 
                            placeholder="Titulo Recetas"
                            value="{{ $receta->titulo }}" >
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria"></label>
                    <select name="categoria" 
                            class="form-control
                            @error('categoria')
                                is-invalid
                            @enderror" 
                            id="categoria" >
                            <option value="">Seleccione...</option>
                        @foreach ($categorias as $id => $categoria)
                            <option 
                                value="{{ $categoria->id }}"
                                {{ $receta->categoria_id == $categoria->id ? 'selected':'' }}
                                > {{ $categoria->nombre }} </option>
                        @endforeach 
                    </select>
                </div>
                @error('categoria')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="form-group mt-3">
                    <label for="preparacion">Preparación</label>
                    <input id="preparacion" type="hidden" name="preparacion" value="{{ $receta->preparacion }}"  >
                    <trix-editor 
                        class="@error('preparacion')
                                is-invalid 
                            @enderror"
                        input="preparacion"></trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes"  value="{{ $receta->ingredientes }}"  >
                    <trix-editor 
                        input="ingredientes"
                        class="@error('ingredientes') 
                                    is-invalid
                                @enderror"></trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" 
                        type="file"
                        class="form-control
                        @error('imagen') 
                         is-invalid
                        @enderror" 
                        name="imagen">

                        <div class="mt-4">
                            <p>Imagen Actual:</p>
                            <img src="/storage/{{ $receta->imagen }}" style="width:300px" alt="">
                        </div>
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <div class="form-group mt-3">
                    
                    <input type="submit" class="btn btn-primary" value="Agregar Receta" />
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection