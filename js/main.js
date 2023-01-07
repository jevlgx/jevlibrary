tab = document.getElementsByClassName('section_container');
nombreProduitsAffiche = tab.length;


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
function ajoutProduit(idProduit) {
    //fermeture de la description du produit sur lequel on a cliqué
    var product = document.getElementsByClassName(idProduit);
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
    
    //affichage de la liste des produits déjà dans le panier
    var dansPanier = document.getElementById("dans_panier");
    dansPanier.style.display = "block";
    //generation et placement du produit dans la liste des produits de la catégorie déjà dans le panier
    var zoneProduit = document.getElementById("zone_produits");
    product[2].style.display = "grid";
    zoneProduit.append(product[2]);

    //creation du cookie
    let unAn = new Date(Date.now()+86400000*365);//86400000ms = 1jour
    unAn = unAn.toUTCString();
    document.cookie = idProduit+"=1; expires="+unAn;
    //affichage du nouveau nombre de produits commandés
    afficherNombreProduit(1);

    nombreProduitsAffiche -= 1;
    if(nombreProduitsAffiche == 0){
        toutAchete();
    }
}

function toutAchete()
{
    h = document.getElementById('dans_panier');
    h.textContent = "Tous les articles de cette classe sont déjà dans votre panier";
}

function retirerProduit(idBlock,nomTable)
{
    var produit = document.getElementsByClassName(idBlock);
    produit[0].remove();
    //conservation du nombre de produits pour reduire le nombre de produits affiché dans le panier
    var nombreProduit = parseInt(getCookie(idBlock));

    //supression du produit
    let unAn = new Date(Date.now()-3600);
    unAn = unAn.toUTCString();
    document.cookie = idBlock+'=; expires='+unAn;

    //affichage du nouveau nombre de produits commandé
    if(document.cookie == ""){
        afficherNombreProduit(0);
        afficherPlusDeProduits();
    }
    else{
        afficherNombreProduit((-1)*nombreProduit);
    }
    GestionTitre(nomTable);
}

function afficherNombreProduit(nombre)
{
    var blocNombreProduit = document.getElementById("nombre_produits_commande");
    if(nombre == 0){
        blocNombreProduit.textContent = "0";
    }
    else{
        blocNombreProduit.textContent = (parseInt(blocNombreProduit.textContent) + nombre).toString();
    }
}

function afficherPlusDeProduits()
{
    //affichage du paragraphe "Vous n'avez plus de produits dans votre panier"
    var p = document.createElement("p");
    p.className = "pas_de_produit";
    p.textContent = "Vous n'avez plus de produits dans votre panier";
    var main= document.getElementById("main");
    main.append(p);
    var a = document.getElementById("vider_panier");
    a.style.display = "none";
    var envoyer = document.getElementById("envoyer");
    envoyer.style.display = "none";
}

function GestionTitre(nomTable)
{
    //GESTION DE LA DISPARITION DU TITRE <h2> DE LA CATEGORIE
    var produitsDeLaTable= document.getElementsByClassName(nomTable);
    if(produitsDeLaTable.length == 0)//tous les éléments de la produitsDeLaTable ont été retirés du DOM
    {
        var titre = document.getElementById(nomTable);
        titre.style.display = "none";
    }
}

function modifierNombreProduit(idBlock, nombre)
{
    var nombreProduit = parseInt(getCookie(idBlock));
    if((nombreProduit == 1) && (nombre == -1))
    {
        //suppression du produit
        var produit = document.getElementsByClassName(idBlock);
        produit[0].remove();
        let unAn = new Date(Date.now()-3600);
        unAn = unAn.toUTCString();
        document.cookie = idBlock+'=; expires='+unAn;
        afficherNombreProduit(-1);
    }
    else{
        var unAn = new Date(Date.now()+86400000*365);//86400000ms = 1jour
        unAn = unAn.toUTCString();
        if(nombre == 1)
        {
            nombreProduit += 1;
            document.cookie = idBlock+'='+nombreProduit+'; expires='+unAn;
            var produit = document.getElementsByClassName(idBlock);
            produit[1].textContent = nombreProduit.toString();

            afficherNombreProduit(1);
        }
        if(nombre == -1)
        {
            nombreProduit -= 1;
            document.cookie = idBlock+'='+nombreProduit+'; expires='+unAn;
            var produit = document.getElementsByClassName(idBlock);
            produit[1].textContent = nombreProduit.toString();

            afficherNombreProduit(-1);
        }
    }
    var nomTable = idBlock.split("_");
    //afficher le nombre de produits
    if(document.cookie == ""){
        afficherNombreProduit(0);
        afficherPlusDeProduits();
    }
    GestionTitre(nomTable[0]);
}

function getCookie(name){
    if(document.cookie.length == 0)
      return null;

    var regSepCookie = new RegExp('(; )', 'g');
    var cookies = document.cookie.split(regSepCookie);

    for(var i = 0; i < cookies.length; i++){
      var regInfo = new RegExp('=', 'g');
      var infos = cookies[i].split(regInfo);
      if(infos[0] == name){
        return unescape(infos[1]);
      }
    }
    return null;
}

function afficherFormulaire(){
    var x = document.getElementById("formulaire");
    x.style.display = "flex";
}

function fermerFormulaire(){
    var x = document.getElementById("formulaire");
    x.style.display = "none";
}

function supprimerElement(idBlock)
{
    /*var produit = document.getElementsByClassName(idBlock);
    produit[0].style.display = "none";
    var sansId = document.cookie.split(idBlock + "=");
    var nouveauCookie="";
    alert(document.cookie);
    alert(idBlock);
    if(document.cookie.indexOf(";") == -1)//alors le cookie ne contient qu'un élément
    {
        nouveauCookie = "";
    }
    else//avec juste un élément, sansId[0] = ""
    {
        if(sansId[0] == "")//alors l'ID produit était en 1ere position
        {
            alert ("id en première position");
            avecNombre = sansId[1].split("; ");//retirer le nombre de produit (du produit à supprimer) qui se trouves en début du bloc de droite sansId[1]
            for(i = 1; i < (avecNombre.length - 1); i++)//en partant de i = 1, on supprime avecNombre[0] qui contient le nombre
            {
                nouveauCookie = nouveauCookie + avecNombre[i] + "; ";
            }
            nouveauCookie += avecNombre[avecNombre.length - 1];
            alert("affichage nouveau cookie");
            alert(nouveauCookie);
        }
        if (sansId[1].indexOf(";") == -1)//l'élement à retirer est le dernier dans le cookies
        {
            alert("id en dernière position");
            sansNombre = sansId[0].split("; ");
            for(i = 0; i < (sansNombre.length - 2); i++)//on part jusqu'à sansId.length -3
            {
                nouveauCookie = nouveauCookie + sansNombre[i] + "; ";
            }
            nouveauCookie += sansNombre[sansNombre.length - 2];
            alert("affichage nouveau cookie");
            alert(nouveauCookie);
        }
        if( (sansId[0] !== "") && (sansId[1].indexOf(";") !== -1) )//l'éméùent est au milieu
        {
            alert("id au milieu");
            avecNombre = sansId[1].split("; ");
            for(i = 1; i < (avecNombre.length - 1); i++)//en partant de i = 1, on supprime avecNombre[0] qui contient le nombre
            {
                nouveauCookie = nouveauCookie + avecNombre[i] + "; ";
            }
            nouveauCookie += avecNombre[avecNombre.length - 1];//ici nouveau cookie ne comprends que l'élement de droite de sansID
            nouveauCookie = sansId[0] + nouveauCookie;//sansId[0] se termine par un "; "
            alert("affichage nouveau cookie");
            alert(nouveauCookie);
        }
    }*/
    //MODIFICATION EFFECTIVE DU COOKIE
    var produit = document.getElementsByClassName(idBlock);
    produit[0].style.display = "none";
    let unAn = new Date(Date.now()-3600);
    unAn = unAn.toUTCString();
    document.cookie = idBlock+'=; expires='+unAn;
    //affichage du nouveau nombre de produits comùandé
    div_nombre_produits_commande = document.getElementById("nombre_produits_commande");
    div_nombre_produits_commande.textContent = document.cookie.split(" ").length;
}