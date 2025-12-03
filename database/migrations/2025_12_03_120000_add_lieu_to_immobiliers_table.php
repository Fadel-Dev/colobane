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
            // Ajouter la colonne 'lieu' après 'region'
            if (!Schema::hasColumn('immobiliers', 'lieu')) {
                $table->string('lieu')->nullable()->after('region');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            if (Schema::hasColumn('immobiliers', 'lieu')) {
                $table->dropColumn('lieu');
            }
        });
    }
};

