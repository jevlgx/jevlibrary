<!DOCTYPE html>
    <html lang="fr">
    <head>
        <?php
            echo('<meta charset="UTF-8">');
            echo('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
            function formaterNom($mot){
                if(strlen($mot) > 45){
                    $mot = substr($mot, 0, 45);
                    return $mot;
                }
                else{
                    for($i = strlen($mot); $i < 45; $i++){
                        $mot .= "-";
                    }
                    return $mot;
                }
            }

            $message = "ok";//si $message == erreur alors une des informations du formulaire est mauvaise
            $baliseMeta = '<meta http-equiv="refresh" content="0;url=panier.php?erreur=oui';
            if( !(array_key_exists("nom", $_POST)) ){
                $message = "erreur";
                $baliseMeta .= '&nom=abscent';
            }else{
                if(strlen(htmlspecialchars($_POST["nom"])) > 45){
                    $message = "erreur";
                    $baliseMeta .= '&nom=tropLong';
                }
            }
            if( !(array_key_exists("contact", $_POST)) ){
                $message = "erreur";
                $baliseMeta .= '&contact=abscent';
            }else{
                if( strlen(htmlspecialchars($_POST["contact"])) != 9 ){
                    $message = "erreur";
                    $baliseMeta .= '&contact=mauvaiseLongeur';
                }
            }
            if( !(array_key_exists("lieu", $_POST)) ){
                $message = "erreur";
                $baliseMeta .= '&lieu=abscent';
            }else{
                if( strlen(htmlspecialchars($_POST["lieu"])) > 60 ){
                    $message = "erreur";
                    $baliseMeta .= '&lieu=tropLong';
                }
            }
            

            if($message == "erreur"){
                $baliseMeta .= '">';
                echo($baliseMeta);
                //aller à nouveau au formulaire dans panier.php
            }
            else{
                //CONNEXION A LA BD ET COLLECTE DES DONNES POUR CREER LE FICHIER DE LA COMMANDE
                $commande = "";
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
                    $commande.="\n\n".strtoupper(htmlspecialchars($nomTable))."\n";
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
                        $sth = $DB -> prepare("SELECT idProduit, nomProduit, prixProduit FROM $nomTable
                                                WHERE $texte
                                                ");//$nomTable est une variable envoyée par classe.php et correspond au nom de la table de la classe que souhaite visiter l'utilisateur
                        $sth->execute();
                        $tabProduitsAAfficher = $sth->fetchAll(PDO::FETCH_ASSOC);
                    }
                    catch(PDOException $e)
                    {
                        $DB -> rollBack();
                        echo "problème de connexion : veuillez recharger la page et réessayer";
                        exit();
                    }
                    $DB = null;
    
                    foreach ($tabProduitsAAfficher as $noDansTab => $caracteristiques){
                        //cette fonction retourne le nombre d'un produit commandé
                        $nombreCommande = 0;
                        foreach ($produits as $idProduit => $val)
                        {
                            if($idProduit == htmlspecialchars((string)$caracteristiques['idProduit']))
                            {
                                $nombreCommande = $val;
                            }
                        }
                        $commande.="\n".formaterNom(strtolower(htmlspecialchars((string)$caracteristiques['nomProduit'])))." ".
                                    htmlspecialchars((string)$caracteristiques['prixProduit'])."|  ".
                                    htmlspecialchars($nombreCommande)."  |".
                                    htmlspecialchars($nombreCommande*$caracteristiques['prixProduit']);
                    }
                }
                //CREATION DU FICHIER
                try{
                    file_put_contents('commandes/'.date("d_m_y-H_i_v-").htmlspecialchars($_POST["contact"]).'.txt', 
                                    "NOM DU CLIENT          : ". htmlspecialchars($_POST["nom"]) .
                                    "\n".
                                    "CONTACT                : ". htmlspecialchars($_POST["contact"]) .
                                    "\n".
                                    "LIEU DE LIVRAISON      : ". htmlspecialchars($_POST["contact"]) .
                                    "\n".
                                    "\n".
                                    "RESUME DE LA COMMANDE". htmlspecialchars($commande)//revoir apres modifications
                    );
                }
                catch(PDOException $e){
                    alert("Une erreur est survenue : rechargez la page et réessayez");
                    exit();
                }
                echo('<meta http-equiv="refresh" content="0;url=index.php?suprimerCookie=envoye">');
            }
        ?>
        <title>finaliserCommande</title>
    </head>
    <body>
    </body>
    </html>
