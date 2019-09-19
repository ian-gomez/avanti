<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
        protected $table = 'articulos';

        protected $fillable = ['tipo_id', 'nombre', 'precio', 'costo'];

        public $timestamps = false;

        public function insumos()
        {
                return $this->belongsToMany('App\Insumo', 'articulos_insumos');
        }
        
        public function tipo()
        {
                return $this->hasOne('App\Tipo', 'id', 'tipo_id');
        }
}
