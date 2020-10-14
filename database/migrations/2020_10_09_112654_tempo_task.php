<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TempoTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tempo_task', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id');
            $table->string('tempo');
            $table->foreign('task_id')->references('id')->on('tasks')->onUpdate('cascade');
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
        Schema::dropIfExists('tempo_task');
    }
}
