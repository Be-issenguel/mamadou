<!DOCTYPE html>
<html>
<title>Mamadou</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><i class="fa fa-cubes fa-2x"></i></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
    <img src="{{ asset('images/img_avatar2.png') }}" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span><strong>{{ Auth::user()->name }}</strong></span><br>
      <a href="{{ route('home') }}" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a class="w3-bar-item w3-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-power-off"></i></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5 style="text-align:center">MENU</h5>
  </div>
  <div class="w3-bar-block">
    
    
    <div class="w3-bar-item w3-button" onclick="myAccFunc('funcionarios')">
        <i class="fa fa-user-tie"></i> Funcionários
    </div>
    <div id="funcionarios" class="w3-hide w3-black w3-card-4">
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-user-plus"></i> Novo Funcionário</a>
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-poll-h"></i> Lista de Funcionários </a>
    </div>

    <div class="w3-bar-item w3-button" onclick="myAccFunc('fornecedores')">
       <i class="fa fa-dolly"></i> Fornecedores 
    </div>
    <div id="fornecedores" class="w3-hide w3-black w3-card-4">
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-oil-can"></i> Novo Fornecedor</a>
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-clipboard-list"></i> Listar Fornecedores</a>
    </div>

    <div class="w3-bar-item w3-button" onclick="myAccFunc('produtos')">
        <i class="fa fa-cubes"></i> Produtos 
    </i></div>
    <div id="produtos" class="w3-hide w3-black w3-card-4">
        <a href="{{ action('ProdutoController@create') }}" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-plus-square"></i> Nova Entrada </a>
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-list"></i> Lista de Entradas</a>
    </div>

    <div class="w3-bar-item w3-button" onclick="myAccFunc('vendas')">
        <i class="fa fa-shopping-cart"></i> Vendas 
    </div>
    <div id="vendas" class="w3-hide w3-black w3-card-4">
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-cart-plus"></i> Nova Venda </a>
        <a href="#" class="w3-bar-item w3-button" id="inside-link">Link</a>
    </div>

    <div class="w3-bar-item w3-button" onclick="myAccFunc('configuracao')">
        <i class="fa fa-tools"></i> Configurações
    </div>
    <div id="configuracao" class="w3-hide w3-black w3-card-4">
        <a href="#" class="w3-bar-item w3-button" id="inside-link"> <i class="fa fa-clock"></i> Horário de atendimento </a>
        <a href="#" class="w3-bar-item w3-button" id="inside-link">Link</a>
    </div>

  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  
  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-dashboard"></i> @yield('titulo')</b></h2>
  </header>

  <div class="w3-container">
    @yield('conteudo')
  </div>
  
  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}

function myAccFunc(id) {
  var x = "";
  switch(id){
    case "funcionarios": 
      x = document.getElementById("funcionarios");
      break;
    case "fornecedores":
      x = document.getElementById("fornecedores");
      break;
    case "produtos":
      x = document.getElementById("produtos");
      break;
    case "vendas":
      x = document.getElementById("vendas");
      break;
    case "configuracao":
      x = document.getElementById("configuracao");
      break;
  }
 
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-blue";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-blue", "");
  }
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_analytics&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Jan 2019 11:23:43 GMT -->
</html>
