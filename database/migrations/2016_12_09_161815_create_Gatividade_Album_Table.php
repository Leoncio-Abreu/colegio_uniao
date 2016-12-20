<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatividadeAlbumTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
    {
        Schema::table("gatividade_album", function ($table) {
            $table->create();
            $table->integer('galeria_id')->unsigned();
            $table->integer('atividade_id')->unsigned();
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
    Schema::drop('gatividade_album');
  }
}
