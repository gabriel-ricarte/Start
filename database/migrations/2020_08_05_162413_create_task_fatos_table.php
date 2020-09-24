<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskFatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_fatos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('projeto_id');
            $table->unsignedInteger('quadro_id');
            $table->integer('estado')->default(0);
            $table->integer('prioridade')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('quadro_id')->references('id')->on('quadros')->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onUpdate('cascade');
            $table->foreign('projeto_id')->references('id')->on('projetos')->onUpdate('cascade');
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
        Schema::dropIfExists('task_fatos');
    }
}
