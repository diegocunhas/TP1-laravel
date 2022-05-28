<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\TipoRestaurante;
use App\Models\Prato;

class RestauranteController extends Controller
{
    // public function __construct(Request $request){
    //     $this->middleware('auth',['except'=>['index']]);
    // }

    public function index()
    {
        return View('restaurante.index')->with('dados',Restaurante::all());
    }

    public function create()
    {
        $tipoRest = TipoRestaurante::all();
        return View('restaurante.create')->with('tipoR',$tipoRest);
    }

    public function store(Request $request)
    {
        $r = Restaurante::create($request->all());
        // Associando/vinculando restaurante criado ao tipoRestaurante
        $tipoid = $request->input('tipo_restaurante_id');
        $r->belongsToMany(TipoRestaurante::class)->attach($tipoid);
        //na operação acima a aplicação está gravando a informação na tabela resolução
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

    // public function getTipo($restaurante_id)
    // {
    //     Restaurante::find($restaurante_id)->tiposrestaurante;
    //     return View('restaurante.index')->with('dados',Restaurante::all());
    // }

    // public function getPrato($restaurante_id)
    // {
    //     return Restaurante::query()->where('id','=',$restaurante_id)->first()->hasMany(Prato::class)->get('nome');
    //     return View('restaurante.index')->with('dados',Restaurante::all());
    // }

}
