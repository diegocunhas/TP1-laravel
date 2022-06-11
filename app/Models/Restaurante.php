<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    public function pratos(){
        return $this->hasMany(Prato::class);
    }

    public function tipoRestaurantes(){
        return $this->belongsToMany(TipoRestaurante::class);
    }

    use HasFactory;

    protected $fillable = ['id','razaoSocial','cnpj','telefone','endereco','email'];
    
    public $timestamps = false;

}
