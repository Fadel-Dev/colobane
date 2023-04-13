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
        Schema::create('ordinateurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unSignedBigInteger('user_id');


            $table->string('marque');
            $table->string('nom');
            $table->string('description');
            $table->bigInteger('prix');
            $table->bigInteger('stockage');

            $table->string('image');
            $table->string('region');
            $table->string('categorie');

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordinateurs');
    }
};
