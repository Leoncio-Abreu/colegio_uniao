<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurmasTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('turmas', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('unidade_id')->references('id')->on('unidades')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao')->nullable();
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('cover_image')->nullable();
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
    Schema::drop('turmas');
  }
}
