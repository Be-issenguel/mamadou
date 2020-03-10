@extends('layouts.app')

@section('titulo')
    {{ isset($fornecedor)?__('ACTUALIZAÇÃO'):__('CADASTRO') }} DE FORNECEDOR
@endsection
@section('conteudo')
<form action="{{ isset($fornecedor->id)?action('FornecedorController@update'):action('FornecedorController@store') }}" method="{{ __('POST') }}" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
  @csrf
  <input type="hidden" name="id" value="{{ isset($fornecedor->id)?encrypt($fornecedor->id):'' }}">
<h2 class="w3-center">{{ isset($fornecedor->id)?__('ACTUALIZAR'):__('NOVO') }} FORNECEDOR</h2>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="nome" type="text" value="{{ isset($fornecedor->id)?$fornecedor->nome:old('nome') }}" placeholder="nome completo">
      @if ($errors->has('nome'))
        <span class="w3-error">{{ $errors->first('nome') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-barcode"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="nif" type="text" value="{{ isset($fornecedor->id)?$fornecedor->nif:old('nif') }}" min="1" placeholder="número de identificação fiscal">
      @if ($errors->has('nif'))
        <span class="w3-error">{{ $errors->first('nif') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-venus-mars"></i></div>
    <div class="w3-rest">
      <select class="w3-input w3-border" name="genero" id="">
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
      </select>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="telefone" type="text" value="{{ isset($fornecedor->id)?$fornecedor->preco_venda:old('telefone') }}" placeholder="telefone">
      @if ($errors->has('telefone'))
        <span class="w3-error">{{ $errors->first('telefone') }}</span>
      @endif
    </div>
</div>

<button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">{{ isset($fornecedor->id)?__('Actualizar'):__('Cadastrar') }}</button>

</form>

@endsection