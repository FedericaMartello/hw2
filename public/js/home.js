function FromDatabase()
{
fetch("feed/").then(onResponse).then(ShowProducts);
}

FromDatabase();

function onResponse(response)
{
    return response.json();
}

function ShowProducts(json)
{
    console.log(json);
    const mb = document.querySelector('#main_block');
    for(let i=0; i<json.length; i++)
    {
        const box = document.createElement('div');
        const foto = document.createElement("img");
        const nome = document.createElement("span");
        const prezzo = document.createElement("span");
        const description = document.createElement("span");
        const more = document.createElement("span");
        const cart = document.createElement("img");

        box.dataset.idprodottoadd=json[i].id;
        foto.src = json[i].foto;
        nome.textContent = json[i].nome;
        prezzo.textContent = json[i].prezzo+'€';
        description.textContent = json[i].descrizione;
        more.textContent = 'Dettagli';
        cart.src = 'foto_progetto/add-to-cart.png';

        box.classList.add("contenitore_prodotto");
        foto.classList.add("foto_prodotto");
        nome.classList.add("nome_prodotto");
        prezzo.classList.add("prices");
        description.classList.add('hidden');
        more.classList.add('showmore');
        cart.classList.add("add-to-cart");


        mb.appendChild(box);
        box.appendChild(foto);
        box.appendChild(nome);
        box.appendChild(prezzo);
        box.appendChild(description);
        box.appendChild(more);
        box.appendChild(cart);

        more.addEventListener('click', ShowDescription);
        cart.addEventListener('click',AddToCart);
    }
}

//Funzione Mostra dettagli
function ShowDescription(event)
{
    event.currentTarget.textContent="Mostra Meno";    
    let paragrafo=event.currentTarget.parentNode.querySelector('span.hidden');
    paragrafo.classList.remove('hidden');
    paragrafo.classList.add('descrizione');
    
    event.currentTarget.removeEventListener("click", ShowDescription);
    event.currentTarget.addEventListener("click", ShowLess);
    
}

//Funzione Nascondi dettagli
    
function ShowLess(event)
{
    event.currentTarget.textContent='Dettagli';
    let box=event.currentTarget.parentNode;
    let paragrafo=box.firstChild.nextSibling.nextSibling.nextSibling;
    paragrafo.classList.add('hidden');
    paragrafo.classList.remove('descrizione');
    
    event.currentTarget.removeEventListener("click", ShowLess);
    event.currentTarget.addEventListener("click", ShowDescription);
}


// Funzione aggiungi al carrello 
const nel_carrello = [];
function AddToCart(event)
{
    const clicked_cart = event.currentTarget;
    const product_in_cart = clicked_cart.parentNode;
    const id = product_in_cart.dataset.idprodottoadd;
    const products = document.querySelectorAll(".contenitore_prodotto");

    nel_carrello.push(id);
    
    for(let bought of products)
    {    
        if(bought.dataset.idprodottoadd === id)
        {
            const blocco_carrello = document.querySelector('#in-the-cart');
                           
            const cart_div = document.createElement('div');
            cart_div.dataset.idprodottoadd=id;
            const foto=document.createElement('img');
            const nome_prodotto=document.createElement('span');
            const rimuovi=document.createElement('img');
            const price = document.createElement('span');
            const label = document.createElement('label');
            label.textContent="Quantità: ";
            const quantity=document.createElement('input');
            quantity.type="number";
            quantity.value=1;
            quantity.min=1;
            quantity.max=10;

            blocco_carrello.appendChild(cart_div); 
            cart_div.appendChild(foto);
            cart_div.appendChild(nome_prodotto);
            cart_div.appendChild(price);
            cart_div.appendChild(label);  
            label.appendChild(quantity);
            cart_div.appendChild(rimuovi);
        
            cart_div.classList.add('contenitore_carrello');
            foto.classList.add('foto_prodotto');
            nome_prodotto.classList.add('nome_prodotto');
            rimuovi.classList.add('remove-from-cart');
            quantity.classList.add('quantity');
            price.classList.add("prices");

            foto.src=bought.querySelector('.foto_prodotto').src;
            nome_prodotto.textContent=bought.querySelector('.nome_prodotto').textContent;
            price.textContent=bought.querySelector(".prices").textContent;
            rimuovi.src='foto_progetto/rimuovi.png';

            rimuovi.addEventListener("click", Rimuovi);
        }
    } 

    clicked_cart.removeEventListener("click", AddToCart);
}

//Funzione rimuovi   
function Rimuovi(event)
{
    const selected_product = event.currentTarget.parentNode;
    const id = selected_product.dataset.idprodottoadd;
    selected_product.remove();
    event.currentTarget.removeEventListener("click", Rimuovi);

    for( let i = 0; i < nel_carrello.length; i++){ 
        if ( nel_carrello[i] === id) {
          nel_carrello.splice(i, 1); 
        }
    }

    const products = document.querySelectorAll(".contenitore_prodotto");
    for(let bought of products)
    {
        if(bought.dataset.idprodottoadd === id)
        {
            const cart = bought.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling;
            cart.addEventListener("click", AddToCart);
        }
    }

}

function CreateOrder(event)
{
    event.preventDefault();
    const form = document.querySelector("form");

    
    const data_input= form.d;
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    data_input.min=today;
    const data = form.d.value;
    
    const ora_input=form.t;
    const min="11:00:00";
    const max="23:00:00";
    ora_input.min=min;
    ora_input.max=max;
    const ora = form.t.value;

    if(data<today || (ora<min || ora>max))
    {
        alert("La data e/o l'ora selezionata non è valida. Si prega di selezionare una data futura e un'ora compresa tra le 11:00 e le 23:00.");
    }
    else{
        if(nel_carrello.length>0)
        {
            fetch("home/data/"+data+"/ora/"+ora).then(onResponse).then(complete_order).then(confirm);
        }
        else if(nel_carrello.length==0)
        {
            console.log("Selezionare almeno un prodotto");
        }
    }

}

const button = document.querySelector("#buy");
button.addEventListener("click", CreateOrder);


let order_id;
function complete_order(json)
{
    const id_ordine = json;
    
    if(id_ordine!=="null")
    {
        const input = document.querySelectorAll(".contenitore_carrello input");

        for(let i=0; i<nel_carrello.length; i++)
        {
            for(let j=0; j<input.length; j++)
            {
                if(nel_carrello[i] === input[j].parentNode.parentNode.dataset.idprodottoadd)
                {
                    fetch("home/ordine/"+id_ordine+"/prodotto/"+nel_carrello[i]+"/quantita/"+input[j].value);
                    order_id=id_ordine;
                }
            }
        }
    }
}


function confirm()
{
    const background = document.querySelector("#background.hidden");
    background.classList.remove("hidden");
    const content = document.createElement("div");
    content.id="content";
    content.style.top = window.pageYOffset + "px";
    background.appendChild(content);
    document.body.classList.add("no-scroll");

    const avviso = document.createElement("h1");
    avviso.textContent="Il tuo ordine è stato confermato!";
    content.appendChild(avviso);

    const gif = document.createElement("img");
    gif.src="https://cdn.dribbble.com/users/1447046/screenshots/7813949/media/2e5dcde12e9e661e3931ad3caf77affb.gif";
    content.appendChild(gif);

    const cancel = document.createElement('button');
    cancel.id="delete";
    cancel.textContent="Annulla l'ordine";
    content.appendChild(cancel);
    cancel.addEventListener("click", delete_order);

    const close = document.createElement("button");
    close.textContent="Chiudi";
    close.id="close";
    content.appendChild(close);
    close.addEventListener("click", close_confirm_order);
}


function delete_order(event){
    fetch("delete/ordine/"+order_id);
    const content = event.currentTarget.parentNode;
    content.innerHTML="";

    const avviso = document.createElement("h1");
    avviso.textContent="Ordine annullato";
    content.appendChild(avviso);

    const close = document.createElement("button");
    close.textContent="Chiudi";
    close.id="close";
    content.appendChild(close);
    close.addEventListener("click", close_confirm_order);
}


function close_confirm_order()
{
    const background=document.querySelector("#background");
    background.classList.add("hidden");
    background.innerHTML='';
    document.body.classList.remove("no-scroll");

    const carrello = document.querySelector("#in-the-cart");
    carrello.innerHTML="";

    const form = document.querySelector("form");
    form.d.value="";
    form.t.value="";

    const products = document.querySelectorAll(".contenitore_prodotto");
    for(let bought of products)
    {
        const cart = bought.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling;
        cart.addEventListener("click", AddToCart);
    }

}

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