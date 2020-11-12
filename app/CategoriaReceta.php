<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaReceta extends Model
{
    public function receta()
    {
        return $this->hasMany(Receta::class);
    }
}
