@extends('layouts.app')

@section('titulo')
    {{ __('PRODUTOS A COMPRAR') }}
@endsection
@section('conteudo')
<div class="w3-container">
  <table class="w3-table-all">
      <h2 class="token">@csrf</h2>
    <thead>
        <button class="w3-button w3-xlarge w3-green">Preço Total: <span class="pt"></span> <i class="fa fa-dollar-sign"></i></button>
        <tr class="w3-red">
            <th><i class="fa fa-pen"></i> Descrição</th>
            <th><i class="fa fa-balance-scale"></i> Quantidade</th>
            <th><i class="fa fa-dollar-sign"></i> Preço Unitário</th>
            <th><i class="fa fa-dollar-sign"></i> Preço Total</th>
            <th><i class="fa fa-cogs"></i>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produtos as $produto)
        <tr data-id="{{ $produto->id }}">
            <td>{{ $produto->descricao }}</td>
            <td class="qtd" data-value="{{ $produto->quantidade }}">1</td>
            <td class="preco">{{ $produto->preco_venda }}</td>
            <td class="total_produto">{{ $produto->preco_venda }}</td>
            <td>
                <a href="#" data-value="add" data-id="{{ $produto->id }}"  class="w3-bar-item w3-button w3-circle w3-blue"> <i class="fa fa-plus"></i> </a>
                <a href="#" data-value="dec" data-id="{{ $produto->id }}"  class="w3-bar-item w3-button w3-circle w3-yellow"> <i class="fa fa-minus"></i> </a>
                <a href="#" data-value="rem" data-id="{{ $produto->id }}"  class="w3-bar-item w3-button w3-circle w3-red"> <i class="fa fa-trash"></i> </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ action('VendaController@listarProdutos') }}" style="float: right" class="finalizar" target="_blank">
    <button class="w3-button w3-xlarge w3-green">Finalizar Venda <i class="fa fa-shopping-cart"></i></button>
</a>
<a href="{{  action('VendaController@listarProdutos') }}">
    <button class="w3-button w3-xlarge w3-blue"><i class="fa fa-hand-point-left"></i>Voltar </button>
</a>
</div>

@endsection

@section('js')
<script>
    $(document).ready( function (){
        calcular_total();
        $("a").click( function (){
            var accao = $(this).data('value');
            if (accao == 'add'){
                qtd_real = parseInt($(this).parents('tr').children(".qtd").data('value'));
                qtd_actual = parseInt($(this).parents('tr').children(".qtd").text());
                if(qtd_real - 1 > qtd_actual){
                    qtd_actual++;
                    $(this).parents('tr').children(".qtd").text(qtd_actual);
                    preco = parseFloat($(this).parents('tr').children(".preco").text()) * qtd_actual;
                    $(this).parents('tr').children(".total_produto").text(preco);
                    calcular_total();
                } 
            }else if(accao == 'dec'){
                //qtd_real = parseInt($(this).parents('tr').children(".qtd").data('value'));
                qtd_actual = parseInt($(this).parents('tr').children(".qtd").text());
                if(qtd_actual > 1 ){
                    qtd_actual--;
                    $(this).parents('tr').children(".qtd").text(qtd_actual);
                    preco = parseFloat($(this).parents('tr').children(".preco").text()) * qtd_actual;
                    $(this).parents('tr').children(".total_produto").text(preco);
                    calcular_total();
                } 
            }else if(accao == 'rem'){
                id = $(this).data('id');
                $(this).parents('tr').remove();
                url = "{{ url('venda/remover') }}";
                $.get(url+'/'+id, function(dados,status){
                    if(status == 'success'){
                       calcular_total();
                       if(contar_produtos_carrinho()){
                           location.href = "{{ action('VendaController@listarProdutos') }}";
                       }
                    }
                })
            }
        });

        $('.finalizar').click(function (){
            venda = Array();
            venda.push($('.pt').text());
            
            
            $('tbody').children('tr').each(function (){
                id = $(this).data('id');
                quantidade = $(this).children('.qtd').text();
                venda.push({"id": id, "quantidade": quantidade});
            });
            _token = $('.token').children('input').val();
           $.post("{{ action('VendaController@store') }}",
                {venda: venda, _token: _token}, function (dados, status){
                 if(status == 'success'){
                    location.href = "{{ action('pdf\PdfVendaController@factura') }}";
                 }
                }
            );
        });

        function calcular_total(){
            preco_total = 0;
            $('tbody').children('tr').each(function(){
                preco_total = preco_total + parseInt($(this).children('.total_produto').text());
            });
            $('.pt').text(preco_total);
        }

        function contar_produtos_carrinho(){
            cont = 0;
            $('tbody').children('tr').each(function(){
                cont++;
            });
            return cont == 0;
        }
    });
</script>
@endsection