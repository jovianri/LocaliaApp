<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locales extends Model
{
    protected $fillable = ["nombre","latitud","longitud","direccion","idCategoria","idCiudad","precio"];
}
