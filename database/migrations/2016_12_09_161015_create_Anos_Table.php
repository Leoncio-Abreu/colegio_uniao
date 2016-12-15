<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnosTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
    {
      Schema::create('anos', function(Blueprint $table)
      {
        $table->increments('id')->unsigned();
        $table->string('name');
        $table->text('description');
        $table->string('cover_image');
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
    Schema::drop('anos');
  }
}
