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
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');

            $table->string('nom');
            $table->date('date_fin_booster')->nullable();
            $table->string('booster')->default(false); // Colonne pour marquer si l'article est boosté ou non
            $table->boolean('vendu')->default(false); // Colonne pour marquer si l'article est boosté ou non
            $table->string('marque');
            $table->string('model');
            $table->text('description');
            $table->string('prix');
            $table->string('boiteVitesse');
            $table->string('kilometrage');
            $table->string('carburant');
            $table->string('place');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('region');
            $table->integer('annee');
            $table->string('etat');
            $table->string('affaire');
            $table->string('categorie');
            $table->string('onceBooster')->default(false);
            $table->string('status')->default('null'); // Ajouter un statut pour la vérification
            $table->integer('duration')->nullable(); // Durée en minutes
            $table->timestamp('boosted_at')->nullable(); // Date de début du boost

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
