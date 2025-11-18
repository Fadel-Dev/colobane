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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'favori', 'message', 'boost', etc.
            $table->string('title');
            $table->text('message');
            $table->foreignId('immobilier_id')->nullable()->constrained('immobiliers')->onDelete('cascade');
            $table->boolean('read')->default(false);
            $table->timestamps();
            
            // Index pour les requêtes fréquentes
            $table->index(['user_id', 'read']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
