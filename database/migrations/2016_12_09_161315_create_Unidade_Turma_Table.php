<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadeTurmaTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
    {
        Schema::table("unidade_turma", function ($table) {
            $table->create();
            $table->integer('unidade_id')->unsigned();
            $table->integer('turma_id')->unsigned();
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
    Schema::drop('unidade_turma');
  }
}
