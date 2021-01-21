@extends('layouts.app')

@section('botones')
  @include('ui.navegacion')
@endsection

@section('content')
<h2 class="text-center mb-5">Administra tu recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3" >
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="align-self-center" scope="col">Titulo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                <tr>
                    <td class="user-select-auto">{{ $receta->titulo }}</td>
                    <td>{{ $receta->categoria->nombre }}</td>
                    <td class="user-select-auto">
                        <div class="d-flex bd-highlight">
                            <eliminar-receta receta-id = {{ $receta->id }}>                          
                            </eliminar-receta>
                            <a href="{{ route('recetas.edit', ['receta'=>$receta->id]) }}" class="btn btn-dark ml-2 d-block mb-2">
                                <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                            </a>
                            <a href="{{ route('recetas.show', ['receta'=>$receta->id]) }}" class="btn btn-success ml-2 d-block mb-2">
                                <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>

        <h2 class="text-center my-5"> Recetas que te gustan</h2>

        <div class="col-md-10 mx-auto bg-white p-3">
            @if(count($usuario->meGusta) > 0)
                <ul class="list-group">
                    @foreach ($usuario->meGusta as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{ $item->titulo }}</p>
                            <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{ route('recetas.show', ['receta'=>$receta->id]) }}">Ver</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center"> Aún no tienes recetas Guardadas.
                    <small>Dale me gusta a las recetas y apareceran aqui </small>
                </p>
            @endif
        </div>
    </div>

@endsection
