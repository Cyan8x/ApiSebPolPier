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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->integer('dni');
            $table->integer('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->float('montoFinal');
            $table->dateTime('fechaCompra', 0);
            $table->string('estado'); //Pagado - Entregado - Cancelado
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
