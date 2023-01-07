<?php
//RECHERCHE DES PRODUITS A AFFICHER
$produitsARetirer = "idProduit = 0";
if(empty($_COOKIE)){}//si le cookie est vide, l'idProduit = 0 n'existant pas, tous les produits seront renvoyés par la bd
else
{
    foreach ($_COOKIE as $idProduitsCommandes => $nombreDeCommande)
    {
        //idProduitsCommandes est sous la forme nomtable_idproduit. 
        $tab = explode("_", $idProduitsCommandes);
        if($tab[0] == $nomTable)
        {
            $produitsARetirer = $produitsARetirer." OR idProduit = $tab[1]";
        }
    }
}
//$produitsARetirer contient tous les produits déjà présents dans le cookies

$user_name = "root";
$db_password = "";
try
{
    $DB = new PDO("mysql:host=localhost;dbname=manuelsscolaires",$user_name,$db_password);
    $DB -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $DB -> prepare("SELECT idProduit, imageProduit, nomProduit, descriptionProduit, prixProduit FROM $nomTable
                            WHERE NOT ($produitsARetirer)
                            ");//$nomTable est une variable envoyée par classe.php et correspond au nom de la table de la classe que souhaite visiter l'utilisateur
    $sth->execute();
    $produitsAAfficher = $sth->fetchAll(PDO::FETCH_ASSOC);

    $sth2 = $DB -> prepare("SELECT nomProduit, prixProduit FROM $nomTable
                            WHERE $produitsARetirer
                            ");//$nomTable est une variable envoyée par classe.php et correspond au nom de la table de la classe que souhaite visiter l'utilisateur
    $sth2->execute();
    $livresCommandes = $sth2->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
    $DB -> rollBack();
    echo "problème de connexion : veuillez recharger la page et réessayer";
}
$DB = null;

//AFFICHAGE DES PRODUITS A AFFICHER (contenus dans $produitsAAfficher)

foreach ($produitsAAfficher as $noDansTab => $caracteristiques)
{
    //transformer tous les idproduits en nomtable_idproduit
    $caracteristiques['idProduit'] = $nomTable."_".$caracteristiques['idProduit'];
    echo
    ('
        <div class ="section_container '.
        htmlspecialchars((string)$caracteristiques['idProduit'])
        .'">
            <div class = "image_container">
                <img src = "'.
                htmlspecialchars((string)$caracteristiques['imageProduit'])
                .'" class = "product_image">
            </div>
            <div class = "product_info '.
            htmlspecialchars((string)$caracteristiques['idProduit'])
            .'">
                <div class = "product_title item_product_info"><strong>'.
                htmlspecialchars((string)$caracteristiques['nomProduit'])
                .'</strong></div>
                <div class = "product_subtitle item_product_info">'.
                htmlspecialchars((string)$caracteristiques['descriptionProduit'])
                .'</div>
                <div class = "price item_product_info">'.
                htmlspecialchars((int)$caracteristiques['prixProduit'])
                .'<sup class = "fcfa">FCFA</sup></div>
                <div class = "button_order_container">
                    <button class="button_order" onclick="ajoutProduit('."'".
                        htmlspecialchars((string)$caracteristiques['idProduit'])
                        ."','".htmlspecialchars((string)$caracteristiques['nomProduit'])."'".')">Commander
                    </button>
                </div>
            </div>
        </div>
    ');
    echo
    ('<div class = "'.'invisible careElement '.htmlspecialchars((string)$caracteristiques['idProduit']).'"><span>'.
    htmlspecialchars($caracteristiques['nomProduit'])
    .
        '</span>'.
        '<svg class = "checksvg" viewBox="0 0 16 16">
            <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
            <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
        </svg>'.
    '</div>');
}
?>