<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriaAlbumTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
    {
        Schema::table("galeria_album", function ($table) {
            $table->create();
            $table->integer('galeria_id')->unsigned();
            $table->integer('album_id')->unsigned();
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
    Schema::drop('galeria_album');
  }
}
