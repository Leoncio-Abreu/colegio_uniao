<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasholeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticiashole', function (Blueprint $table) {
			$table->engine = 'BLACKHOLE';
            $table->increments('id');
			$table->timestamp('visualizar');
			$table->integer('ativo');
			$table->integer('posicao');
			$table->string('titulo', 32);
            $table->string('descricao', 128);
            $table->text('banner');
            $table->text('texto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('noticiashole');
    }
}
