<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementationAutorisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reglementation_autorisations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
           
            $table->boolean('authorisation_service');
            $table->unsignedBigInteger('etablissement_id')->nullable();
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
        Schema::dropIfExists('reglementation_autorisations');
    }
}
