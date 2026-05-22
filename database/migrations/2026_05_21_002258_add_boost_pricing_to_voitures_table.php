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
        Schema::table('voitures', function (Blueprint $table) {
            // Ajouter les colonnes manquantes pour le système de boost PRO
            $table->decimal('boost_price', 10, 2)->nullable()->comment('Prix du boost en FCFA');
            $table->decimal('boost_duration', 5, 2)->nullable()->comment('Durée du boost en heures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voitures', function (Blueprint $table) {
            $table->dropColumn(['boost_price', 'boost_duration']);
        });
    }
};
