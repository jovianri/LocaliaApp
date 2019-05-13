<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalesPedidos extends Model
{
    protected $fillable = ["idPedido","idLocal","cantidad"];
}
