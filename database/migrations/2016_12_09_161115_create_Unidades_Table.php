<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('unidades', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('ano_id')->references('id')->on('anos')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao')->nullable();
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('filename')->nullable();
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
    Schema::drop('unidades');
  }
}
