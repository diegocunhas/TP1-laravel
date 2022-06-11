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

    public function show(TipoRestaurante $tiporestaurante)
    {
        return View('tiporestaurante.show')->with('dados',$tiporestaurante);
    }

    public function edit(TipoRestaurante $tiporestaurante)
    {
        return View('tiporestaurante.edit')->with('dados',$tiporestaurante);
    }

    public function update(Request $request, TipoRestaurante $tiporestaurante)
    {
        $tiporestaurante->update($request->all());
        return View('tiporestaurante.index')->with('dados',TipoRestaurante::all());
    }

    public function destroy(TipoRestaurante $tiporestaurante)
    {
        $tiporestaurante->delete();
        return View('tiporestaurante.index')->with('dados',TipoRestaurante::all());
    }
}
