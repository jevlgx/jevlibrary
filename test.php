<?php

print_r("<pre>");
print_r($_COOKIE);
print_r("</pre>");

var_dump($_COOKIE);

/*$user_name = "root";
$db_password = "";
try
{
    $DB = new PDO("mysql:host=localhost;dbname=produits",$user_name,$db_password);//creation d'une nouvelle connexion
    //on définit le mode d'erreur de PDO sur EXCEPTION
    $DB -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //permet de garder la transaction active jusqu'à l'optention de commit()
    //debut des requettes SQL

    $sth = $DB -> prepare("SELECT idProduit, imageProduit, nomProduit, descriptionProduit, prixProduit FROM users");
    $sth->execute();
    $produitsAAfficher = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($produitsAAfficher);
    echo "</pre>";
    //fin des requettes SQL
    echo "connexion reussie";
}
catch(PDOException $e)
{
    echo "bonjokljour".$e->getMessage();
    $DB -> rollBack();
    echo "problème de connexion à la base de donnée : veuillez recharger la page et réessayer";
}
$DB = null;*/
?>