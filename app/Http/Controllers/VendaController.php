<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Mostrar a lista de produtos disponiveis para venda
     *
     * @return \Illuminate\Http\Response
     */
    public function listarProdutos($id = 0)
    {

        if (!session()->exists('carrinho')) {
            session(['carrinho' => ['produtos' => array()]]);
        } else {

            //dd(array_search($id, session('carrinho.produtos')));
            if ($id > 0 and !is_int(array_search($id, session('carrinho.produtos')))) {
                $produto = Produto::find($id);
                session()->push('carrinho.produtos', $produto->id);
            } else {

            }
        }
        $produtos = Produto::all();
        return view('venda.nova_venda')->withProdutos($produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venda = new Venda();
        $venda->user_id = Auth::user()->id;
        $venda->data = now();
        $venda->total_compra = $request->venda[0];
        $venda->save();
        $venda = Venda::find($venda->id);
        for ($i = 1; $i < count($request->venda); $i++) {
            DB::table('venda_produto')->insert(
                [
                    'venda_id' => $venda->id,
                    'produto_id' => $request->venda[$i]['id'],
                    'quantidade' => $request->venda[$i]['quantidade'],
                ]
            );
        }
        session()->forget('carrinho');
        return 1;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Lista os produtos por vender
     *
     * @return \Illuminate\Http\Response
     */
    public function carrinho()
    {
        $carrinho = array();
        foreach (session('carrinho')['produtos'] as $id_produto) {
            $carrinho = array_prepend($carrinho, Produto::find($id_produto));
        }
        return view('venda.carrinho')->withProdutos($carrinho);
    }

    public function esvaziarCarrinho()
    {
        session()->forget('carrinho');
        return back();
    }
}
