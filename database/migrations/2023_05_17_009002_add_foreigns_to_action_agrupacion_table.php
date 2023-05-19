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
        Schema::table('action_agrupacion', function (Blueprint $table) {
            $table
                ->foreign('agrupacion_id')
                ->references('id')
                ->on('agrupacions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('action_id')
                ->references('id')
                ->on('actions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('action_agrupacion', function (Blueprint $table) {
            $table->dropForeign(['agrupacion_id']);
            $table->dropForeign(['action_id']);
        });
    }
};
