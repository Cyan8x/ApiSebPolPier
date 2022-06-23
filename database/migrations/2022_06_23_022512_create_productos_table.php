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
            $table->string('imagen')->unique();
            //falta llenar con mas columnas y darle migrate
            $table->timestamps();
            $table->foreign('id_marc')->references('id')->on('marcas');
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
