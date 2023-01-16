<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
   
    

<body>
<form method="POST" action="create.php">
    <label for="categorie_id">ID de la catégorie :</label>
    <input type="text" name="categorie_id" id="categorie_id">
    <label for="categorie_nom">Nom de la catégorie :</label>
    <input type="text" name="categorie_nom" id="categorie_nom">

    <label for="lien_id">ID du lien :</label>
    <input type="text" name="lien_id" id="lien_id">

    <label for="lien_nom">Nom du lien :</label>
    <input type="text" name="lien_nom" id="lien_nom">

    <label for="lien_url">URL du lien :</label>
    <input type="text" name="lien_url" id="lien_url">

    <label for="lien_description">Description du lien :</label>
    <textarea name="lien_description" id="lien_description"></textarea>

    <input type="submit" name="submit" value="AJOUTER">

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

    // Vérifiez si les données du formulaire ont été soumises
    if (isset($_POST['submit'])) {

        // Récupérez les données du formulaire
        $categorie_id = $_POST['categorie_id'];
        $categorie_nom = $_POST['categorie_nom'];
        $lien_id = $_POST['lien_id'];
        $lien_nom = $_POST['lien_nom'];
        $lien_url = $_POST['lien_url'];
        $lien_description = $_POST['lien_description'];

    // Vérifiez si les champs "categorie_id" et "categorie_nom" sont remplis avant de les insérer dans la table "categorie"
    if(!empty($categorie_id) && !empty($categorie_nom)) {
        // Préparez la requête d'insertion pour la table "categorie"
        $requeteCategorie = "INSERT INTO categorie (categorie_id, categorie_nom) VALUES (:categorie_id, :categorie_nom)";
        $requetePrepareeCategorie = $connexion->prepare($requeteCategorie);
        $requetePrepareeCategorie->bindValue(':categorie_id', $categorie_id);
        $requetePrepareeCategorie->bindValue(':categorie_nom', $categorie_nom);
        $requetePrepareeCategorie->execute();
        $lastInsertId = $connexion->lastInsertId();
        if ($lastInsertId == $categorie_id) {
        }
        else {
        }
        
    }

            // Vérifiez si les champs "lien_nom", "lien_url" et "lien_description" sont remplis avant de les insérer dans la table "lien"
            if(!empty($lien_nom) && !empty($lien_url) && !empty($lien_description)) {
            // Préparez la requête d'insertion pour la table "lien"
            $requeteLien = "INSERT INTO lien (lien_id,lien_nom, lien_url, lien_description) VALUES (:lien_id,:lien_nom, :lien_url, :lien_description)";
            $requetePrepareeLien = $connexion->prepare($requeteLien);
            // Liez les données du formulaire aux paramètres de la requête
            $requetePrepareeLien->bindValue(':lien_id', $lien_id);
            $requetePrepareeLien->bindValue(':lien_nom', $lien_nom);
            $requetePrepareeLien->bindValue(':lien_url', $lien_url);
            $requetePrepareeLien->bindValue(':lien_description', $lien_description);
            $requetePrepareeLien->execute();
            }

            //préparer la requête d'insertion pour la table de liaison categorie_lien
            if(isset($lastInsertId)) {
                $requeteLienCategorie = "INSERT INTO categorie_lien (categorie_id,lien_id) VALUES (:categorie_id,:lien_id)";
                $requetePrepareeLienCategorie = $connexion->prepare($requeteLienCategorie);
                $requetePrepareeLienCategorie->bindValue(':categorie_id', $lastInsertId);
                $requetePrepareeLienCategorie->bindValue(':lien_id', $lien_id);
            }
            // Redirigez vers la page de visualisation des liens
            header('Location: create.php');
            exit;

        }

?>



</body>
</html>