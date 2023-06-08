<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('etablissement_id');
            $table->bigInteger('qualite_soins')->nullable();
            $table->bigInteger('temps_attente')->nullable();
            $table->bigInteger('disponibilite_medicaments')->nullable();
            $table->bigInteger('examens')->nullable();
            $table->bigInteger('comprehension_soins_administres')->nullable();
            $table->bigInteger('resolution_probleme')->nullable();
            $table->bigInteger('facture')->nullable();
            $table->foreign('etablissement_id')
                ->references('id')
                ->on('etablissements')
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
        Schema::dropIfExists('notations');
    }
}
