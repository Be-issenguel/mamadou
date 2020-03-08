@extends('layouts.app')

@section('titulo')
    {{ __('LISTAGEM DE PRODUTOS') }}
@endsection

@section('conteudo')
<div class="w3-container">
  <table class="w3-table-all">
    <thead>
      <tr class="w3-red">
        <th><i class="fa fa-pen"></i> Descrição</th>
        <th><i class="fa fa-balance-scale"></i> Quantidade</th>
        <th><i class="fa fa-coins"></i> Preço de Compra</th>
        <th><i class="fa fa-dollar-sign"></i> Preço de Venda</th>
        <th><i class="fa fa-cogs"></i>Opções</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($produtos as $produto)
          <tr>
            <td>{{ $produto->descricao }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>{{ $produto->preco_compra }}</td>
            <td>{{ $produto->preco_venda }}</td>
            <td>
              <div class="w3-dropdown-hover">
                <button class="w3-button w3-blue"> <i class="fa fa-cogs"></i> </button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="#" class="w3-bar-item w3-button"> <i class="fa fa-edit"></i> editar</a>
                <a href="{{ action('ProdutoController@destroy',['id' => encrypt($produto->id)]) }}" class="w3-bar-item w3-button"> <i class="fa fa-trash-alt"></i> remover</a>
                </div>
              </div>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection