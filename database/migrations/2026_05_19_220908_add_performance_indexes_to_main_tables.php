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
            $table->index('status');
            $table->index('type');
            $table->index('region');
            $table->index('vendu');
            $table->index('booster');
            $table->index('prix');
            $table->index('created_at');
        });

        Schema::table('voitures', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('status');
            $table->index('region');
            $table->index('vendu');
            $table->index('booster');
            $table->index('prix');
            $table->index('marque');
            $table->index('created_at');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->index('type');
            $table->index('immobilier_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('immobiliers', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['type']);
            $table->dropIndex(['region']);
            $table->dropIndex(['vendu']);
            $table->dropIndex(['booster']);
            $table->dropIndex(['prix']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('voitures', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['region']);
            $table->dropIndex(['vendu']);
            $table->dropIndex(['booster']);
            $table->dropIndex(['prix']);
            $table->dropIndex(['marque']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['immobilier_id']);
        });
    }
};
