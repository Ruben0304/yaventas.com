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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_code_sent_at')->nullable()->after('email');
            $table->unsignedTinyInteger('code_attempts')->default(0)->after('last_code_sent_at');
            $table->string('verification_code', 6)->nullable()->after('code_attempts');
            $table->boolean('verificado')->default(false)->after('verification_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_code_sent_at');
            $table->dropColumn('code_attempts');
            $table->dropColumn('verification_code');
            $table->dropColumn('verificado');
        });
    }
};
