<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotosLocales extends Model
{
    protected $table = 'locales_fotos';
    protected $fillable = ["idLocal","nombreImg"];
}
