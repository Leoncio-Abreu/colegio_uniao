<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerTrAtividadeshole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::unprepared('
		CREATE TRIGGER `tr_atividades_posicao` BEFORE INSERT ON `atividadeshole`
		FOR EACH ROW BEGIN
			DECLARE pos int; 
			SELECT max(posicao) into pos FROM `atividades`;
			IF (pos IS NULL) THEN
				INSERT INTO `atividades` (`visualizar`, `ativo`, `titulo`, `descricao`, `banner`, `texto`, `created_at`, `updated_at`, `posicao`) VALUES (NEW.visualizar, NEW.ativo, NEW.titulo, NEW.descricao, NEW.banner, NEW.texto, NEW.created_at, NEW.updated_at, 1);
			ELSE
				INSERT INTO `atividades` (`visualizar`, `ativo`, `titulo`, `descricao`, `banner`, `texto`, `created_at`, `updated_at`, `posicao`) VALUES (NEW.visualizar, NEW.ativo, NEW.titulo, NEW.descricao, NEW.banner, NEW.texto, NEW.created_at, NEW.updated_at, pos+1);
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
		DB::unprepared('DROP TRIGGER `tr_atividades_posicao`');
	}
}
