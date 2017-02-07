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
      $table->integer('posicao');
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('cover_image')->nullable();
      $table->timestamps();
    });

    Schema::create('turmashole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->increments('id')->unsigned();
      $table->integer('unidade_id')->references('id')->on('unidades')->onDelete('CASCADE')->onUpdate('CASCADE');
      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('cover_image')->nullable();
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_turmas_posicao` BEFORE INSERT ON `turmashole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `turmas` where unidade_id = NEW.unidade_id;
			IF (pos IS NULL) THEN
				INSERT INTO `turmas` (`unidade_id`, `ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.unidade_id, NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
			ELSE
				UPDATE `turmas` set posicao = posicao + 1 where unidade_id = NEW.unidade_id;
				INSERT INTO `turmas` (`unidade_id`, `ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.unidade_id, NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
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
    Schema::drop('turmas');
    Schema::drop('turmashole');
    DB::unprepared('DROP TRIGGER `tr_turmas_posicao`');
  }
}
