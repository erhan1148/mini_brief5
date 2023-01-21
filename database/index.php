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
    <input type="submit" value="Ajouter" name="submit" class="cat1" >
</form>
<form action="update.php" method="post">
    <input type="submit" value="Modifier"  name="submit" class="cat2">
</form>
<form action="delete.php" method="post">
    <input type="submit" value="Supprimer" name="submit" class="cat2">
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
if (!empty($resultats)) {
    // Regrouper les données
    function groupByCategory($resultats) {
        $groupedData = array();
        foreach ($resultats as $row) {
            $groupedData[$row['categorie_id']]['categorie_id'] = $row['categorie_id'];
            $groupedData[$row['categorie_id']]['categorie_nom'] = $row['categorie_nom'];
            $groupedData[$row['categorie_id']]['lien'][] = array(
            'lien_id' => $row['lien_id'],
            'lien_nom' => $row['lien_nom'],
            'lien_url' => $row['lien_url'],
            'lien_description' => $row['lien_description']
            );
            }
            return $groupedData;
            }
            $groupedData = groupByCategory($resultats);// Afficher les données regroupées
            foreach ($groupedData as $group) {
                    echo "<tr>";
                    echo "<td rowspan='".count($group['lien'])."'>" . $group['categorie_id'] . "</td>";
                    echo "<td rowspan='".count($group['lien'])."'>" . $group['categorie_nom'] . "</td>";
                
                    foreach ($group['lien'] as $key => $link) {
                        if ($key != 0) {
                            echo "<tr>";
                        }
                        echo "<td>" . $link['lien_id'] . "</td>";
                        echo "<td>" . $link['lien_nom'] . "</td>";
                        echo "<td><a href='" . $link['lien_url'] . "' target='_blank'>" . $link['lien_url'] . "</a></td>";
                        echo "<td>" . $link['lien_description'] . "</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";}
?>
                                             
</table>                   
</body>
</html>