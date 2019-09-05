<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta_Cabecera extends Model
{
    protected $table = 'ventas_cabecera';

    public function user()
    {
            return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function cliente()
    {
            return $this->hasOne('App\Cliente', 'id', 'cliente_id');
    }
}
