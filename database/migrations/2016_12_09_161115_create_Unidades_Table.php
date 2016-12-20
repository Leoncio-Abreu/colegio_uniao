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
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    Schema::create('unidadeshole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->integer('ativo');
      $table->integer('posicao');
      $table->increments('id')->unsigned();
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_unidades_posicao` BEFORE INSERT ON `unidadeshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `unidades`;
			IF (pos IS NULL) THEN
				INSERT INTO `unidades` (`ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
			ELSE
				UPDATE `unidades` set posicao = posicao + 1;
				INSERT INTO `unidades` (`ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
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
    Schema::drop('unidades');
    Schema::drop('unidadeshole');
    DB::unprepared('DROP TRIGGER `tr_unidades_posicao`');
  }
}
