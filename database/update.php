<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
    <title>Modifier</title>
</head>
<body>

<form method="POST" action="update.php">
    <div class="form-group">
        <label for="categorie_id">ID de la catégorie :</label>
        <input type="text" name="categorie_id" id="categorie_id" >
    </div>
    <div class="form-group">
        <label for="categorie_nom">Nom de la catégorie :</label>
        <input type="text" name="categorie_nom" id="categorie_nom"  >
    </div>
    <div class="form-group">
        <input class="blue-button"  type="submit" name="update_categories" value="MODIFIER CATEGORIE">
    </div>

    <div class="form-group">
        <label for="lien_id">ID du lien :</label>
        <input type="text" name="lien_id" id="lien_id" >
    </div>
    
    <div class="form-group">
        <label for="lien_nom">Nom du lien :</label>
        <input type="text" name="lien_nom" id="lien_nom" >
    </div>
    <div class="form-group">
        <label for="lien_url">URL du lien :</label>
        <input type="text" name="lien_url" id="lien_url" >
    </div>
    <div class="form-group">
        <label for="lien_description">Description du lien :</label>
        <textarea name="lien_description" id="lien_description" ></textarea>
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
if (isset($_POST['update'])) {// Récupérez les données du formulaire
    $categorie_id = $_POST['categorie_id'];
    $categorie_nom = $_POST['categorie_nom'];
    $lien_id = $_POST['lien_id'];
    $lien_nom = $_POST['lien_nom'];
    $lien_url = $_POST['lien_url'];
    $lien_description = $_POST['lien_description'];
}
if (isset($_POST['update_categories'])) {
    // Récupérez les données du formulaire pour les catégories
    $categorie_id = $_POST['categorie_id'];
    $categorie_nom = $_POST['categorie_nom'];

    // Préparez la requête de mise à jour pour la table "categorie"
    $requeteCategorie = "UPDATE categorie SET categorie_nom = :categorie_nom WHERE categorie_id = :categorie_id";
    $requetePrepareeCategorie = $connexion->prepare($requeteCategorie);
    $requetePrepareeCategorie->bindValue(':categorie_id', $categorie_id);
    $requetePrepareeCategorie->bindValue(':categorie_nom', $categorie_nom);
    $requetePrepareeCategorie->execute();
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
