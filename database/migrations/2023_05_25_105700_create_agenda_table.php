<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable();
            $table->string('libelle_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('agenda_etablissements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id')->nullable();
            $table->unsignedBigInteger('etablissement_id')->nullable();
            $table->string('debut')->nullable();

            $table->string('fin')->nullable();

            $table->foreign('agenda_id')
                ->references('id')
                ->on('agendas')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
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
        Schema::dropIfExists(['agendas', 'agenda_etablissement']);
    }
}
