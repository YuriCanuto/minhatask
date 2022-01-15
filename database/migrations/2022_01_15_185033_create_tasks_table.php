<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('board_id');
            $table->string('code')->nullable()->comment('código único da sua atividade');
            $table->string('name')->comment('nome da atividade');
            $table->string('timing')->nullable()->comment('tempo em dias, horas, minutos ou story points');
            $table->string('sprint')->nullable()->comment('qual sprint ou em qual sequência de desenvolvimento sua task está');
            $table->text('description')->nullable()->comment('descrição da tarefa');
            $table->date('initial_date')->nullable()->comment('data inicial da tarefa');
            $table->date('final_date')->nullable()->comment('data final para entrega da tarefa ou a data final que a tarefa foi concluída');
            $table->unsignedInteger('order_column')->nullable()->comment('ordem da tarefa no board');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('board_id')->references('id')->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
