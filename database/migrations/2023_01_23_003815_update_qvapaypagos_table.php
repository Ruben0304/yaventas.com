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
        Schema::table('qvapaypagos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_orden');
            $table->foreign('id_orden')->references('id')->on('ordenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qvapaypagos', function (Blueprint $table) {
            //
        });
    }
};
