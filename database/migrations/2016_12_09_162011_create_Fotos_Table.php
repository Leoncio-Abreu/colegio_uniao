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
      $table->integer('ano_id')->references('id')->on('anos')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('unidade_id')->references('id')->on('unidades')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('turma_id')->references('id')->on('turmas')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('atividade_id')->references('id')->on('gatividades')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('album_id')->references('id')->on('albums')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('image');
      $table->string('description');
      $table->timestamps();
    });

    Schema::create('fotoshole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->increments('id')->unsigned();
      $table->integer('ano_id')->references('id')->on('anos')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('unidade_id')->references('id')->on('unidades')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('turma_id')->references('id')->on('turmas')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('atividade_id')->references('id')->on('gatividades')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('album_id')->references('id')->on('albums')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('image');
      $table->string('description');
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_fotos_posicao` BEFORE INSERT ON `fotoshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `fotos`;
			IF (pos IS NULL) THEN
				INSERT INTO `fotos` (`ativo`, `posicao`, `image`, `description`, `created_at`, `updated_at` ) VALUES (New.ano_id, New.unidade_id, New.turma_id, New.atividade_id, New.album_id, NEW.ativo, 1, NEW.image, NEW.description, NEW.created_at, NEW.updated_at);
			ELSE
				UPDATE `fotos` set posicao = posicao + 1;
				INSERT INTO `fotos` (`ativo`, `posicao`, `image`, `description`, `created_at`, `updated_at` ) VALUES (New.ano_id, New.unidade_id, New.turma_id, New.atividade_id, New.album_id, NEW.ativo, 1, New.image, NEW.description, NEW.created_at, NEW.updated_at);
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
