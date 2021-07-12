function summary(json)
{
    console.log(json);
    const summary = document.querySelector("#summary-background");
    summary.classList.remove("hidden");
    const box = document.createElement("div");
    box.id="box";
    summary.style.top = window.pageYOffset + "px";
    summary.appendChild(box);
    document.body.classList.add("no-scroll");

    const title = document.createElement("h1");
    title.textContent="Riepiologo Ordine";
    box.appendChild(title);

    const data = document.createElement("span");
    data.textContent = "Data prevista: " + json[0].data;
    box.appendChild(data);

    const ora = document.createElement("span");
    ora.textContent="Ora prevista: " + json[0].ora;
    box.appendChild(ora);

    const indirizzo = document.createElement("span");
    indirizzo.textContent="Indirizzo di consegna: " + json[0].indirizzo;
    box.appendChild(indirizzo);

    for(let y=0; y<json.length; y++)
    {
        const prodotto = document.createElement("span");
        prodotto.textContent=json[y].prodotto + " " + json[y].quantita + " x "+json[y].prezzo + "€";
        prodotto.classList.add("details-ticket");
        box.appendChild(prodotto);

    }

    const tot = document.createElement("span");
    tot.id="tot";
    tot.textContent="Totale: "+json[0].totale+"€";
    box.appendChild(tot);

    const button = document.createElement("button");
    button.id="close";
    button.textContent = "Chiudi";
    box.appendChild(button);
    button.addEventListener("click", CloseSummary);
}

function CloseSummary(event)
{
    const summary=document.querySelector("#summary-background");
    summary.classList.add("hidden");
    summary.innerHTML='';
    document.body.classList.remove("no-scroll");
}

function get_info(event)
{
    const id_ordine = event.currentTarget.dataset.idordine;
    console.log(id_ordine);
    fetch("orders/get_info/"+id_ordine).then(onResponse).then(summary);
}

function onJson(json)
{
    console.log(json);
    const table = document.querySelector("tbody");
    for(let i=0; i<json.length; i++)
    {
        const row = document.createElement("tr");
        const c1 = document.createElement("td");
        const c2 = document.createElement("td");
        const c3 = document.createElement("td");
        const c4 = document.createElement("td");
        const c5 = document.createElement("td");
        const c6 = document.createElement("td");

        c1.textContent = json[i].data;
        c2.textContent = json[i].ora;
        c3.textContent = json[i].totale;
        c4.textContent = json[i].stato;
        c6.textContent = "dettagli ordine";
        c6.classList.add("dettagli");
        c6.dataset.idordine=json[i].id;
        
        if(json[i].ora_consegna===null)
        {
            c5.textContent="";
        }
        else
        {
            c5.textContent=json[i].ora_consegna;
        }

        if(json[i].stato==="Consegnato")
        {
            row.classList.add("delivered");
        }
        else
        {
            row.classList.add("not-delivered");
        }

        table.appendChild(row);
        row.appendChild(c1);
        row.appendChild(c2);
        row.appendChild(c3);
        row.appendChild(c4);
        row.appendChild(c5);
        row.appendChild(c6);    
        
        c6.addEventListener("click", get_info);
    }
}

function onResponse(response)
{
    return response.json();
}


function FromDatabase(event)
{
    event.preventDefault();
    const tabella = document.querySelector("tbody");
    tabella.innerHTML="";
    const type = form.type.value;
    fetch("hw2/public/orders/type/"+type).then(onResponse).then(onJson);
}

const form = document.querySelector("form");
form.addEventListener("submit", FromDatabase);


function NoMenu(event)
{
    const m=event.currentTarget;
    m.classList.add("hidden");
    m.innerHTML="";
}
document.querySelector("#mm").addEventListener("click", NoMenu);



function Menu()
{
    const sfondo=document.querySelector("#mm");
    sfondo.classList.remove("hidden");

    const m=document.createElement("div");
    m.id="mobile-links";
    m.style.top = window.pageYOffset + "px";
    sfondo.appendChild(m);

    const link1=document.createElement("a");
    const link2=document.createElement("a");
    const link3=document.createElement("a");
    const link4=document.createElement("a");
    const link5=document.createElement("a");
    const link6=document.createElement("a");

    
    link1.textContent="Home";
    link1.href='home';
    link2.textContent="Ricette";
    link2.href='recipes';
    link3.textContent="Foto";
    link3.href='foto';
    link4.textContent="Ordini";
    link4.href='orders';
    link5.textContent="Scopri";
    link5.href='ingredients';
    link6.textContent="Logout";
    link6.href='logout';

    link1.classList.add("links-m");
    link2.classList.add("links-m");
    link3.classList.add("links-m");
    link4.classList.add("links-m");
    link5.classList.add("links-m");
    link6.classList.add("links-m");

    m.appendChild(link1);
    m.appendChild(link2);
    m.appendChild(link3);
    m.appendChild(link4);
    m.appendChild(link5);
    m.appendChild(link6);
}

const menu_mobile = document.querySelector("#menu-mobile");
menu_mobile.addEventListener("click", Menu);