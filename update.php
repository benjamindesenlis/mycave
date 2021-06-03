<?php

session_start(); // On démarre la session AVANT toute chose

// verifier l'id si integer et non vide
$id = htmlspecialchars($_GET['id']);
require_once './php/include/database.php';
$requete = $db->query("SELECT id,name, year, grapes, country, region, description, picture FROM vins where id = $id");
// $requete->execute($id);

$data = $requete->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'édition de vin</title>
    <link rel="stylesheet" href="./assets/style/update.css">
</head>

<body>
    <div class="espace">
        <img id="bgadmin" src="./assets/img/rose-1024710_1920.jpg" alt="">
        <div class="update-container">
            <h3>Edition de la bouteille</h3> <br><br>
            <form id="update" method="POST" action="./php/traitement/traitement-update.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input class="low" type="text" name="name" value="<?= $data["name"] ?>">
                <input class="low" type="number" name="year" value="<?= $data["year"] ?>">
                <input class="low" type="text" name="grapes" value="<?= $data["grapes"] ?>">
                <input class="low" type="text" name="country" value="<?= $data["country"] ?>">
                <input class="low" type="text" name="region" value="<?= $data["region"] ?>">
                <input class="high" type="text" name="description" cols="30" rows="1" value="<?= $data["description"] ?>">
                <img src="./assets/img/avatarfolder/<?php echo $data['picture']; ?>" alt="">
                <input class="select
            " type="file" id="picture" name="picture">
                <input id="send" type="submit">
            </form>
        </div>
    </div>




</body>

</html>