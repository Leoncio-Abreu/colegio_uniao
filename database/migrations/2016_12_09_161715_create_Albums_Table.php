<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{	
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('albums', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    Schema::create('albumshole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->increments('id')->unsigned();
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_albums_posicao` BEFORE INSERT ON `albumshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `albums`;
			IF (pos IS NULL) THEN
				INSERT INTO `albums` (`ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
			ELSE
				UPDATE `albums` set posicao = posicao + 1;
				INSERT INTO `albums` (`ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
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
    Schema::drop('albums');
    Schema::drop('albumshole');
    DB::unprepared('DROP TRIGGER `tr_albums_posicao`');
  }
}
