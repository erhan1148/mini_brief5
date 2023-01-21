<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
</head>
<body>


<form method="POST" action="create.php">
  
    <div class="form-group">
        <label for="categorie_nom">Nom de la catégorie :</label>
        <input type="text" name="categorie_nom" id="categorie_nom" required="required" >
    </div>

    <div class="form-group">
        <label for="lien_nom">Nom du lien :</label>
        <input type="text" name="lien_nom" id="lien_nom" required="required" >
    </div>
    <div class="form-group">
        <label for="lien_url">URL du lien :</label>
        <input type="text" name="lien_url" id="lien_url" target="_blank" required="required" >
    </div>
    <div class="form-group">
        <label for="lien_description">Description du lien :</label>
        <textarea name="lien_description" id="lien_description" ></textarea>
    </div>
    <div class="form-group">
    <input class="blue-button" type="submit"  name="create" value="AJOUTER" >
</div>

</form>


<form action="index.php" method="post">
    <input class="green-button" type="submit" value="Revenir à la BDD" name="submit"  >
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
if (isset($_POST['create'])) {

    // Récupérez les données du formulaire
    $categorie_nom = $_POST['categorie_nom'];
    $lien_nom = $_POST['lien_nom'];
    $lien_url = $_POST['lien_url'];
    $lien_description = $_POST['lien_description'];


    // Vérifiez si les champs "categorie_nom" est rempli avant de les insérer dans la table "categorie
    if(!empty($categorie_nom)) {
    
        // Vérifiez si la catégorie existe déjà
        $requeteCategorieExistante = "SELECT * FROM categorie WHERE categorie_nom = :categorie_nom";
        $requetePrepareeCategorieExistante = $connexion->prepare($requeteCategorieExistante);
        $requetePrepareeCategorieExistante->bindValue(':categorie_nom', $categorie_nom);
        $requetePrepareeCategorieExistante->execute();
        $categorieExistante = $requetePrepareeCategorieExistante->fetch();
        
        if(!$categorieExistante){
            // Préparez la requête d'insertion pour la table "categorie
        // Préparez la requête d'insertion pour la table "categorie"
        $requeteCategorie = "INSERT INTO categorie (categorie_nom) VALUES (:categorie_nom)";
        $requetePrepareeCategorie = $connexion->prepare($requeteCategorie);
        $requetePrepareeCategorie->bindValue(':categorie_nom', $categorie_nom);
        $requetePrepareeCategorie->execute();
        // Récupération de l'id de la catégorie
        $categorie_id = $connexion->lastInsertId();
        }else{
        $categorie_id = $categorieExistante['categorie_id'];
        }
        }// Vérifiez si les champs "lien_nom", "lien_url" et "lien_description" sont remplis avant de les insérer dans la table "lien"
        if(!empty($lien_nom) && !empty($lien_url) && !empty($lien_description)) {
    
    // Vérifiez si le lien existe déjà
    $requeteLienExistant = "SELECT * FROM lien WHERE lien_nom = :lien_nom AND lien_url = :lien_url AND lien_description = :lien_description";
    $requetePrepareeLienExistant = $connexion->prepare($requeteLienExistant);
    $requetePrepareeLienExistant->bindValue(':lien_nom', $lien_nom);
    $requetePrepareeLienExistant->bindValue(':lien_url', $lien_url);
    $requetePrepareeLienExistant->bindValue(':lien_description', $lien_description);
    $requetePrepareeLienExistant->execute();
    $lienExistant = $requetePrepareeLienExistant->fetch();
    
    if(!$lienExistant){
    // Préparez la requête d'insertion pour la table "lien"
    $requeteLien = "INSERT INTO lien (lien_nom, lien_url, lien_description) VALUES (:lien_nom, :lien_url, :lien_description)";
    $requetePrepareeLien = $connexion->prepare($requeteLien);
    $requetePrepareeLien->bindValue(':lien_nom', $lien_nom);
    $requetePrepareeLien->bindValue(':lien_url', $lien_url);
    $requetePrepareeLien->bindValue(':lien_description', $lien_description);
    $requetePrepareeLien->execute();
    // Récupération de l'id du lien
    $lien_id = $connexion->lastInsertId();
    }else{
        $lien_id = $lienExistant['lien_id'];
    }
}

// Vérifiez si les champs "categorie_id" et "lien_id" sont remplis avant de les insérer dans la table "categorie_lien"
if(!empty($categorie_id) && !empty($lien_id)) {
    // Préparez la requête d'insertion pour la table "categorie_lien"
    $requeteCategorieLien = "INSERT INTO categorie_lien (categorie_id, lien_id) VALUES (:categorie_id, :lien_id)";
    $requetePrepareeCategorieLien = $connexion->prepare($requeteCategorieLien);
    $requetePrepareeCategorieLien->bindValue(':categorie_id', $categorie_id);
    $requetePrepareeCategorieLien->bindValue(':lien_id', $lien_id);
    $requetePrepareeCategorieLien->execute();
    }}
    

?>




</body>
</html>


</body>
</html>