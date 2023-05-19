<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero')->nullable();
            $table->string('accion');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('statu_id');
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('prioridad_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
