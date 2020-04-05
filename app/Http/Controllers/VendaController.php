<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Venda;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Pagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Mostra todas vendas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendas = Venda::where('estado', 'concluida')->get();
        $dados = array();
        foreach ($vendas as $venda) {
            array_push($dados, [
                'id' => $venda->id,
                'user' => $venda->user->name,
                'data' => $venda->created_at,
                'valor' => $venda->total_compra,
                'produtos' => $venda->findProdutos($venda->id),
            ]);
        }
        $count = count($dados);
        $page = $request->page;
        $perPage = 2;
        $offset = ($page - 1) * $perPage;
        $dados = array_slice($dados, $offset, $perPage);
        $dados = new Pagination($dados, $count, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        return view('venda.listagem')->withVendas($dados);
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
                if (!count(session('carrinho')['produtos']) > 0) {
                    session(['carrinho' => ['produtos' => array()]]);
                }
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
            DB::table('produto_venda')->insert(
                [
                    'venda_id' => $venda->id,
                    'produto_id' => $request->venda[$i]['id'],
                    'quantidade' => $request->venda[$i]['quantidade'],
                ]
            );
            $produto = Produto::find($request->venda[$i]['id']);
            $produto->quantidade -= $request->venda[$i]['quantidade'];
            $produto->save();
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
        $venda = Venda::find($id);
        foreach ($venda->findProdutos($venda->id) as $produto) {
            $p = Produto::find($produto->id);
            $p->quantidade += $produto->quantidade;
            $p->save();
            $venda->guardarVendaEstornada($venda->id, $produto->id, $produto->quantidade);
        }
        Venda::destroy($id);
        session(['qtd_estorno' => Venda::where('estado', 'por_estornar')->count()]);
        return back();
    }

    /**
     * Lista os produtos por vender
     *
     * @return \Illuminate\Http\Response
     */
    public function carrinho()
    {
        $carrinho = array();
        if (session('carrinho')['produtos'] != null) {
            foreach (session('carrinho')['produtos'] as $id_produto) {
                $carrinho = array_prepend($carrinho, Produto::find($id_produto));
            }
        } else {
            return back();
        }
        return view('venda.carrinho')->withProdutos($carrinho);
    }

    public function esvaziarCarrinho()
    {
        session()->forget('carrinho');
        return back();
    }

    public function removerCarrinho($id)
    {
        $array = session('carrinho')['produtos'];
        $key = array_search($id, $array);
        unset($array[$key]);
        session()->forget('carrinho');
        session(['carrinho' => ['produtos' => $array]]);
        return $key;
    }

    /**
     * Mostra todas as vendas do utlizador logado
     *
     * @return vendas
     */
    public function minhasVendas(Request $request)
    {
        $vendas = Venda::where('estado', 'concluida')->get();
        $dados = array();
        foreach ($vendas as $venda) {
            if ($venda->user_id == Auth::user()->id) {
                array_push($dados, [
                    'id' => $venda->id,
                    'user' => $venda->user->name,
                    'data' => $venda->created_at,
                    'valor' => $venda->total_compra,
                    'produtos' => $venda->findProdutos($venda->id),
                ]);
            }
        }
        $count = count($dados);
        $page = $request->page;
        $perPage = 1;
        $offset = ($page - 1) * $perPage;
        $dados = array_slice($dados, $offset, $perPage);
        $dados = new Pagination($dados, $count, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        return view('venda.minhas_vendas')->withVendas($dados);
    }

    public function vendasPorData(Request $request)
    {
        $vendas = Venda::where(['data' => $request->data, 'estado' => 'concluida'])->get();
        $dados = array();
        foreach ($vendas as $venda) {
            if ($venda->user_id == Auth::user()->id) {
                array_push($dados, [
                    'id' => $venda->id,
                    'user' => $venda->user->name,
                    'data' => $venda->created_at,
                    'valor' => $venda->total_compra,
                    'produtos' => $venda->findProdutos($venda->id),
                ]);
            }
        }
        return view('venda.vendas_diarias')->withVendas($dados);
    }

    public function comunicarEstorno($id)
    {
        $venda = Venda::find($id);
        $venda->estado = 'por_estornar';
        $venda->save();
        $qtdEstorno = Venda::where('estado', 'por_estornar')->count();
        session(['qtd_estorno' => $qtdEstorno]);
        return redirect()->action('VendaController@minhasVendas');
    }

    public function findVendasPorEstornar(Request $request)
    {
        $vendas = Venda::where('estado', 'por_estornar')->get();
        $dados = array();
        foreach ($vendas as $venda) {
            array_push($dados, [
                'id' => $venda->id,
                'user' => $venda->user->name,
                'data' => $venda->created_at,
                'valor' => $venda->total_compra,
                'produtos' => $venda->findProdutos($venda->id),
            ]);
        }
        $count = count($dados);
        $page = $request->page;
        $perPage = 2;
        $offset = ($page - 1) * $perPage;
        $dados = array_slice($dados, $offset, $perPage);
        $dados = new Pagination($dados, $count, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        return view('venda.listagem')->withVendas($dados);
    }
}
