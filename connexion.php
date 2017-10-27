<?php
require_once("inc/init.inc.php");
if (isset($_POST['connexion'])) { // si on click sur connexion

    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
    $membre = $resultat->fetch(PDO::FETCH_ASSOC);

    echo '<pre>'; print_r($_SERVER); echo '</pre>';

    if ($resultat->rowCount() == 0) {
        $pdo->exec("INSERT INTO membre (pseudo, civilite, ville, date_de_naissance, ip, date_connexion) VALUES ('$_POST[pseudo]', '$_POST[civilite]', '$_POST[ville]', '$_POST[date_de_naissance]', '$_SERVER[REMOTE_ADDR]'," . time() ." ) ");

        $id_membre = $pdo->lastInsertId();
        // echo $id_membre;
    }elseif($resultat->rowCount() > 0 && $membre['ip'] == $_SERVER['REMOTE_ADDR']){ // sinon si, le pseudo est connu et que l'internaute est le propriétaire du pseudo
        $pdo->exec("UPDATE membre SET date_connexion=" . time() . " WHERE id_membre=$membre[id_membre]");
        $id_membre = $membre['id_membre'];
    }else{
        $msg .= '<div class="erreur">Ce pseudo a déjà été réservé</div>';
    }
    if(empty($msg)){
        $_SESSION['id_membre'] = $id_membre;
        $_SESSION['civilite'] = $_POST['civilite'];
        $_SESSION['pseudo'] = $_POST['pseudo'];
        header('location.index.php');
    }
}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="inc/style.css">
        <?php echo $msg ?>
    </head>
    <body>

<fieldset>
    <legend>Inscription / Connexion</legend>
    <form action="" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" value=""><br><br>

        <label for="civilite">Civilité</label>
        <select name="civilite">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
        </select><br><br>

        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" value=""><br><br>

        <label for="date_de_naissance">Date de naissance</label>
        <input type="date" id="date_de_naissance" name="date_de_naissance" value=""><br><br>

        <input type="submit" name="connexion" value="Connexion au tchat!">
    </form>
</fieldset>

</body>
</html>
