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
        //
        Schema::table('users', function(Blueprint $table) {
            $table->unsignedBigInteger('idPerfil')->nullable();
            $table->string('nombres', 100)->nullable();
            $table->string('apellidos', 100)->nullable();

            $table->foreign('idPerfil')->references('id')->on('perfiles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['idPerfil']);
            $table->dropColumn('idPerfil');
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
        });
    }
};
