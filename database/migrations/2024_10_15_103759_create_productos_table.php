<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTipoProducto');
            $table->string('codigo', 10)->nullable()->index();
            $table->string('nombre', 100)->index();
            $table->decimal('precio', 10, 2);
            $table->boolean('iva')->default(true);
            $table->unsignedBigInteger('idUsuarioCreacion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idUsuarioCreacion')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idTipoProducto')->references('id')->on('parametros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
