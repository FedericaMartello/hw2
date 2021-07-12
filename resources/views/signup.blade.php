<!DOCTYPE html>
<html>
    <head>
        <title>Food Delivery - Sign up</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">                                
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">


        <link rel="stylesheet" href='{{ url("css\signup.css") }}'>
        <script src='{{ url("js\signup.js") }}' defer></script>


        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <nav>
                <div id="logo">
                <img src="https://img.apkappsdownload.co/v2/image1/Y29tLm11ZnVtYm8uYW5kcm9pZC5yZWNpcGUuc2VhcmNoX2ljb25fMTU1NzMxMTU1MV8wMjQ/icon.png?w=170&fakeurl=1" />
                <h1>Food Delivery</h1>
                </div>
                
                <a href='{{ url("login") }}'>Hai un account? Accedi</a>
            </nav>
        </header>

        <article>
            <section id="user-dates">
                <form name='sign-up' method='POST'>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <p>
                            <label>Nome<input type='text' id="name" placeholder="Nome Cognome" name='name'>
                        </label>
                        </p>
                        <p>
                            <label>Indirizzo<input type='text' id="indirizzo" placeholder="Via..." name='indirizzo'></label>
                        </p>
                        <p>
                            <label>Telefono<input type='text' id="tel" placeholder="+39" name='tel'></label>
                        </p>
                        <p>
                            <label>Username<input type='text' id="username" placeholder="yourUsername" name='username'></label>
                            <p id=error-username class="hidden"> Username già in uso</p>
                        </p>
                        <p>
                            <label>Password<input type='text' id="password" placeholder="yourpassword" name='password'></label>
                            <p id=error-password class="hidden"> Deve contenere un carattere minuscolo, <br> un carattere maiuscolo,
                            un numero, <br> un carattere speciale ( _ , % , @ , ? ). </p>
                        </p>
                        <p>
                            <label>Ripeti password<input type='text' id="test" placeholder="yourpassword" name='test_password'></label>
                            <p id=error-password2 class="hidden"> Le password non coincidono </p>
                        </p>
                        <p>
                            <label>&nbsp;<input type="submit" value='Registrati' id='button'></label>
                        </p>
                    </form>
            </section>
        </article>

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
              Lun-Dom: 11:00-23:00</p>
  
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