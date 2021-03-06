<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produto.listagem')->withProdutos($produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $produto = new Produto();
        $produto->user_id = Auth::user()->id;
        $produto->descricao = $request->descricao;
        $produto->quantidade = $request->quantidade;
        $produto->preco_compra = $request->preco_de_compra;
        $produto->preco_venda = $request->preco_de_venda;
        $produto->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find(decrypt($id));
        return view('produto.novo')->withProduto($produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'quantidade' => 'required|integer',
            'preco_de_compra' => 'required|numeric',
            'preco_de_venda' => 'required|numeric',
        ]);
        $produto = Produto::find(decrypt($request->id));
        $produto->descricao = $request->descricao;
        $produto->quantidade = $request->quantidade;
        $produto->preco_compra = $request->preco_de_compra;
        $produto->preco_venda = $request->preco_de_venda;
        $produto->save();
        return redirect()->action('ProdutoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produto::destroy(decrypt($id));
        return back();
    }
}
