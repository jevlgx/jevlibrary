function afficher_nav() {
    var x = document.getElementById("hamburger_list");
    if (x.style.display == "block"){
        x.style.display = "none";
    }
    else{
        x.style.display = "block";
    }
}
function bonDeCommande(noBlock) {
    var product = document.getElementsByClassName(noBlock);
    product[1].style.display = "none";//fermeture de la description

    //message 1
    var strong = document.createElement('strong');
    strong.textContent = "article ajouté au panier !";
    var p = document.createElement("p");
    p.append(strong);
    var br1 = document.createElement("br");
    var br2 = document.createElement("br");
    p.append(br1);
    p.append(br2);
    p.append(document.createTextNode("Consultez votre panier pour modifier et/ou finaliser votre commande"));
    var div1 = document.createElement("div");
    div1.append(p);
    var divDuBon = document.createElement('div');
    divDuBon.className = "div_du_bon"//divDubond prends la classe de l'élément product info à fin de garder le même formatage css
    divDuBon.append(div1);
    product[0].append(divDuBon);
}