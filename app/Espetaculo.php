<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Espetaculo extends Model
{
    protected $fillable = ['nome', 'data', 'autor'];

    public function reservas()
    {
        return $this->hasMany('App\Reserva', 'espetaculo');
    }
}
