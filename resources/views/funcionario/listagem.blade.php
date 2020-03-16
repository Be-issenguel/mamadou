@extends('layouts.app')

@section('titulo')
    {{ __('LISTAGEM DE FORNECEDORES') }}
@endsection

@section('conteudo')
<div class="w3-container">
  <table class="w3-table-all">
    <thead>
      <a href="{{ action('UserController@create') }}" class="" style="margin-left: 92%">
        <button class="w3-button w3-xlarge w3-circle w3-blue">+</button>
      </a>
      <tr class="w3-red">
        <th><i class="fa fa-user"></i> Nome</th>
        <th><i class="fa fa-venus-mars"></i> Gênero</th>
        <th><i class="fa fa-envelope"></i> Email</th>
        <th><i class="fa fa-phone"></i> Telefone</th>
        <th><i class="fa fa-cogs"></i>Opções</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($funcionarios as $funcionario)
          <tr>
            <td>{{ $funcionario->name }}</td>
            <td>{{ $funcionario->genero }}</td>
            <td>{{ $funcionario->email }}</td>
            <td>{{ $funcionario->telefone }}</td>
            <td>
              <div class="w3-dropdown-hover">
                <button class="w3-button w3-blue"> <i class="fa fa-cogs"></i> </button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a href="{{ action('UserController@edit',['id' => encrypt($funcionario->id)]) }}" class="w3-bar-item w3-button"> <i class="fa fa-edit"></i> editar</a>
                  <a href="{{ action('UserController@destroy',['id' => encrypt($funcionario->id)]) }}" class="w3-bar-item w3-button"> <i class="fa fa-trash-alt"></i> remover</a>
                </div>
              </div>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection