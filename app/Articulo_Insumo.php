<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo_Insumo extends Model
{
    protected $table = 'articulos_insumos';

    protected $fillable = ['articulo_id', 'insumo_id', 'cantidad'];

    public $timestamps = false;
}
