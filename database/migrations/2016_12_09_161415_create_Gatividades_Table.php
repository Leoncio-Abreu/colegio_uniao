<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatividadesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('gatividades', function(Blueprint $table)
    {
      $table->increments('id')->unsigned();
      $table->integer('turma_id')->references('id')->on('turmas')->onDelete('CASCADE')->onUpdate('CASCADE');      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    Schema::create('gatividadeshole', function(Blueprint $table)
    {
      $table->engine = 'BLACKHOLE';
      $table->increments('id')->unsigned();
      $table->integer('turma_id')->references('id')->on('turmas')->onDelete('CASCADE')->onUpdate('CASCADE');      $table->integer('ativo');
      $table->integer('posicao');
      $table->string('name');
      $table->text('description');
      $table->string('cover_image');
      $table->timestamps();
    });

    DB::unprepared('
		CREATE TRIGGER `tr_gatividades_posicao` BEFORE INSERT ON `gatividadeshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `gatividades` where turma_id = NEW.turma_id;
			IF (pos IS NULL) THEN
				INSERT INTO `gatividades` (`turma_id`, `ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.turma_id, NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
			ELSE
				UPDATE `gatividades` set posicao = posicao + 1  where turma_id = NEW.turma_id;
				INSERT INTO `gatividades` (`turma_id`, `ativo`, `posicao`, `name`, `description`, `cover_image`, `created_at`, `updated_at` ) VALUES (NEW.turma_id, NEW.ativo, 1, NEW.name, NEW.description, NEW.cover_image, NEW.created_at, NEW.updated_at);
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
    Schema::drop('gatividades');
    Schema::drop('gatividadeshole');
    DB::unprepared('DROP TRIGGER `tr_gatividades_posicao`');
  }
}
