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
            // Colonne pour stocker le prix du boost
            $table->decimal('boost_price', 10, 2)->nullable()->comment('Prix du boost en FCFA');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            $table->dropColumn('boost_price');
        });
    }
};
