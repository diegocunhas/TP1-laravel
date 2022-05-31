<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use App\Models\Restaurante;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function index()
    {
        $resta = Restaurante::all();
        return View('prato.index')->with('dados',Prato::all())->with('rest',$resta);
    }

    public function create()
    {
        $resta = Restaurante::all();
        return View('prato.create')->with('rest',$resta);
    }

    public function store(Request $request)
    {
        Prato::create($request->all());
        return View('prato.index')->with('dados',Prato::all());
    }

    public function show(Prato $prato)
    {
        return View('prato.show')->with('dados',$prato);
    }

    public function edit(Prato $prato)
    {
        $resta = Restaurante::all();        
        return View('prato.edit')->with('dados',$prato)->with('rest',$resta);
    }

    public function update(Request $request, Prato $prato)
    {
        $prato->update($request->all());
        $resta = Restaurante::all();
        return View('prato.index')->with('dados',Prato::all())->with('rest',$resta);
    }

    public function destroy(Prato $prato)
    {
        $prato->delete();
        return View('prato.index')->with('dados',Prato::all());
    }
}
