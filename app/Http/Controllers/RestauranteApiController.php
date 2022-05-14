<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Model\Restaurante;
use App\Http\Resources\Restaurante as RestauranteResource;


class RestauranteApiController extends Controller
{
    public function apiAll(Restaurante $restaurante){
        $todosRest = Restaurante::all();
        return RestauranteResource::collection($todosRest);
    }

    public function apiFind(Restaurante $restaurante){
        return new RestauranteResource($restaurante);
    }

    public function apiStore(Restaurante $restaurante){
        try{
            $r = Restaurante::create($request->all());
            return response()->json($r,201);
        }
        catch(\Exception $ex){
            return response()->json(null,400);
        }
    }

    public function apiUpdate(Restaurante $restaurante){
        return new RestauranteResource($restaurante);
    }

    public function apiDelete(Restaurante $restaurante){
        return new RestauranteResource($restaurante);
    }

}
