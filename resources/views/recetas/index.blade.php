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
                <tr>
                    <td>Pizza</td>
                    <td>Pizza</td>
                    <td>---</td>

                </tr>
            </tbody>
        </table>
    </div>

@endsection
