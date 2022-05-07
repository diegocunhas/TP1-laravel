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
        Schema::create('restaurante_tipo_restaurante', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //----------Chaves Estrangeiras-----------//
            $table->bigInteger('restaurante_id')->unsigned();
            $table->foreign('restaurante_id')->references('id')->on('restaurantes');
            $table->bigInteger('tipo_restaurante_id')->unsigned();
            $table->foreign('tipo_restaurante_id')->references('id')->on('tipo_restaurantes');
            //----utilizar restrição de unique composta para evitar a redundancia de informação-----//
            $table->unique(['restaurante_id','tipo_restaurante_id'],'unica');
            //todo parametro unique é tratado como chave secundaria,
            //porém uma chave secundaria não precisa ser unique
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
