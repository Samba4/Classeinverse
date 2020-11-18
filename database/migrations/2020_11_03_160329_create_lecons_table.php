<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matiere_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('titre')->nullable();
            $table->string('description')->nullable();
            $table->integer('clicks')->unsigned()->default(0);
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('lecons');
    }
}
