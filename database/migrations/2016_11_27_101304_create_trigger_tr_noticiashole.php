<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerTrNoticiashole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::unprepared('
		CREATE TRIGGER `tr_noticias_posicao` BEFORE INSERT ON `noticiashole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			DECLARE nid int; 
			SELECT max(posicao) into pos FROM atividades;
			SELECT id INTO nid FROM atividades where posicao = pos;
			IF (pos IS NULL) THEN
				INSERT INTO `noticias` (`visualizar`, `ativo`, `titulo`, `descricao`, `banner`, `texto`, `created_at`, `updated_at`, `posicao`) VALUES (NEW.visualizar, NEW.ativo, NEW.titulo, NEW.descricao, NEW.banner, NEW.texto, NEW.created_at, NEW.updated_at, 1);
			ELSE
				update atividades set posicao = pos+1 where id=nid;
				INSERT INTO `noticias` (`visualizar`, `ativo`, `titulo`, `descricao`, `banner`, `texto`, `created_at`, `updated_at`, `posicao`) VALUES (NEW.visualizar, NEW.ativo, NEW.titulo, NEW.descricao, NEW.banner, NEW.texto, NEW.created_at, NEW.updated_at, pos);
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
		DB::unprepared('DROP TRIGGER `tr_noticias_posicao`');
	}
}
