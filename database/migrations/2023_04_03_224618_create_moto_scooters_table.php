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
        Schema::create('moto_scooters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unSignedBigInteger('user_id');
    
            $table->string('nom');
            $table->string('marque');
            $table->string('description');
            $table->bigInteger('prix');
            $table->string('carburant');
            $table->bigInteger('annee');
            $table->string('image');
            $table->string('region');
            $table->string('ville');
            $table->string('etat');
            $table->string('categorie');            
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moto_scooters');
    }
};
