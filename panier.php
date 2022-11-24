<?php
    require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/panier.css">
</head>
<body>

    <pre>
    <?php
        print_r($_SESSION);
    ?>
    </pre>

    <!--UTILISER CE BLOCK POUR LE PANIER-->
    <div class ="section_container_bon">
        <div class = "image_container">
            <img src = "img/calculatrice.png" class = "product_image">
        </div>
        <div class = "div_du_bon">
            <p><strong>1 boites academiques</strong> a été ajoutée dans votre panier</p>
            <div>
                <div>Modifier le nombre de produit :</div>
                <span class = "bloc_nombre_de_produit">
                    <button>+</button>
                    <div><p>1</p></div>
                    <button>-</button>
                </span>
            </div>
            <button class = "finaliser_commande">Finaliser ma commande</button>
            <button class = "retirer_produit">Retirer ce produit</button>
        </div>
    </div>
</body>
</html>