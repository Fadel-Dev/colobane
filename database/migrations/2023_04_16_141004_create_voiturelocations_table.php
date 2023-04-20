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
        Schema::create('voiturelocations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unSignedBigInteger('user_id');

            $table->string('nom');
            $table->string('marque');
            $table->string('description');
            $table->bigInteger('prix');
            $table->string('carburant');
            $table->string('place');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('region');
            $table->string('affaire');
            $table->string('boiteVitesse');
            $table->string('categorie');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voiturelocations');
    }
};
