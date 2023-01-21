<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
    <title>Modifier Catégories</title>
</head>
<body>

<form method="POST" action="updatecategorie.php">
    <div class="form-group">
        <label for="categorie_id">Saisissez l'ID de la catégorie à Modifier :</label>
        <input type="text" name="categorie_id" id="categorie_id" >
    </div>
    <div class="form-group">
        <label for="categorie_nom">Modifier le Nom de la catégorie :</label>
        <input type="text" name="categorie_nom" id="categorie_nom" required="required" >
    </div>
    <div class="form-group">
        <input class="blue-button"  type="submit" name="update_categories" value="MODIFIER CATÉGORIE">
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
if (isset($_POST['updatecategorie'])) {// Récupérez les données du formulaire
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

?>

</body>
</html>