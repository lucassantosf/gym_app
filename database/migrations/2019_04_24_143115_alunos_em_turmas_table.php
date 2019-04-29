<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlunosEmTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('alunos_em_turmas', function (Blueprint $table) {
            $table->integer('item_turma_id')->unsigned();
            $table->foreign('item_turma_id')->references('id')->on('item_turmas'); 
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');  
            $table->string('name_cliente'); 
            //$table->integer('modal_id')->unsigned(); 
            //$table->foreign('modal_id')->references('id')->on('modalidades'); 
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
        Schema::table('alunos_em_turmas', function (Blueprint $table) {
            //
        });
    }
}
