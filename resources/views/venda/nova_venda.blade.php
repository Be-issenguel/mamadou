@extends('layouts.app')

@section('titulo')
    {{ __('NOVA VENDA') }}
@endsection

@section('conteudo')
<div class="w3-container">
  <table class="w3-table-all">
    <thead>
      <a href="{{ action('VendaController@carrinho') }}">
      <button id="btn-carrinho" class="w3-button w3-xlarge w3-blue" disabled><span class="carrinho">{{ count(session('carrinho')['produtos']) }}</span> <i class="fa fa-shopping-cart"></i></button>
      </a>
      <a href="{{ action('VendaController@esvaziarCarrinho') }}">
      <button class="w3-button w3-xlarge w3-red"><span>Esvaziar</span> <i class="fa fa-cart-arrow-down"></i></button>
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
          <tr data-id="teste">
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
    <script>
      $(document).ready(function(){
        //verifica se pode activar o botão para ver o carrinho
        if(parseInt($('.carrinho').text()) > 0){
          $('#btn-carrinho').removeAttr('disabled');
        }
        
        $("a").click(function(){
          var v = $(this).data('value');
          $(this).parents('tr').remove();
          if(v == 'btn-add'){
            $('.carrinho').text(parseInt($('.carrinho').text()) + 1);
            //verifica se pode activar o botão para ver o carrinho
            if(parseInt($('.carrinho').text()) > 0){
              $('#btn-carrinho').removeAttr('disabled');
            }
            var id = $(this).data('id');
            var url = "{{ url('venda/nova') }}";
            $.get(url+'/'+id, function(dados,status){
              if(status == 'success'){
                
              }
            });
          }
        });
      });
    </script>
@endsection