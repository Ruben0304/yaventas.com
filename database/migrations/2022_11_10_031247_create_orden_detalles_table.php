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
        Schema::create('orden_detalles', function (Blueprint $table) {
            $table->id();
            $table->decimal('cantidad');
            $table->decimal('precio')->default(0);
            $table->string('moneda')->default('regalo');
            $table->decimal('total')->default('0');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_orden');
            
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_orden')->references('id')->on('ordenes');
           
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_detalles');
    }
};
