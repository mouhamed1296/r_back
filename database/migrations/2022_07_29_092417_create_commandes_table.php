<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->integer('nombreColis');
            $table->float('poids');
            $table->date('dateEnregistrement');
            $table->string('lieuDepart');
            $table->string('lieuDestination');
            $table->string('Description');
            $table->string('residenceAdresse');
            $table->unsignedBigInteger('envoyeur_id');
            $table->foreign('envoyeur_id')->references('id')->on('users');
            $table->unsignedBigInteger('livreur_id');
            $table->foreign('livreur_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};
