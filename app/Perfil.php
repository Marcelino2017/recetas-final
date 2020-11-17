<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    /**Relacion de 1:1 de Perfil y Ususario */
    public function usuario()
    {
        //el parametro user_id indica en que columna esta relacionada
        return $this->belongsTo(User::class, 'user_id');
    }
}
