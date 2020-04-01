@extends('layouts.app')

@section('titulo')
    {{ __('VENDAS') }}
@endsection

@section('conteudo')
    <table class="w3-table w3-bordered">
      <thead class="w3-red">
        <tr>
          <th>Funcionário</th>
          <th>Data</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Valor</th>
          <th>Opções</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($vendas as $venda)   
        <tr> 
          <tr>
            <td rowspan="{{ (count($venda['produtos']) + 1) }}">{{ $venda['user'] }}</td>
            <td rowspan="{{ (count($venda['produtos']) + 1) }}">{{ $venda['data'] }}</td>
          </tr>
          @for ($i = 0; $i < count($venda['produtos']); $i++) 
            <tr>
              <td>{{ $venda['produtos'][$i]->descricao }}</td>
              <td>{{ $venda['produtos'][$i]->quantidade }}</td>
              @if ($i == 0)
                <td rowspan="{{ (count($venda['produtos']) + 1) }}">{{ $venda['valor'] }}</td>
                <td rowspan="{{ (count($venda['produtos']) + 1) }}">
                  <a href="{{ action('VendaController@destroy',['id' => $venda['id']]) }}" class="w3-btn w3-red"><i class="fa fa-cart-arrow-down"></i></a>
                </td>
              @endif
            </tr>
          @endfor
          
        </tr>       
        @endforeach
      </tbody>
    </table>
    @endsection