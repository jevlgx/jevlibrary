function afficher_nav() {
    var x = document.getElementById("hamburger_list");
    if (x.style.display == "block"){
        x.style.display = "none";
    }
    else{
        x.style.display = "block";
    }
}
//mette par défaut 0 dans le bloc d'ID nombre_produits_commande
function bonDeCommande(noBlock) {
    //fermeture de la description du produit sur lequel on a cliqué
    var product = document.getElementsByClassName(noBlock);
    product[1].style.display = "none";

    //generation et pacement du message qui confirme l'ajout du produit
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
    product[0].append(divDuBon);//on va creer un cookie qui vie 1AN (unAn) avec pour nom l'id du produit sur lequel on a cliqué et une valeur par défaut (nombre de commande 1)
    
    //creation du cookie
    unAn = new Date(Date.now()+86400000*365);//86400000ms = 1jour
    unAn = unAn.toUTCString();
    document.cookie = noBlock+"=1; expires ="+unAn;

    //affichage du nouveau nombre de produits comùandé
    div_nombre_produits_commande = document.getElementById("nombre_produits_commande");
    //document.cookie.split("; ").length renvoie le nombre d'éléments du cookie et donc au nombre de commande
    div_nombre_produits_commande.textContent = document.cookie.split(" ").length;
}