<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $fillable = ['nombre','apellidos','email','contrasenya','fechaNacimiento','admin'];
}
