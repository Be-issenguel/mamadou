<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }
    /**
     * Busca os produtos de uma determinada venda
     *
     * @return produtos
     */
    public function findProdutos($venda_id)
    {
        $produtos = DB::table('produto_venda')
            ->join('produtos', 'produtos.id', '=', 'produto_venda.produto_id')
            ->join('vendas', 'vendas.id', '=', 'produto_venda.venda_id')
            ->join('users', 'users.id', '=', 'vendas.user_id')
            ->where('vendas.id', $venda_id)
            ->select('produtos.descricao', 'produtos.preco_venda', 'produto_venda.quantidade')
            ->get();
        return $produtos;
    }
}
