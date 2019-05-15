<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemBalancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_balancos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('balanco_id')->unsigned();
            $table->foreign('balanco_id')->references('id')->on('balancos');
            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->string('produto_nome'); 
            $table->integer('quantidade_balanco');
            $table->integer('quantidade_anterior');
            $table->integer('diferenca_balanco'); 
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
        Schema::dropIfExists('item_balancos');
    }
}
