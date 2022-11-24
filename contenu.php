<?php
//$produitsAAfficher est un tableau contenant les produits à afficher dans la partie sur la page
//ces produits sont fournis par la fonction gestionCookiesCommande
$contenu = [];

function shuffle_extra($array)
{
    if(!is_array($array)){return array();}
    shuffle($array);
    return $array;
}
$produitsAAfficher = shuffle_extra($produitsAAfficher);
foreach ($produitsAAfficher as $noDansTab => $caracteristiques)
{
    echo
    ('
        <div class ="section_container '.
        htmlspecialchars((string)$caracteristiques['idProduit'])
        .'">
            <div class = "image_container">
                <img src = "'.
                htmlspecialchars($caracteristiques['imageProduit'])
                .'" class = "product_image">
            </div>
            <div class = "product_info '.
            htmlspecialchars((string)$caracteristiques['idProduit'])
            .'">
                <div class = "product_title item_product_info"><strong>'.
                htmlspecialchars($caracteristiques['nomProduit'])
                .'</strong></div>
                <div class = "product_subtitle item_product_info">'.
                htmlspecialchars($caracteristiques['descriptionProduit'])
                .'</div>
                <div class = "price item_product_info">'.
                htmlspecialchars((int)$caracteristiques['prixProduit'])
                .'<sup class = "fcfa">FCFA</sup></div>
                <div class = "button_order_container">
                    <button class="button_order">
                        <a onclick="bonDeCommande('.
                        htmlspecialchars((string)$caracteristiques['idProduit'])
                        .')">Commander</a>
                    </button>
                </div>
            </div>
        </div>
    ');
}
?>