<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
              <img src="{{ asset('images/img_avatar3.png') }}" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
            </div>
      
            <form class="w3-container" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="w3-section">
              <label for="email"><b>{{ __('E-mail') }}</b></label>
                <input class="w3-input w3-border w3-margin-bottom" name="email" type="email" id="email" value="{{ old('email') }}" placeholder="Escreva o seu e-mail"  required >
                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
                <br><label for="psw"><b>Password</b></label>
                <input class="w3-input w3-border" type="password" id="psw" name="password" placeholder="Escreva a palavra-passe" required>
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
              </div>
            </form>
      
          </div>
        </div>
      </div>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_examples_login by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 16 Jan 2019 12:41:19 GMT -->
</html> 
