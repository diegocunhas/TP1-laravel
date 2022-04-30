<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Restaurante_tipoRestaurante', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //----------Chaves Estrangeiras-----------//
            $table->bigInteger('restaurante_id')->unsigned();
            $table->foreign('restaurante_id')->references('id')->on('restaurantes');
            $table->bigInteger('tipoRestaurante_id')->unsigned();
            $table->foreign('tipoRestaurante_id')->references('id')->on('tipo_restaurantes');
            //----utilizar restrição de unique composta para evitar a redundancia de informação-----//
            $table->unique(['restaurante_id','tipoRestaurante_id'],'unica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Restaurante_tipoRestaurante');
    }
};
