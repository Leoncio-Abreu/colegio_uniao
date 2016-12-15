<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleriasTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('galerias', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    Schema::create('galeriashole', function(Blueprint $table)
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
		CREATE TRIGGER `tr_galerias_posicao` BEFORE INSERT ON `galeriashole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `galerias`;
			IF (pos IS NULL) THEN
				INSERT INTO `galerias` (`ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
			ELSE
				INSERT INTO `galerias` (`ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.ativo, pos + 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
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
    Schema::drop('galerias');
    Schema::drop('galeriashole');
    DB::unprepared('DROP TRIGGER `tr_galerias_posicao`');
  }
}
