<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

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
            $table->string('nombre');
            $table->string('preciocup')->nullable();
            $table->string('preciousd')->nullable();
            $table->string('monedas');
            $table->integer('stock');
            $table->string('recojible')->default('no');
            $table->string('direccion')->nullable();
            $table->string('foto')->default('https://canalsalud.imq.es/hubfs/imq-blog/alimentos-saludables.jpg');
            $table->unsignedBigInteger('id_vendedor');
            // $table->foreign('id_vendedor')->references('id')->on('vendedores');
            
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
        Schema::dropIfExists('productos');
    }
};
