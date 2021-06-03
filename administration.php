<?php
session_start(); // On démarre la session AVANT toute chose

require_once './php/include/database.php';

$requete = "SELECT id, name, year, grapes, country, region, description, picture FROM vins";
$resultat = $db->query($requete)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace d'administration</title>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Mate+SC&family=Nanum+Myeongjo&display=swap" rel="stylesheet">

</head>

<body>
    <?php if (isset($_SESSION['id'])) {

    ?>

        <img id="bg" src="./assets/img/aperitif-2027177_1920.jpg" alt="">
        <div class="intro">
            <a href="./index.php"> <img id="logowhite" src="./assets/img/logoblanc.png" alt=""></a>
            <br> <br> <br>
            <h2>Espace d'administration</h2> <br>
            <p>Page de modification/ajout/suppression de bouteille et ajout d'un nouvel administrateur</p>
            <button id="off"><a href="./deconnexion.php">Déconnexion</a></button>

        </div>



        <div class="grid-container">

            <?php
            foreach ($resultat as $result) {
            ?>
                <div class="fichevin">
                    <div class="left">
                        <img src="./assets/img/avatarfolder/<?php echo $result['picture']; ?>">
                    </div>
                    <div class="right">
                        <h3><?php echo $result['name']; ?></h3> <br>
                        <p><?php echo $result['year']; ?></p>
                        <p>Cépages: <?php echo $result['grapes'] ?></p>
                        <p>Fabriqué dans la région: <?php echo $result['region']; ?>, <?php echo $result['country']; ?> </p> <br>
                        <p><?php echo $result['description']; ?> </td>
                        </p> <br>
                        <a href="./update.php?id=<?php echo $result['id'] ?>">Editer</a>
                        <a href="./delete.php?id=<?php echo $result['id'] ?>">Supprimer</a>

                    </div>

                </div>




            <?php } ?>


        </div>


        </div> <br><br><br>


        <div class="add-container">

            <form id="addcontainer" action="./php/traitement/traitement-add.php" method="POST" enctype="multipart/form-data" id="tableau">
                <h3>Ajouter un vin</h3>
                <h3>Fiche descriptive du vin</h3>
                <input class="low" type="text" maxlength="30" placeholder="Nom" name="name">
                <input class="low" type="number" maxlength="4" placeholder="Année" name="year">
                <input class="low" type="text" maxlength="30" placeholder="Raisin" name="grapes">
                <input class="low" type="text" maxlength="30" placeholder="Pays" name="country">
                <input class="low" type="text" maxlength="30" placeholder="Région" name="region">
                <input class="high" type="text" maxlength="230" placeholder="Description" name="description">
                <input class="select" type="file" placeholder="Image" name="picture" accept="image/png, image/jpg, image/jpeg"> <br>
                <button type=" submit">Envoyer</button>
            </form>
        </div> <br><br><br>


        <div class="register-container">
            <form id="registercontainer" action="./php/traitement/traitement-register.php" method="POST">
                <h3>Ajouter un administrateur</h3> <br>
                <input class="low" type="text" placeholder="Prenom" name="firstname">
                <input class="low" type="text" placeholder="Nom" name="lastname">
                <input class="low" type="email" placeholder="Email" name="email">
                <input class="low" type="password" placeholder="Mot de passe" name="password">
                <input class="low" type="password" placeholder="Confirmez le mdp" name="password-confirm">
                <button type="submit">Envoyer</button>
            </form>
        </div> <br><br><br>





    <?php } else {

    ?> <p>Vous n'avez pas accès à cette page, <a href="./index.php">Cliquez ici pour retrourner à l'accueil</a></p>
    <?php } ?>
</body>

</html>