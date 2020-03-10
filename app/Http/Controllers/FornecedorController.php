<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Http\Requests\FornecedorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedor.listagem')->withFornecedores($fornecedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorRequest $request)
    {
        $fornecedor = new Fornecedor();
        $fornecedor->user_id = Auth::user()->id;
        $fornecedor->nome = $request->nome;
        $fornecedor->nif = $request->nif;
        $fornecedor->genero = $request->genero;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->save();
        return redirect()->action('FornecedorController@index');
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
        $fornecedor = Fornecedor::find(decrypt($id));
        return view('fornecedor.novo')->withFornecedor($fornecedor);
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
            'nome' => 'required',
            'nif' => 'required|regex:/^[0-9]{9}[A-Z]{2}[0-9]{3}$/i',
            'genero' => 'required',
            'telefone' => 'required|regex:/^[9]{1}[1-9]{1}[0-9]{7}$/i',
        ]);
        $fornecedor = Fornecedor::find(decrypt($request->id));
        $fornecedor->nome = $request->nome;
        $fornecedor->genero = $request->genero;
        $fornecedor->nif = $request->nif;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->save();
        return redirect()->action('FornecedorController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fornecedor::destroy(decrypt($id));
        return back();
    }
}
