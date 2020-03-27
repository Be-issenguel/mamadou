<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('descricao', 100);
            $table->decimal('preco_compra', 10, 2);
            $table->decimal('preco_venda', 10, 2);
            $table->integer('quantidade')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });

        Schema::create('produto_venda', function (Blueprint $table) {
            $table->integer('produto_id')->unsigned();
            $table->integer('venda_id')->unsigned();
            $table->integer('quantidade');
            $table->primary(['venda_id', 'produto_id']);
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
        Schema::dropIfExists('venda_produto');
    }
}
