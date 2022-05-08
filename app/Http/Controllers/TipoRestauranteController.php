<?php

namespace App\Http\Controllers;

use App\Models\TipoRestaurante;
use Illuminate\Http\Request;

class TipoRestauranteController extends Controller
{

    public function index()
    {
        return View('tiporestaurante.index')->with('dados',TipoRestaurante::all());
    }

    public function create()
    {
        return View('tiporestaurante.create');
    }

    public function store(Request $request)
    {
        TipoRestaurante::create($request->all());
        return View('tiporestaurante.index')->with('dados',TipoRestaurante::all());
    }

    public function show(TipoRestaurante $tipoRestaurante)
    {
        return View('tiporestaurante.show')->with('dados',$tipoRestaurante);
    }

    public function edit(TipoRestaurante $tipoRestaurante)
    {
        return View('tiporestaurante.edit')->with('dados',$tipoRestaurante);
    }

    public function update(Request $request, TipoRestaurante $tipoRestaurante)
    {
        $tipoRestaurante->update($request->all());
        return View('tiporestaurante.index')->with('dados',TipoRestaurante::all());
    }

    public function destroy(TipoRestaurante $tipoRestaurante)
    {
        $tipoRestaurante->delete();
        return View('tiporestaurante.index')->with('dados',TipoRestaurante::all());
    }
}
