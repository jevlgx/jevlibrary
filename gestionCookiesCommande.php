<?php

$produitsARetirer = "idProduit = 0";
if(empty($_COOKIE)){}//si le cookie est vide, l'idProduit = 0 n'existant pas, tous les produits seront renvoyés par la bd
else
{
    foreach ($_COOKIE as $idProduitsCommandes => $nombreDeCommande)
    {
        $produitsARetirer = $produitsARetirer." OR idProduit = $idProduitsCommandes";
    }
}

$user_name = "root";
$db_password = "";
try
{
    $DB = new PDO("mysql:host=localhost;dbname=produits",$user_name,$db_password);
    $DB -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $DB -> prepare("SELECT idProduit, imageProduit, nomProduit, descriptionProduit, prixProduit FROM users
                            WHERE NOT ($produitsARetirer)
                            ");
    $sth->execute();
    $produitsAAfficher = $sth->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
    echo "bonjokljour".$e->getMessage();
    $DB -> rollBack();
    echo "problème de connexion à la base de donnée : veuillez recharger la page et réessayer";
}
$DB = null;
?>