<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRestaurante extends Model
{
    use HasFactory;

    protected $fillable = ['id','descricao'];

    public $timestamps = false;

    public function restaurante()
    {
        return $this->belongsToMany(Restaurante::class,'restaurante_tipo_restaurante');
    }
}
