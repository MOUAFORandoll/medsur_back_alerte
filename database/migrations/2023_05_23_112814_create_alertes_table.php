<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->unsignedBigInteger('etablissement_id')->nullable();
            $table->string('name_user');
            $table->string('birthday_user');
            $table->string('poids_user');
            $table->string('taille_user');
            $table->string('email_user');
            $table->string('niveau_urgence');
            $table->longText('description')->nullable();
            $table->longText('ville');
            $table->longText('longitude');
            $table->longText('latitude');
            $table->longText('sexe_user');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('specialite_alerte', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specialite_id')->nullable();
            $table->unsignedBigInteger('alerte_id')->nullable();
            $table->foreign('specialite_id')
                ->references('id')
                ->on('specialites')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
            $table->foreign('alerte_id')
                ->references('id')
                ->on('alertes')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialite_alerte');
        Schema::dropIfExists('alertes');
    }
}
