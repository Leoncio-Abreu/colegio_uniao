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
    Schema::create('images', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('image');
      $table->string('description');
      $table->timestamps();
    });

    Schema::create('imageshole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->increments('id')->unsigned();
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('image');
      $table->string('description');
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_images_posicao` BEFORE INSERT ON `imageshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `images`;
			IF (pos IS NULL) THEN
				INSERT INTO `images` (`ativo`, `posicao`, `image`, `description`, `created_at`, `updated_at` ) VALUES (NEW.ativo, 1, NEW.image, NEW.description, NEW.created_at, NEW.updated_at);
			ELSE
				INSERT INTO `images` (`ativo`, `posicao`, `image`, `description`, `created_at`, `updated_at` ) VALUES (NEW.ativo, pos + 1, New.image, NEW.description, NEW.created_at, NEW.updated_at);
			END IF;
		END
    ');

  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::drop('images');
    Schema::drop('imageshole');
    DB::unprepared('DROP TRIGGER `tr_images_posicao`');
  }
}
