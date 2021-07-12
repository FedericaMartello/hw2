<!DOCTYPE html>
<html>
    <head>
        <title>Food Delivery - Login</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">                          
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">


        <link rel="stylesheet" href='{{ url("css/login.css") }}'>


        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <div id='login'>
                <img id='logo' src="https://img.apkappsdownload.co/v2/image1/Y29tLm11ZnVtYm8uYW5kcm9pZC5yZWNpcGUuc2VhcmNoX2ljb25fMTU1NzMxMTU1MV8wMjQ/icon.png?w=170&fakeurl=1" />
                
                <h1>Food Delivery</h1>

                @if(isset($old_username))
                <span class='errore'>Credenziali non valide</span>
                @endif

                <form name='credenziali' method='POST'>
                    <input type='hidden' name='_token' value='{{ $csrf_token }}'>
                    <p>
                        <label>Username<input type='text' placeholder="example@email.com" name='username' value='{{ $old_username }}'></label>
                    </p>
                    <p>
                        <label>Password<input type='password' placeholder="yourpassword" name='password'></label>
                    </p>
                    <p>
                        <label>&nbsp;<input type="submit" value='Accedi' id='button'></label>
                    </p>
                </form>
                <a id="sign-up" href='{{ url("signup") }}'>Non hai ancora un account? Iscriviti</a>
            </div>
        </header>

        <footer>
            <div class="info">
                <span>Prodotti forniti da <br/>
                  <strong>Ristorante da Mario</strong>
                  <address>Via del Mare, 45, Catania.</address></span>
            </div>
  
              <div class="info">
                  <h1>Federica Martello <br/>O46002249
                  </h1>
              </div>
  
          <div class="info">
              <p><strong>Orari:</strong><br/>
              Lun-Dom: 10:00-23:00</p>
  
              <p><strong>Attenzione:</strong><br>
              possibili variazioni di orario in seguito ad emergenza COVID-19.<br/>
              </p>
          </div>        
          
          <div id="footer-mobile">
              <div class="f-m"> <a>Info</a> </div>
              <div class="f-m"> <h1>Federica Martello <br/>O46002249</h1> </div>
              <div class="f-m"> <a>Orari - Avvisi</a> </div>
          </div>
          </footer>

    </body>
</html>