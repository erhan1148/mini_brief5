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
  

    <label for="lien_id">ID du lien :</label>
    <input type="text" name="lien_id" id="lien_id">

    <input type="submit" name="delete" value="SUPPRIMER">

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
    $lien_id = $_POST['lien_id'];

    $requete = "DELETE lien, categorie, categorie_lien
FROM lien
LEFT JOIN categorie_lien ON lien.lien_id = categorie_lien.lien_id
LEFT JOIN categorie ON categorie_lien.categorie_id = categorie.categorie_id
WHERE lien.lien_id = :lien_id;";

$requetePreparee = $connexion->prepare($requete);
$requetePreparee->bindValue(':lien_id', $lien_id);
$requetePreparee->execute();

}

    
   



?>




</body>
</html>