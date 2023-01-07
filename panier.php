<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
    <meta charset="UTF-8">
    <title>JEV library : Acceuil</title>
    <link rel = "stylesheet" href="css/style.css?">
    <script src = "js/main.js"></script>
</head>
<body>
    <header>
        <?php require "header.php";?>
    </header>

    <main id = "main">
        <?php
            if(empty($_COOKIE)){
                echo "<p id = 'pas_de_produit'>Vous n'avez pas de produits dans votre panier</p>";
            }
            else{
                echo("<a href = 'index.php?suprimerCookie=yes' id = 'vider_panier'>Vider mon panier</a>");
            }
            //classement des commandes par classe
            $tableauConnexion = array();
            foreach($_COOKIE as $classeId => $nombre)
            {
                //$classeId est sous la forme maternelle1EreAnnee
                $tabClassId = explode("_", $classeId);
                if(array_key_exists($tabClassId[0],$tableauConnexion)){
                    //ajout de idDansBd => nombreCommande à l'indexe (qui correspond à une classe)
                    $tableauConnexion[$tabClassId[0]][$tabClassId[1]] = $nombre;
                }
                else{
                    //creation de l'indexe (correspondant à une classe) et ajout de idDansBd => nombreCommande
                    $tableauConnexion[$tabClassId[0]] = [$tabClassId[1] => $nombre];
                }
            }
            
            foreach($tableauConnexion as $nomTable => $produits){
                echo("<h2 class = 'titre_classe' id = '$nomTable'>".$nomTable."</h2>");
                $user_name = "root";
                $db_password = "";
                try
                {
                    $tableIdProduitNombre = $tableauConnexion[$nomTable];
                    $texte = "idProduit = 0";
                    foreach($tableIdProduitNombre as $idProduit => $nombreProduit){
                        $texte = $texte." OR idProduit = ".$idProduit;
                    }
                    $DB = new PDO("mysql:host=localhost;dbname=manuelsscolaires",$user_name,$db_password);
                    $DB -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sth = $DB -> prepare("SELECT idProduit, imageProduit, nomProduit, descriptionProduit, prixProduit FROM $nomTable
                                            WHERE $texte
                                            ");//$nomTable est une variable envoyée par classe.php et correspond au nom de la table de la classe que souhaite visiter l'utilisateur
                    $sth->execute();
                    $tabProduitsAAfficher = $sth->fetchAll(PDO::FETCH_ASSOC);
                }
                catch(PDOException $e)
                {
                    $DB -> rollBack();
                    echo "problème de connexion : veuillez recharger la page et réessayer";
                }
                $DB = null;

                echo('<div class = "mainindex">');
                foreach ($tabProduitsAAfficher as $noDansTab => $caracteristiques)
                {
                    //cette fonction retourne le nombre d'un produit commandé
                    $nombreCommande = 0;
                    foreach ($produits as $idProduit => $val)
                    {
                        if($idProduit == htmlspecialchars((string)$caracteristiques['idProduit']))
                        {
                            $nombreCommande = $val;
                        }
                    }
                    //transformer tous les idproduits en nomtable_idproduit
                    $caracteristiques['idProduit'] = $nomTable."_".$caracteristiques['idProduit'];
                    echo
                    ('
                        <div class ="section_container '.
                        htmlspecialchars((string)$caracteristiques['idProduit'])
                        .' '.htmlspecialchars((string)$nomTable).'">
                            <div class = "image_container_panier">
                                <img src = "'.
                                htmlspecialchars((string)$caracteristiques['imageProduit'])
                                .'" class = "product_image"><span class = "bloc_nombre_de_produit">
                                <button onclick = "modifierNombreProduit('."'".htmlspecialchars((string)$caracteristiques['idProduit'])."'".',-1)">-</button>
                                <div><p class = "'.htmlspecialchars((string)$caracteristiques['idProduit']).'">'.$nombreCommande.'</p></div>
                                <button onclick = "modifierNombreProduit('."'".htmlspecialchars((string)$caracteristiques['idProduit'])."'".',1)">+</button>
                            </span>
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
                                    <button class="button_order" onclick="retirerProduit('."'".
                                        htmlspecialchars((string)$caracteristiques['idProduit'])
                                        ."','".htmlspecialchars((string)$nomTable)."'".')">Retirer
                                    </button>
                                </div>
                            </div>
                        </div>
                    ');
                }
                echo('</div>');
            }

            $formdisplay = "";
            //$formdisplay permet de gerer l'affichage du formulaire. si le formulaire n'est pas bien rempli, finaliserCommande.php redirigera vers cette page avec la méthode $_GET
            if(array_key_exists("nom", $_GET) || array_key_exists("contact", $_GET) || array_key_exists("lieu", $_GET)){
                $formdisplay = 'style = "display:flex;"';
            }
        ?>
        <div id = "finaliser_commande">
            <button id = "finaliser_commande_button" onclick = "afficherFormulaire()">Finaliser ma commande</button>
        </div>
        <div id = "formulaire" <?php echo($formdisplay)?>>
            <div id = "bloc_formulaire">
                <div id = "fermer_form" onclick = "fermerFormulaire()">x</div>
                <form method = "post" action = "finaliserCommande.php" name = "finaliserCommande.php" target = "_selt" autocomplete = "on">
                    <label for = "nom">Comment souhaitez-vous être appelé ?</label>
                    <input type = "text" name = "nom" id = "nom" placeholder = "Entrez votre nom">
                    <?php
                        if(array_key_exists("nom", $_GET)){
                            if($_GET["nom"] == "abscent"){
                                echo("<div class = 'erreur'>Vous devez renseigner votre nom</div>");
                            }
                            if($_GET["nom"] == "tropLong"){
                                echo("<div class = 'erreur'>Votre nom ne doit pas dépasser 30 caractères</div>");
                            }
                        }
                    ?>

                    <label for = "contact">Comment pouvons nous vous contacter ?</label>
                    <input type = "tel" name = "contact" id = "contact" placeholder = "Numero à appeler pour la livrason">
                    <?php
                        if(array_key_exists("contact", $_GET)){
                            if($_GET["contact"] == "abscent"){
                                echo("<div class = 'erreur'>Vous devez renseigner votre contact</div>");
                            }
                            if($_GET["contact"] == "mauvaiseLongeur"){
                                echo("<div class = 'erreur'>Votre contact doit comprendre 9 caractères EX: 654....98</div>");
                            }
                        }
                    ?>

                    <label for = "lieu">Où souhaitez-vous être livré ?</label>
                    <input type = "tel" name = "lieu" id = "lieu" placeholder = "Nom du carrefour le plus proche">
                    <?php
                        if(array_key_exists("lieu", $_GET)){
                            if($_GET["lieu"] == "abscent"){
                                echo("<div class = 'erreur'>Vous devez précisez le lieu de livraison</div>");
                            }
                            if($_GET["lieu"] == "tropLong"){
                                echo("<div class = 'erreur'>le nom du carrefour ne doit pas dépasser 60 caractères</div>");
                            }
                        }
                    ?>

                    <input type = "submit" value = "Envoyer ma commande">
                </form>
            </div>
        </div>
    </main>
    
    <footer>
        <?php require "footer.php";?>
    </footer>
</body>
</html>