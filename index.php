<?php
    require "gestionCookiesCommande.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    <meta charset="UTF-8">
    <title>JEV library : Acceuil</title>
    <link rel = "stylesheet" href="css/style.css?<?php echo filemtime("js/main.js");?>">
    <script src = "js/main.js?<?php echo filemtime("js/main.js");?>"></script>
</head>
<body>
    <header>
        <div id = "bare_header">
            <div>
                <a href="#home" id = "jevlibrary">JEV Library</a>
            </div>
            <div id = "bare">
                <div>
                    <a href = panier.php alt="" id = "mon_panier_header">mon panier</a>
                    <svg id = "caddie" fill="#fff" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/></svg>
                    <div id = "nombre_produits_commande">
                        <?php //afficher le nombre d'éléments dans le panier
                            echo count($_COOKIE);
                        ?></a>
                    </div>
                </div>
                <svg onclick="afficher_nav()" id ="hamburger" fill="#fff" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
            </div>
        </div>
        <nav id = "hamburger_list">
            <ul>
                <li>
                    <a href="#contact">vous avez une question ?</a><!--dans la page correspondante, dire comment se passe la livraison, qui contacter en cas de problème, prix de livraison et moyens de payement-->
                </li>
                <li>
                    <a href="#contact">Contactez nous</a>
                </li>
                <li>
                    <a href="#contact">About</a>
                </li>
            </ul>
        </nav>
    </header>

    <section>
        <!--AFFICHE LES DIFFERENTS PRODUITS-->
        <?php
            require "contenu.php";
        ?>
        <div id = "mon_panier">
        <a href = "panier.php" alt="">Consulter mon panier</a>
        </div>
        
    </section>

    <footer>
        <div id = "footer_start">
            <div id = "contact">Contactez nous :</div>
            <div><img src = "img/whatsapp.svg"></img>653219096</div>
            <div><img src = "img/envelope-fill.svg"></img>myjevfamily@gmail.com</div>
            <div><img src = "img/geo-alt-fill.svg"></img>Cameroun, Yaounde : Montée sni</div>
        </div>
        <div>
            <div>Ce site utilise les cookies pour enregistrer vos commandes</div>
            <div>Designed by jevlibrary</div>
            <div id = "information">&copy <strong>jev library</strong> since 2020</div>
        </div>
    </footer>
</body>
</html>