<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href="css/style.css?">
</head>
<body id="body_blanc">
    <header>
        <?php
                //SUPRESSION EFFECTIVE DU COOKIE
            $etatCookie = "actif";
            if(array_key_exists("suprimerCookie", $_GET)){
                foreach ($_COOKIE as $nom => $valeur){
                    setcookie("$nom", "", time() - 3600);
                }
                $etatCookie = "supprime";
            }
            require "header.php";
        ?>
    </header>

    <main>
        <?php
        //AFFICHAGE DU MESSAGE APRES SUPRESSION DES COOKIES
            if(array_key_exists("suprimerCookie", $_GET)){
                if ($_GET['suprimerCookie'] == "yes"){
                    echo("<div id = 'panier_vide'>Vous avez retiré tous les articles présents dans votre panier</div>");
                }
                if ($_GET['suprimerCookie'] == "envoye"){
                    echo("<div id = 'commande_enregistree'>Votre commande a été enregistrée</div>");
                }
            }
        ?>
        <div id = "bloc_langues">
            <div class = "langue">
                <h2 class = "nom_langue">FRANCOPHONES</h2>
                <h3 class = "titre_classe">Maternelle</h3>
                <div class = "niveau">
                    <a href = "classe.php?classe=maternelle1EreAnnee">
                        <div class = "classe">
                            <div>Maternelle 1ere année</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=maternelle2EmeAnnee">
                        <div class = "classe">
                            <div>Maternelle 2eme année</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                </div>
                <h3 class = "titre_classe">Primaire</h3>
                <div class = "niveau">
                    <a href = "classe.php?classe=sil">
                        <div class = "classe">
                            <div>SIL</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=cp">
                        <div class = "classe">
                            <div>CP</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=ce1">
                        <div class = "classe">
                            <div>CE1</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=ce2">
                        <div class = "classe">
                            <div>CE2</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=cm1">
                        <div class = "classe">
                            <div>CM1</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=cm2">
                        <div class = "classe">
                            <div>CM2</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                </div>
                <h3 class = "titre_classe">Secondaire</h3>
                <div class = "niveau">
                    <?php
                        for($classe = 6; $classe > 2; $classe--){
                            echo("
                                <a href = 'classe.php?classe=".$classe."eme'>
                                <div class = 'classe'>
                                    <div> $classe <sup>ème</sup></div>
                                    <div>&gt;</div>
                                </div>
                                </a>
                            ");
                        }
                    ?>
                    <a href = "classe.php?classe=seconde">
                        <div class = 'classe'>
                            <div>2<sup>nd</sup></div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=premiere">
                        <div class = 'classe'>
                            <div>1<sup>er</sup></div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=terminale">
                        <div class = 'classe'>
                            <div>T<sup>le</sup></div>
                            <div>&gt;</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class = "langue">
                <h2 class = "nom_langue">ENGLISH-SPEAKER</h2>
                <h3 class = "titre_classe">Nursery school</h3>
                <div class = "niveau">
                    <a href = "classe.php?classe=nursery1">
                        <div class = 'classe'>
                            <div>Nursery one</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = "classe.php?classe=nursery2">
                        <div class = 'classe'>
                            <div>Nursery two</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                </div>
                <h3 class = "titre_classe">Primary school</h3>
                <div class = "niveau">
                    <?php
                        for($classe = 1; $classe < 7; $classe++){
                            echo("
                                <a href = 'classe.php?classe=class$classe'>
                                    <div class = 'classe'>
                                        <div> Class $classe </div>
                                        <div>&gt;</div>
                                    </div>
                                </a>
                            ");
                        }
                    ?>
                </div>
                <h3 class = "titre_classe">Secondary education</h3>
                <div class = "niveau">
                    <a href = 'classe.php?classe=from1'>
                        <div class = 'classe'>
                            <div> From 1 and 1<sup>st</sup> year</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <a href = 'classe.php?classe=from2'>
                        <div class = 'classe'>
                            <div> From 2 and 2<sup>nd</sup> year</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                    <?php
                        for($classe = 3; $classe < 6; $classe++){
                            echo("
                                <a href = 'classe.php?classe=from$classe'>
                                    <div class = 'classe'>
                                        <div> From $classe</div>
                                        <div>&gt;</div>
                                    </div>
                                </a>
                            ");
                        }
                    ?>
                    <a href = 'classe.php?classe=lowerAndUpperSixth'>
                        <div class = 'classe'>
                            <div>Lower & Upper Sixth</div>
                            <div>&gt;</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
            <a href = "panier.php">Mon panier</a>
            <a href = "test.php">Test</a>
    </main>

    <footer>
        <?php require "footer.php";?>
    </footer>
</body>
</html>