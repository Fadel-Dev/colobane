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
        Schema::create('immobiliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unSignedBigInteger('user_id');
            $table->date('date_fin_booster')->nullable();
            $table->boolean('booster')->nullable()->default(false); // Colonne pour marquer si l'article est boosté ou non
            $table->boolean('vendu')->default(false); // Colonne pour marquer si l'article est boosté ou non

            $table->string('type');
            $table->string('nom');
            $table->text('description');
            $table->string('prix');
            $table->string('npiece');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('region');
            $table->string('categorie');
            $table->string('affaire');
            $table->string('surface');
            // onceBoost boolean
            $table->boolean('onceBooster')->default(false);
            $table->string('status')->default('null'); // Ajouter un statut pour la vérification
            $table->integer('duration')->nullable(); // Durée en minutes



            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immobiliers');
    }
};
