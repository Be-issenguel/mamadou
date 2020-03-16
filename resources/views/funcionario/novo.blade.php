@extends('layouts.app')

@section('titulo')
    {{ isset($funcionario)?__('ACTUALIZAÇÃO'):__('CADASTRO') }} DE FUNCIONÁRIO
@endsection
@section('conteudo')
<form action="{{ isset($funcionario->id)?action('UserController@update'):action('UserController@store') }}" method="{{ __('POST') }}" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
  @csrf
  <input type="hidden" name="id" value="{{ isset($funcionario->id)?encrypt($funcionario->id):'' }}">
<h2 class="w3-center">{{ isset($funcionario->id)?__('ACTUALIZAR'):__('NOVO') }} FUNCIONÁRIO</h2>
 
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user-circle"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="nome" type="text" value="{{ isset($funcionario->id)?$funcionario->descricao:old('nome') }}" placeholder="Nome do funcionário">
      @if ($errors->has('nome'))
        <span class="w3-error">{{ $errors->first('nome') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="email" type="email" value="{{ isset($funcionario->id)?$funcionario->quantidade:old('email') }}" min="1" placeholder="Email do funcionário">
      @if ($errors->has('email'))
        <span class="w3-error">{{ $errors->first('email') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-users"></i></div>
    <div class="w3-rest">
      <select name="papel" id="" class="w3-input w3-border" required>
        <option value="" disabled selected>Escolha o grupo</option>
        @foreach ($roles as $role)
          <option value="{{ $role->id }}">{{ $role->nome }}</option>
        @endforeach
      </select>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="palavra_passe" type="password" placeholder="palavra_passe">
      @if ($errors->has('palavra_passe'))
        <span class="w3-error">{{ $errors->first('palavra_passe') }}</span>
      @endif
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user-lock"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="palavra_passe_confirmation" type="password" placeholder="Confirme a palavra passe">
      @if ($errors->has('palavra_passe_confirmation'))
        <span class="w3-error">{{ $errors->first('palavra_passe_confirmation') }}</span>
      @endif
    </div>
</div>

<button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">{{ isset($funcionario->id)?__('Actualizar'):__('Cadastrar') }}</button>

</form>

@endsection