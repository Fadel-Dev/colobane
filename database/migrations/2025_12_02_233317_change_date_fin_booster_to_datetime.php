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
            // Changer le type de date_fin_booster de DATE à DATETIME
            $table->dateTime('date_fin_booster')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            // Revert: changer de DATETIME à DATE
            $table->date('date_fin_booster')->nullable()->change();
        });
    }
};
