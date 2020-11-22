
{{-- PERMTITE TRAER EL USUARIO AUTENTICADO --}}
{{-- {{ Auth::user() }} --}}
<a class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold" href="{{ route('recetas.create')}}"> 
    <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd"></path></svg>
    Crear Recetas
</a>
<a class="btn btn-outline-success mr-2 text-uppercase font-weight-bold" href="{{ route('perfiles.edit',['perfil'=>Auth::user()->id])}}"> 
    <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
    Editar Perfil
</a>
<a class="btn btn-outline-info mr-2 text-uppercase font-weight-bold" href="{{ route('perfiles.show',['perfil'=>Auth::user()->id])}}"> 
    <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
    Ver Perfil
</a>