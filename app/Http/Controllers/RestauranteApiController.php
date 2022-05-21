<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Model\Restaurante;
use App\Http\Resources\Restaurante as RestauranteResource;


class RestauranteApiController extends Controller
{
    // rota = get + url: /api/restaurante
    public function apiAll(Restaurante $restaurante){
        $todosRest = Restaurante::all();
        return RestauranteResource::collection($todosRest);
    }

    // rota = get + url: /api/restaurante/2
    public function apiFind(Restaurante $restaurante){
        return new RestauranteResource($restaurante);
    }

    // rota = post + url: /api/restaurante + json com novos dados
    public function apiStore(Request $request){
        try{
            $r = Restaurante::create($request->all());
            return response()->json($r,201);
        }
        catch(\Exception $ex){
            return response()->json(null,400);
        }
    }
    
    // rota = put + url: /api/restaurante/2 + json com novos dados
    public function apiUpdate(Request $request, Restaurante $restaurante){
        try{
            $r = $restaurante->update($request->all());
            return response()->json($r,201);
        }
        catch(\Exception $ex){
            return response()->json(null,400);
        }
    }

    // rota = delete + url: /api/restaurante/2
    public function apiDelete(Restaurante $restaurante){
        try{
            $restaurante->delete();
            return response()->json(null,204);
        }
        catch(\Exception $ex){
            return response()->json(null,400);
        }
    }

}
