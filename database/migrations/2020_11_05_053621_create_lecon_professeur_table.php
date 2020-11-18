<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeconProfesseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecon_professeur', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('professeur_id');
            $table->unsignedInteger('lecon_id');
            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->foreign('lecon_id')->references('id')->on('lecons')->onDelete('cascade');
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
        Schema::dropIfExists('lecon_professeur');
    }
}
