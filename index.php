<?php
require_once('inc/init.inc.php');

if (!isset($_SESSION['pseudo'])) { // si on a pas de speudo enregistré dans une session, c'est qu'on est pas passé par la page connexion

    header('location:connexion.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bienvenue sur le TCHAT!!</title>
        <link rel="stylesheet" href="inc/style.css">
        <script src="inc/ajax.js"></script>
    </head>
    <body>
        <div id="conteneur">
            <div id="message_tchat">
                <?php
                    echo '<h2>Connecté en tant que : ' . $_SESSION['pseudo'] . '</h2>';
                    // formuler une requete permettant de selectionner les messages de la BDD
                    $resultat = $pdo->query("SELECT d.id_dialogue, m.pseudo, m.civilite, d.message, date_format(d.date, '%d/%m/%Y') as datefr, date_format(d.date, '%H:%i:%s') as heurfr FROM dialogue d, membre m WHERE m.id_membre = d.id_membre ORDER BY d.date");

                    while($dialogue = $resultat->fetch(PDO::FETCH_ASSOC)){

                        echo '<pre>'; print_r($dialogue); echo '</pre>';
                    }
                ?>
            </div>
            <div id="liste_membre_connecte">

            </div>
            <div class="clear"></div>
            <div id="smiley">

            </div>
            <div id="formulaire_tchat">

            </div>
        </div>
    </body>
</html>
