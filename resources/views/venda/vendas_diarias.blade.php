@extends('layouts.app')

@section('titulo')
    {{ __('VENDAS') }}
@endsection

@section('conteudo')
    <table class="w3-table w3-bordered">
      <thead class="w3-red">
        <tr>
          <th><i class="fa fa-calendar-day"></i> Data</th>
          <th><i class="fa fa-cubes"></i> Produtos</th>
          <th><i class="fa fa-balance-scale"></i> Quantidade</th>
          <th><i class="fa fa-dollar-sign"></i> Valor</th>
          <th><i class="fa fa-cogs"></i> Opções</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($vendas as $venda)
        <tr>
          <tr>
            <td rowspan="{{ (count($venda['produtos']) + 1) }}">{{ $venda['data'] }}</td>
          </tr>
          @for ($i = 0; $i < count($venda['produtos']); $i++)
            <tr>
              <td>{{ $venda['produtos'][$i]->descricao }}</td>
              <td>{{ $venda['produtos'][$i]->quantidade }}</td>
              @if ($i == 0)
                <td rowspan="{{ (count($venda['produtos']) + 1) }}">{{ $venda['valor'] }}</td>
                <td rowspan="{{ (count($venda['produtos']) + 1) }}">
                  <a href="{{ action('VendaController@comunicarEstorno',['id' => $venda['id']]) }}" class="w3-btn w3-blue"><i class="fa fa-bullhorn"></i></a>
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
