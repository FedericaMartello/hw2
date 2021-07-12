<!DOCTYPE html>
<html>
    <head>
        <title>Food Delivery - Ordini</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">    
        <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">

        <link rel="stylesheet" href='{{ url("css/ordini.css") }}'>
        <script src='{{ url("js/ordini.js") }}' defer="true"></script>
        

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
            <nav>
                <div id="logo">
                    <img src="https://img.apkappsdownload.co/v2/image1/Y29tLm11ZnVtYm8uYW5kcm9pZC5yZWNpcGUuc2VhcmNoX2ljb25fMTU1NzMxMTU1MV8wMjQ/icon.png?w=170&fakeurl=1" />
                </div>
                <div id="menu">
                    <a href='{{ url("home") }}'>Home</a> <a href='{{ url("recipes")  }}'>Ricette</a> <a href='{{ url("foto") }}'>Foto</a> <a href='{{ url("orders") }}'>Ordini</a>
                    <a href='{{ url("ingredients") }}'>Scopri</a> <a href='{{ url("logout") }}'>Logout</a>  
                </div>
                <div id="menu-mobile">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div id="mm" class="hidden"></div>
            </nav>

                <h1>I Tuoi Ordini </h1>                
        </header>

        <article>

            <section id="summary-background" class="hidden">
            </section>

            <form>
            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <select name='type'>
                    <option value='all'>Tutti gli ordini</option>
                    <option value='delivered'>Consegnato</option>
                    <option value='delivering'>In consegna</option>
                    <input id='submit' type='submit' value='Cerca'>  
                </select>
            </form>

            <table>
                <thead>
                    <tr><th>Data Prevista</th><th>Ora Prevista</th><th>Totale</th><th>Stato</th><th>Ora consegna</th><th>Info</th></tr>
                </thead>

                <tbody>
                </tbody>

            </table>

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
              Lun-Ven: 10:00-23:00<br/>
              Sab-Dom: 16:00-23:00<br/></p>
  
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