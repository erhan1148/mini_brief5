<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
    <title>Supprimer</title>
</head>
<body>


<form method="POST" action="delete.php">
  
    <div class="form-group">
    <label for="lien_id">ID du lien :</label>
    <input type="text" name="lien_id" id="lien_id" required="required" >
    </div>

    <div class="form-group">
    <input class="blue-button"  type="submit" name="delete" value="SUPPRIMER">
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

if(isset($_POST['delete'])) {
    // Récupérez les données du formulaire
    $lien_id = $_POST['lien_id'];

    // Récupérez les informations liées au lien à supprimer
    $query = $connexion->prepare("SELECT categorie_id FROM categorie_lien WHERE lien_id = :lien_id");
    $query->bindValue(':lien_id', $lien_id);
    $query->execute();
    $categories = $query->fetchAll();

    // Supprimez les informations de la table de liaison 'categorie_lien'
    $query = $connexion->prepare("DELETE FROM categorie_lien WHERE lien_id = :lien_id");
    $query->bindValue(':lien_id', $lien_id);
    $query->execute();
    
    // Supprimez les catégories associées 
    foreach($categories as $category) {
        $query = $connexion->prepare("SELECT COUNT(*) FROM categorie_lien WHERE categorie_id = :categorie_id AND lien_id != :lien_id");
        $query->bindValue(':categorie_id', $category['categorie_id']);
        $query->bindValue(':lien_id', $lien_id);
        $query->execute();
        if($query->fetchColumn() == 0) {
        $query = $connexion->prepare("DELETE FROM categorie WHERE categorie_id = :categorie_id");
        $query->bindValue(':categorie_id', $category['categorie_id']);
        $query->execute();    

        }
    }

    // Supprimez les informations de la table 'lien'
    $query = $connexion->prepare("DELETE FROM lien WHERE lien_id = :lien_id");
    $query->bindValue(':lien_id', $lien_id);
    $query->execute();

    }
?>



</body>
</html>