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
        Schema::create('habillements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unSignedBigInteger('user_id');


            $table->string('nom');
            $table->string('description');
            $table->bigInteger('prix');
            $table->string('type');
            $table->string('sexe');
            $table->string('livraison');
            
            $table->string('image');
            $table->string('region');

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habillements');
    }
};