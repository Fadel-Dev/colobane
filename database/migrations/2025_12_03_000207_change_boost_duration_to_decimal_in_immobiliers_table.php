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
        Schema::table('immobiliers', function (Blueprint $table) {
            // Changer boost_duration de integer à decimal pour supporter les durées en heures
            $table->decimal('boost_duration', 5, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            $table->integer('boost_duration')->nullable()->change();
        });
    }
};
