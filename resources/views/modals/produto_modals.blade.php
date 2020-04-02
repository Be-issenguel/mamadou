<!-- Modal para pesquisar vendas por data -->
<div id="mdl_vendaPorData" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('mdl_vendaPorData').style.display='none'" 
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h2>Pesquisar Vendas Por Data</h2>
      </header>
      <div class="w3-container">
        <form class="w3-container" method="POST" action="{{ action('VendaController@vendasPorData') }}">
          @csrf
          <label class="w3-text-black"><b>Data Venda</b></label>
          <input class="w3-input w3-border" type="date" name="data"><br>
          <input class="w3-btn w3-blue" type="submit" value="Pesquisar"><br><br>
        </form>
      </div>
      <footer class="w3-container w3-teal">
        <p><i>Mamadou</i></p>
      </footer>
    </div>
</div>