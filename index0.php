<?php
    require "gestionCookiesCommande.php";
?>
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

    <main class = "mainindex">
        <?php require "main.php";?>
    </main>
    <div id = "mon_panier">
        <a href = "panier.php">Consulter mon panier</a>
    </div>

    <footer>
        <?php require "footer.php";?>
    </footer>
</body>
</html>