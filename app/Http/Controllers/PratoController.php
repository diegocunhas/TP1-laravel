<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function index()
    {
        return View('prato.index')->with('dados',Prato::all());
    }

    public function create()
    {
        return View('prato.create');
    }

    public function store(Request $request)
    {
        Prato::create($request->all());
        return redirect('/prato');
    }

    public function show(Prato $prato)
    {
        return View('prato.show')->with('dados',$prato);
    }

    public function edit(Prato $prato)
    {
        return View('prato.edit')->with('dados',$prato);
    }

    public function update(Request $request, Prato $prato)
    {
        $prato->update($request->all());
        return redirect('/prato');
    }

    public function destroy(Prato $prato)
    {
        $prato->delete();
    }
}
