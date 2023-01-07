<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    <meta charset="UTF-8">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <title>JEV library : Acceuil</title>
    <script src = "js/actualiserPage.js"></script>
    <link rel = "stylesheet" href="css/style.css?">
</head>
<body>
    <header>
        <?php require "header.php";?>
    </header>

    <main>
        
        <?php
            echo('<div class = "mainindex">');
            $nomTable = $_GET["classe"];
            require "produitsAAfficher.php";
            echo("</div>");
            if($livresCommandes == array()){
                echo("<h4 class = 'invisible' id = 'dans_panier'>Les produits suivants de cette catégorie sont déjà dans votre panier</h4>");
            }
            else{
                if(count($produitsAAfficher) == 0){
                    echo("<h4>Tous les articles de cette classe sont déjà dans votre panier</h4>");
                }
                else{
                    echo("<h4 id = 'dans_panier'>Les produits suivants sont déjà dans votre panier</h4>");
                }
            }
            echo("<div id ='zone_produits'>");
            foreach ($livresCommandes as $noDansTab => $caracteristiques)
            {
                echo
                    ('<div class = "careElement"><span>'.
                    htmlspecialchars($caracteristiques['nomProduit']).
                        '</span>'.
                        '<svg class = "checksvg" viewBox="0 0 16 16">
                            <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                            <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                        </svg>'.
                    '</div>');
            }
            echo("</div>");
        ?>

    </main>
    <div id = "mon_panier">
        <a href = "panier.php">Consulter mon panier</a>
    </div>

    <footer>
        <?php require "footer.php";?>
    </footer>
    <script src = "js/main.js"></script>
</body>
</html>