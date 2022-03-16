<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse')->nullable();
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('chambre')->nullable();
            $table->string('sallebain')->nullable();
            $table->string('service')->nullable();
            $table->string('date')->nullable();
            $table->string('heure1')->nullable();
            $table->string('heure2')->nullable();
            $table->string('frequence')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('devis');
    }
}
