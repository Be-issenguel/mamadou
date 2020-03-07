<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['nome' => 'vendedor', 'descricao' => 'Utilizador que efectua vendas'],
            ['nome' => 'gerente', 'descricao' => 'Utilizador que cadastra produtos, fornecedores e efectua vendas'],
            ['nome' => 'admin', 'descricao' => 'Utilizador capaz de realizar qualquer operação no sistema'],
            ['nome' => 'fornecedor', 'descricao' => 'Utilizador que fornece produtos para o estabelcimento']
        ]);
    }
}
