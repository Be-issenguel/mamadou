@extends('layouts.app')

@section('titulo')
    {{ __('NOVA VENDA') }}
@endsection

@section('conteudo')
<div class="w3-container">
  <table class="w3-table-all">
    <thead>
      <a href="#">
        <button class="w3-button w3-xlarge w3-blue"><span class="carrinho">0</span> <i class="fa fa-shopping-cart"></i></button>
      </a>
      <tr class="w3-red">
        <th><i class="fa fa-pen"></i> Descrição</th>
        <th><i class="fa fa-balance-scale"></i> Quantidade</th>
        <th><i class="fa fa-dollar-sign"></i> Preço</th>
        <th><i class="fa fa-cogs"></i>Opções</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($produtos as $produto)
          <tr>
            <td>{{ $produto->descricao }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>{{ $produto->preco_venda }}</td>
            <td>
              <a href="#" data-value="btn-add" data-id="{{ $produto->id }}" id="btn-adicionar" class="w3-bar-item w3-button w3-green"> <i class="fa fa-cart-plus"></i> </a>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection

@section('js')
    
@endsection