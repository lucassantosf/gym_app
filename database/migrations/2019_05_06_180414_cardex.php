<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cardex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardex', function (Blueprint $table) {
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->integer('balanco_id')->unsigned()->nullable();
            $table->foreign('balanco_id')->references('id')->on('balancos');
            $table->integer('compra_id')->unsigned()->nullable();
            $table->foreign('compra_id')->references('id')->on('compras');
            $table->integer('venda_avulsa_id')->unsigned()->nullable();
            $table->foreign('venda_avulsa_id')->references('id')->on('venda_avulsas');
            $table->integer('entrada')->nullable();
            $table->integer('saida')->nullable();
            $table->integer('saldo_anterior');
            $table->integer('saldo_atual');
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
        Schema::table('cardex', function (Blueprint $table) {
            //
        });
    }
}
