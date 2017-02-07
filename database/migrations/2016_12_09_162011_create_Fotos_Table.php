<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('fotos', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('album_id')->references('id')->on('albums')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name')->nullable();
      $table->string('description')->nullable();
      $table->string('cover_image');
      $table->timestamps();
    });

    Schema::create('fotoshole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->increments('id')->unsigned();
      $table->integer('album_id')->references('id')->on('albums')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name')->nullable();
      $table->string('description')->nullable();
      $table->string('cover_image');
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_fotos_posicao` BEFORE INSERT ON `fotoshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `fotos` where album_id = NEW.album_id;
			IF (pos IS NULL) THEN
				INSERT INTO `fotos` (`album_id`, `ativo`, `posicao`, cover_image, `description`, `created_at`, `updated_at` ) VALUES (NEW.album_id, NEW.ativo, 1, NEW.cover_image, NEW.description, NEW.created_at, NEW.updated_at);
			ELSE
				UPDATE `fotos` set posicao = posicao + 1 where album_id = NEW.album_id;
				INSERT INTO `fotos` (`album_id`, `ativo`, `posicao`, cover_image, `description`, `created_at`, `updated_at` ) VALUES (NEW.album_id, NEW.ativo, 1, New.cover_image, NEW.description, NEW.created_at, NEW.updated_at);
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
    Schema::drop('fotos');
    Schema::drop('fotoshole');
    DB::unprepared('DROP TRIGGER `tr_fotos_posicao`');
  }
}
