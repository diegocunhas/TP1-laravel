<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    use HasFactory;

    protected $fillable = ['id','tipo','nome','preco','restaurante_id'];

    public $timestamps = false;

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class,'restaurantes');
    }
}


