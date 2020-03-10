@extends('layouts.app')

@section('titulo')
    {{ __('LISTAGEM DE FORNECEDORES') }}
@endsection

@section('conteudo')
<div class="w3-container">
  <table class="w3-table-all">
    <thead>
      <tr class="w3-red">
        <th><i class="fa fa-user"></i> Nome</th>
        <th><i class="fa fa-barcode"></i> Nif</th>
        <th><i class="fa fa-phone"></i> Telefone</th>
        <th><i class="fa fa-cogs"></i>Opções</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($fornecedores as $fornecedor)
          <tr>
            <td>{{ $fornecedor->nome }}</td>
            <td>{{ $fornecedor->nif }}</td>
            <td>{{ $fornecedor->telefone }}</td>
            <td>
              <div class="w3-dropdown-hover">
                <button class="w3-button w3-blue"> <i class="fa fa-cogs"></i> </button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="{{ action('ProdutoController@edit',['id' => encrypt($fornecedor->id)]) }}" class="w3-bar-item w3-button"> <i class="fa fa-edit"></i> editar</a>
                  <a href="{{ action('FornecedorController@destroy',['id' => encrypt($fornecedor->id)]) }}" class="w3-bar-item w3-button"> <i class="fa fa-trash-alt"></i> remover</a>
                </div>
              </div>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection