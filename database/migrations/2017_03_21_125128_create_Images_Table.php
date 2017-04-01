<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
	    $table->integer('album_id')->references('id')->on('albums')->onDelete('CASCADE')->onUpdate('CASCADE');
      	    $table->integer('ativo');
            $table->integer('posicao')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('filename');
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
        Schema::drop('images');
    }
}
