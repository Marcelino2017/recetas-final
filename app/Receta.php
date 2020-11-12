<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //Obtine la categoria  de la recetas via FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
