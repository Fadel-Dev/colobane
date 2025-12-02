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
            // Ajouter le champ pour la durée du boost demandée (en jours)
            $table->integer('boost_duration')->default(30)->nullable()->comment('Durée du boost en jours (7, 14, 30, etc)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            $table->dropColumn('boost_duration');
        });
    }
};
