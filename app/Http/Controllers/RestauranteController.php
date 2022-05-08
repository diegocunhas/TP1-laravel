<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function index()
    {
        return View('restaurante.index')->with('dados',Restaurante::all());//
    }

    public function create()
    {
        return View('restaurante.create');
    }

    public function store(Request $request)
    {
        Restaurante::create($request->all());
        return View('restaurante.index')->with('dados',Restaurante::all());
    }

    public function show(Restaurante $restaurante)
    {
        return View('restaurante.show')->with('dados',$restaurante);
    }

    public function edit(Restaurante $restaurante)
    {
        return View('restaurante.edit')->with('dados',$restaurante);
    }

    public function update(Request $request, Restaurante $restaurante)
    {
        $restaurante->update($request->all());
        return View('restaurante.index')->with('dados',Restaurante::all());
    }

    public function destroy(Restaurante $restaurante)
    {
        $restaurante->delete();
        return View('restaurante.index')->with('dados',Restaurante::all());
    }
}
