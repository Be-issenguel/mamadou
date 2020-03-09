@extends('layouts.app')

@section('titulo')
    {{ isset($produto)?__('ACTUALIZAÇÃO'):__('CADASTRO') }} DE PRODUTO
@endsection
@section('conteudo')
<form action="{{ isset($produto->id)?action('ProdutoController@update'):action('ProdutoController@store') }}" method="{{ __('POST') }}" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
  @csrf
  <input type="hidden" name="id" value="{{ isset($produto->id)?encrypt($produto->id):'' }}">
<h2 class="w3-center">{{ isset($produto->id)?__('ACTUALIZAR'):__('NOVO') }} PRODUTO</h2>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pen"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="descricao" type="text" value="{{ isset($produto->id)?$produto->descricao:old('descricao') }}" placeholder="Descrição do produto">
      @if ($errors->has('descricao'))
        <span class="w3-error">{{ $errors->first('descricao') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-balance-scale"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="quantidade" type="number" value="{{ isset($produto->id)?$produto->quantidade:old('quantidade') }}" min="1" placeholder="Quantidade do produto">
      @if ($errors->has('quantidade'))
        <span class="w3-error">{{ $errors->first('quantidade') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-coins"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="preco_de_compra" type="text" value="{{ isset($produto->id)?$produto->preco_compra:old('preco_de_compra') }}" placeholder="Preço de compra">
      @if ($errors->has('preco_de_compra'))
        <span class="w3-error">{{ $errors->first('preco_de_compra') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-dollar-sign"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="preco_de_venda" type="text" value="{{ isset($produto->id)?$produto->preco_venda:old('preco_de_venda') }}" placeholder="Preço de venda">
      @if ($errors->has('preco_de_venda'))
        <span class="w3-error">{{ $errors->first('preco_de_venda') }}</span>
      @endif
    </div>
</div>

<button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">{{ isset($produto->id)?__('Actualizar'):__('Cadastrar') }}</button>

</form>

@endsection