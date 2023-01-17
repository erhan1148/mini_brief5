<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer</title>
</head>
<body>


<form method="POST" action="delete.php">
    <label for="categorie_id">ID de la catégorie :</label>
    <input type="text" name="categorie_id" id="categorie_id">

    <label for="lien_id">ID du lien :</label>
    <input type="text" name="lien_id" id="lien_id">

    <input type="submit" name="submit" value="SUPPRIMER">

</form>

<form action="index.php" method="post">
    <input type="submit" value="Revenir à la BDD" name="submit">
</form>
    
<?php

// Connexion à la base de données
try {
    $connexion = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '');
    echo("Connexion établie !");
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}




if(isset($_POST['delete'])) {
    // Récupérez les données du formulaire
    $categorie_id = $_POST['categorie_id'];
    $lien_id = $_POST['lien_id'];

    // Préparez la requête de suppression pour la table "categorie_lien"
    $requeteDelete = "DELETE FROM categorie_lien WHERE categorie_id = :categorie_id AND lien_id = :lien_id";
    $requetePrepareeDelete = $connexion->prepare($requeteDelete);
    $requetePrepareeDelete->bindValue(':categorie_id', $categorie_id);
    $requetePrepareeDelete->bindValue(':lien_id', $lien_id);
    $requetePrepareeDelete->execute();
}



?>


</body>
</html>