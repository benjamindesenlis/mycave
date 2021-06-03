<?php
session_start(); // On démarre la session AVANT toute chose
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace de connexion</title>
    <link rel="stylesheet" href="./assets/style/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
</head>

<body>

    <div class="espace">
        <img id="bgadmin" src="./assets/img/rose-1024710_1920.jpg" alt="">
        <div class="connexion">
            <h2>Connectez-vous!</h2> <br>
            <form action="./php/traitement/traitement-login.php" method="post">
                <input type="text" name="mailconnect"> <br>
                <input type="password" name="mdpconnect"> <br>
                <input type="submit" placeholder="Connectez-vous!"> <br>
            </form>
        </div>
    </div>

</body>

</html>