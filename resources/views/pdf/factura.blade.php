@extends('layouts.pdf')
@section('conteudo')
    <div class="w3-container">
        <h3>Benas.be - COMÉRCIO E INDÚSTRIA, LDA</h3>
        <p>Estrada Direita de Cacuaco - Lanchonete Verde</p>
        <p>Bairro Boa Esperança III</p>
        <p>LUANDA - ANGOLA</p>
        <p><span>NIF:</span>005837121LA282</p>
        <table class="w3-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i < count($dados); $i++)
                    <tr>
                        <td>{{ $dados[$i]['produto'] }}</td>
                        <td>{{ $dados[$i]['preco'] }}</td>
                        <td>x{{ $dados[$i]['quantidade'] }}</td>
                        <td>{{ $dados[$i]['valor'] }}</td>
                    </tr>
                @endfor
                <tr class="fat-rodape">
                    <td colspan="3">Total Geral: ----------------------------------------------------------------------------</td>
                    <td>{{ $dados[0] }}AKZ</td>
                </tr>
                <tr>
                    <td colspan="3">Valor Entrgue: --------------------------------------------------------------------------------</td>
                    <td>{{ $dados[0]  }}     AKZ</td>
                </tr>
                <tr>
                    <td colspan="3">Troco: ------------------------------------------------------------------------------------------ </td>
                    <td>0 AKZ</td>
                </tr>
                <tr class="fat-rodape-final">
                    <td colspan="3">Descontos:  ------------------------------------------------------------------------------------ </td>
                    <td>0 AKZ</td>
                </tr>
            </tbody>
        </table> 
        <p class="operador">Operador: {{ Auth::user()->name }}</p>
        <h5>Obrigado, Volte Sempre...</h5>
    </div>
@endsection

