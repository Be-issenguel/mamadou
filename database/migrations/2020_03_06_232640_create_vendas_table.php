<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('data');
            $table->decimal('total_compra', 8, 2);
            $table->enum('estado', ['concluida', 'por_estornar'])->default('concluida');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });

        Schema::create('estornos', function (Blueprint $table) {
            $table->integer('venda_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('quantidade')->unsigned();
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
        Schema::dropIfExists('vendas');
    }
}
