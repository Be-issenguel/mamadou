<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
<style>
    body{
        background-image: url("{{ asset('images/LoginFont.jpg') }}");
    }
</style>
<body class="w3-body-login">

    <div class="w3-container">
        <br><br><br>
      
        <div id="id01" class="">
          <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        
            <div class="w3-center"><br>
              <i class="fa fa-user-shield fa-5x"></i>
            </div>
      
            <form class="w3-container" method="POST" action="{{ action('UserController@changePassword') }}">
              @csrf
              <div class="w3-section">
              <label for="psw"><b>Antiga Palavra-Passe</b></label>
                <input class="w3-input w3-border" type="password" id="psw" name="password" placeholder="Escreva a antiga palavra-passe" required>
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              <br><label for="psw"><b>Nova Palavra-Passe</b></label>
                <input class="w3-input w3-border" type="password" id="psw" name="nova_password" placeholder="Escreva a nova palavra-passe" required>
                
              <br><label for="psw"><b>Repita a Nova Palavra-Passe</b></label>
                <input class="w3-input w3-border" type="password" id="psw" name="nova_password_confirmation" placeholder="Repita a nova palavra-passe" required>
                @if ($errors->has('nova_password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nova_password') }}</strong>
                  </span>
                @endif
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Alterar</button>
              </div>
            </form>
      
          </div>
        </div>
      </div>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_examples_login by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Jan 2019 12:41:19 GMT -->
</html> 
