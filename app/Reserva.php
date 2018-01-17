<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['status', 'cpf', 'preco', 'espetaculo', 'poltrona'];

    public function espetaculo()
    {
        return $this->belongsTo('App\Espetaculo', 'espetaculo');
    }

    public function poltrona()
    {
        return $this->belongsTo('App\Poltrona', 'poltrona');
    }
}
