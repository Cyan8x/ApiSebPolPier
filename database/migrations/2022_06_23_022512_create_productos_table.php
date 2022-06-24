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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_marc');
            $table->unsignedBigInteger('id_cate');
            $table->unsignedBigInteger('id_prov');
            $table->string('cod_origen')->unique();
            // CAMPO IMAGEN ->
            $table->integer('imagenes')->unsigned()->nullable(); //No sé para que sirve, pero lo creo por si acaso
            $table->string('url')->nullable();  //No sé para que sirve, pero lo creo por si acaso
            // <- CAMPO IMAGEN
            $table->string('nombre');
            $table->integer('stock');
            $table->float('precio'); //Precio en dolares
            $table->timestamps();
            $table->foreign('id_marc')->references('id')->on('marcas');
            $table->foreign('id_cate')->references('id')->on('categorias');
            $table->foreign('id_prov')->references('id')->on('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
