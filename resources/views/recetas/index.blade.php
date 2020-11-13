@extends('layouts.app')

@section('botones')
 <a class="btn btn-primary mr-2 text-white" href="{{ route('recetas.create')}}"> Crear Recetas</a>
@endsection

@section('content')
<h2 class="text-center mb-5">Administra tu recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3" >
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                <tr>
                    <td>{{ $receta->titulo }}</td>
                    <td>{{ $receta->categoria->nombre }}</td>
                    <td>
                        <form action="{{ route('recetas.destroy', ['receta' => $receta->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                        
                            <input type="submit" href="" class="btn btn-danger d-block w-100 mb-2" value="Eliminar &times;">
                        </form>
                        <a href="{{ route('recetas.edit', ['receta'=>$receta->id]) }}" class="btn btn-dark mr-1 d-block mb-2">Editar</a>
                        <a href="{{ route('recetas.show', ['receta'=>$receta->id]) }}" class="btn btn-success mr-1 d-block mb-2">Ver</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
