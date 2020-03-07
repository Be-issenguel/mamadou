<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fornecedor_id')->unsigned();
            $table->date('data');
            $table->decimal('total_pagar',10,2);
            $table->decimal('valor_entregue',10,2);
            $table->decimal('troco',10,8);
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });

        Schema::create('fornecimento_produto', function (Blueprint $table){
            $table->integer('fornecimento_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->foreign('fornecimento_id')->references('id')->on('fornecimentos')->onDelete('cascade');
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
        Schema::dropIfExists('fornecimentos');
    }
}
