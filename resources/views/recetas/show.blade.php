@extends('layouts.app')

@section('content')
 <article class="contenido-receta container">
     <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>
     <div class="receta-meta">
         <div class="imagen-receta">
             <img src="/storage/{{ $receta->imagen }}" class="w-100">
         </div>
         <p>
             <span class="font-weight-bold text-primary">Escrito en:</span>
             {{ $receta->categoria->nombre }}
         </p>
         <p>
             <span class="font-weight-bold text-primary">Autor:</span>
             {{-- mostras nombre del autor --}}
             {{ $receta->autor->name}}
         </p>
         <p>
             <span class="font-weight-bold text-primary">Fecha:</span>
            @php 
               $fecha = $receta->created_at
            @endphp
             <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
         </p> 

         
         <div class="ingredientes">
             <h2 class="my-3 text-primary" >Ingredientes</h2>
             {{-- Imprime codigo html --}}
             {!! $receta->ingredientes !!}
         </div>
         <div class="preparacion">
            <h2 class="my-3 text-primary" >Preparación</h2>
            {{-- Imprime codigo html --}}
            {!! $receta->preparacion !!}
        </div>
     </div>
 </article>
@endsection