<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('libelle')->nullable();
            $table->string('libelle_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('categorie_etablissement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('etablissement_id');
            // Ajoutez d'autres colonnes si nécessaire

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
