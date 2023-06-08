<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localisations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('boite_postale');
            $table->string('pays');
            $table->string('ville');
            $table->string('rue');
            $table->longText('description');
            $table->float('longitude');
            $table->float('latitude');
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
        Schema::dropIfExists('localisations');
    }
}
