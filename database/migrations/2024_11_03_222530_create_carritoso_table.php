<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carritoso', function (Blueprint $table) {
            $table->id();
            $table->string('Precio');
            $table->integer('Mosca')->nullable();
            $table->foreignId('oferta_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carritoso');
    }
};
