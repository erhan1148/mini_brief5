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
<h1>CRUD</h1>

<table>
<tr>
    <th>Nom</th>
    <th>Lien</th>
    <th>Description</th>
</tr>


<?php

try {
    // On se connecte à MySQL
    $connexion = new PDO('mysql:host=localhost;dbname=brief5;charset=utf8', 'root', '');
    echo("Connexion établie !");
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table 
$requete = 'SELECT * FROM lien ';
$requetePreparee = $connexion->prepare($requete);
$requetePreparee->execute();
$resultats = $requetePreparee->fetchAll();

foreach ($resultats as $ligne) {
    echo "<tr>";
        echo "<td>".$ligne ['lien_nom']."</td>";
        echo "<td>".$ligne ['lien_url']. "</td>";
        echo "<td>".$ligne ['lien_description']. "</td>";
    echo "<tr>";
}
?>


</table>
</body>
</html>