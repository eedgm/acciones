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
        Schema::table('actions', function (Blueprint $table) {
            $table
                ->foreign('statu_id')
                ->references('id')
                ->on('status')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('prioridad_id')
                ->references('id')
                ->on('prioridads')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->dropForeign(['statu_id']);
            $table->dropForeign(['prioridad_id']);
        });
    }
};
