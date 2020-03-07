<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['nome' => 'vender', 'descricao' => 'Permissão para efectuar vendas na app'],
            ['nome' => 'cadastrar_utilizador', 'descricao' => 'Permissão inserir novos utilizadores na app'],
            ['nome' => 'estornar_venda', 'descricao' => 'Permissão para estornar vendas na app'],
            ['nome' => 'listar_vendas', 'descricao' => 'Permissão para listar vendas na app'],
            ['nome' => 'listar_utilizadores', 'descricao' => 'Permissão para listar utilizadores na app'],
            ['nome' => 'cadastrar_produtos', 'descricao' => 'Permissão para inserir na app'],
            ['nome' => 'listar_fornecedores', 'descricao' => 'Permissão para listar fornecedores na app'],
        ]);
    }
}
