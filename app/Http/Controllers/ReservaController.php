<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReservaController extends Controller
{
    public function create($poltrona, $espetaculo)
    {
        return view('reserva.create', array('poltrona'=>$poltrona, 'espetaculo'=>$espetaculo));
    }

    public function store(Request $request)
    {
        Reserva::create($request->all());
        return Redirect::to("espetaculos/{$request->get('espetaculo')}/edit");
    }

    public function remove($poltrona, $espetaculo)
    {
        $reserva = Reserva::where('espetaculo', $espetaculo)->where('poltrona', $poltrona) ;
        $reserva->delete();
        return Redirect::to("espetaculos/{$espetaculo}/edit");
    }
}
