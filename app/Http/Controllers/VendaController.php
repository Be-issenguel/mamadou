<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

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
        //
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
        dd(session('carrinho'));
    }

    public function esvaziarCarrinho()
    {
        session()->forget('carrinho');
        return back();
    }
}
