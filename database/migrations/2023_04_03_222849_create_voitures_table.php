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
            $table->string('marque');
            $table->string('model');
            $table->string('description');
            $table->bigInteger('prix');
            $table->string('boiteVitesse');
            $table->string('carburant');
            $table->string('image');
            $table->string('region');
            $table->integer('annee');
            $table->string('etat');
            $table->string('categorie');

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
