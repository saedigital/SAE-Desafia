<?php

namespace App\Http\Controllers;

use App\Espetaculo;
use App\Poltronas;
use App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EspetaculoController extends Controller
{
    public function index(Request $request)
    {
        $espetaculos = Espetaculo::orderBy('data', 'desc')->get();
        return view('espetaculo.index', compact("espetaculos"));
    }

    public function create()
    {
        return view('espetaculo.create');
    }

    public function store(Request $request)
    {
        Espetaculo::create($request->all());
        return Redirect::to('espetaculos');
    }

    public function edit(Espetaculo $espetaculo)
    {
        $poltronas = Poltronas::all();
        $reservadas = Reserva::where('espetaculo', $espetaculo->id)->pluck('poltrona')->toArray();

        return view('espetaculo.update',
            array('espetaculo'=>$espetaculo, 'poltronas'=>$poltronas, 'reservadas'=>$reservadas));
    }

    public function update(Espetaculo $espetaculo, Request $request)
    {
        $espetaculo->fill($request->all());
        $espetaculo->save();
        return Redirect::to('espetaculos');
    }

    public function destroy(Espetaculo $espetaculo)
    {
        $espetaculo->delete();
        return Redirect::to('espetaculos');
    }

}
