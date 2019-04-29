<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('dt_born')->nullable();
            $table->string('name_mother')->nullable();
            $table->string('name_father')->nullable();
            $table->float('sexo')->nullable();
            $table->float('est_civil')->nullable();
            $table->string('cpf');
            $table->string('rg')->nullable();
            $table->string('rne')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('comple')->nullable();
            $table->string('neigh')->nullable();
            $table->string('country')->nullable();
            $table->string('uf')->nullable();
            $table->string('city')->nullable();
            $table->string('situaçao')->default('Visitante');
            $table->softDeletes();
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
        Schema::dropIfExists('clientes');
    }
}
