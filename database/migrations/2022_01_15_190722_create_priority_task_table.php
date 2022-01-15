<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priority_task', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('task_id');
            $table->foreign('priority_id')->references('id')->on('priorities');
            $table->foreign('task_id')->references('id')->on('tasks');
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
        Schema::dropIfExists('priority_task');
    }
}
