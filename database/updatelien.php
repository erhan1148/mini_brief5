<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
    <title>Modifier Liens</title>
</head>
<body>

<form method="POST" action="updatelien.php">
    <div class="form-group">
        <label for="lien_id">Saisissez l'ID du lien à Modifier:</label>
        <input type="text" name="lien_id" id="lien_id" required="required" >
    </div>
    
    <div class="form-group">
        <label for="lien_nom">Modifier le Nom du lien :</label>
        <input type="text" name="lien_nom" id="lien_nom" required="required" >
    </div>
    <div class="form-group">
        <label for="lien_url">Modifier l'URL du lien :</label>
        <input type="text" name="lien_url" id="lien_url" required="required" >
    </div>
    <div class="form-group">
        <label for="lien_description">Modifier la Description du lien :</label>
        <textarea name="lien_description" id="lien_description" required="required" ></textarea>
    </div>
    <div class="form-group">
        <input  class="blue-button"  type="submit" name="update_liens" value="MODIFIER LIEN">
    </div>
</form>

<form action="index.php" method="post">
    <input class="green-button"  type="submit" value="Revenir à la BDD" name="submit">
</form>

<?php
// Connexion à la base de données
try {
    $connexion = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '');
    echo("Connexion établie !");
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérifiez si les données du formulaire ont été soumises
if (isset($_POST['updatelien'])) {// Récupérez les données du formulaire
    $lien_id = $_POST['lien_id'];
    $lien_nom = $_POST['lien_nom'];
    $lien_url = $_POST['lien_url'];
    $lien_description = $_POST['lien_description'];
}

if (isset($_POST['update_liens'])) {
    // Récupérez les données du formulaire pour les liens
    $lien_id = $_POST['lien_id'];
    $lien_nom = $_POST['lien_nom'];
    $lien_url = $_POST['lien_url'];
    $lien_description = $_POST['lien_description'];

    // Préparez la requête de mise à jour pour la table "lien"
    $requeteLien = "UPDATE lien SET lien_nom = :lien_nom, lien_url = :lien_url, lien_description = :lien_description WHERE lien_id = :lien_id";
    $requetePrepareeLien = $connexion->prepare($requeteLien);
    $requetePrepareeLien->bindValue(':lien_id', $lien_id);
    $requetePrepareeLien->bindValue(':lien_nom', $lien_nom);
    $requetePrepareeLien->bindValue(':lien_url', $lien_url);
    $requetePrepareeLien->bindValue(':lien_description', $lien_description);
    $requetePrepareeLien->execute();
}
?>

</body>
</html>
