<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmaGaleriaTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
    {
        Schema::table("turma_galeria", function ($table) {
            $table->create();
            $table->integer('turma_id')->unsigned();
            $table->integer('galeria_id')->unsigned();
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
    Schema::drop('turma_galeria');
  }
}
