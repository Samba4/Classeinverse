<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeconUserTable extends Migration
{
    public function up()
    {
        Schema::create('lecon_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('rating');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('lecon_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lecon_id')->references('id')->on('lecons')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('lecon_user');
    }
}
