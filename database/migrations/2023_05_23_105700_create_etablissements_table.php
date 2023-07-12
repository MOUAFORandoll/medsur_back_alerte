<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('name');
            $table->string('name2')->nullable();
            $table->string('code');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->longText('siteweb');
            $table->bigInteger('user_id');
            $table->boolean('status')->default(false);


            $table->longText('description');
            $table->unsignedBigInteger('localisation_id')->nullable();
            $table->foreign('localisation_id')
                ->references('id')
                ->on('localisations')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('specialite_etablissement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialite_id');
            $table->unsignedBigInteger('etablissement_id');
            // Ajoutez d'autres colonnes si nécessaire

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('specialite_id')->references('id')->on('specialites')->onDelete('cascade');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');
        });

        // Schema::create('specialite_etablissement', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('specialite_id')->nullable();
        //     $table->unsignedBigInteger('etablissement_id')->nullable();
        //     $table->foreign('specialite_id')
        //         ->references('id')
        //         ->on('specialites')
        //         ->onDelete('RESTRICT')
        //         ->onUpdate('RESTRICT');
        //     $table->foreign('etablissement_id')
        //         ->references('id')
        //         ->on('etablissements')
        //         ->onDelete('RESTRICT')
        //         ->onUpdate('RESTRICT');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialite_etablissement');

        Schema::dropIfExists('etablissements');
    }
}
