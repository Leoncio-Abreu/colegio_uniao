<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesholeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividadeshole', function (Blueprint $table) {
	$table->engine = 'BLACKHOLE';
            $table->increments('id');
            $table->timestamp('visualizar')->nullable();
            $table->integer('ativo')->nullable();
            $table->integer('posicao')->nullable();
            $table->string('titulo', 32)->nullable();
            $table->string('descricao', 128)->nullable();
            $table->string('banner')->nullable();
            $table->text('texto')->nullable();
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
