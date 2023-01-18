<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="Styles/style.css">
    

    <title>BDD</title>
</head>

<body>
<h1>MES BOOKMARKS</h1>

<table>
<tr>
    <th>Catégories_ID</th>
    <th>Catégories</th>
    <th>Liens_ID</th>
    <th>Liens</th>
    <th>Liens_Url</th>
    <th>Liens_Descriptions</th>
</tr>


<form action="create.php" method="post">
    <input type="submit" value="Ajouter" name="submit" class="cat1">
</form>
<form action="update.php" method="post">
    <input type="submit" value="Modifier"  name="submit" class="cat2">
</form>
<form action="delete.php" method="post">
    <input type="submit" value="Supprimer" name="submit" id="cat3">
</form>
<?php

try {
    // On se connecte à MySQL
    $connexion = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '');
    echo("");
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table 
$requete = 'SELECT categorie.*, lien.* FROM categorie_lien 
JOIN categorie ON categorie_lien.categorie_id = categorie.categorie_id
JOIN lien ON categorie_lien.lien_id = lien.lien_id';

$requetePreparee = $connexion->prepare($requete);
$requetePreparee->execute();
$resultats = $requetePreparee->fetchAll();


foreach ($resultats as $ligne) {
    echo "<tr>";
        echo "<td>".$ligne ['categorie_id']."</td>";
        echo "<td>".$ligne ['categorie_nom']."</td>";
        echo "<td>".$ligne ['lien_id']."</td>";
        echo "<td>".$ligne ['lien_nom']."</td>";
        echo "<td>".$ligne ['lien_url']. "</td>";
        echo "<td>".$ligne ['lien_description']. "</td>";
    echo "</tr>";
}

            
                                
?>

                                
</body>



</table>

</body>
</html>