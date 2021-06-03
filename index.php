<?php
session_start(); // On démarre la session AVANT toute chose
?>
<?php
require_once '../include/database.php';
$requete = "SELECT id, name, year, grapes, country, region, description, picture FROM vins";
$resultat = $db->query($requete)->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCave - Ma petite cave à vin</title>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Mate+SC&family=Nanum+Myeongjo&display=swap" rel="stylesheet">




</head>

<body>
    <img id="bg" src="./assets/img/aperitif-2027177_1920.jpg" alt="">
    <?php include 'php/include/navbar.html'; ?>
    <div class="intro">
        <img id="logowhite" src="./assets/img/logoblanc.png" alt=""> <br>
        <h2>Bienvenu(e) dans ma cave à vin!</h2> <br>
        <p>Ici vous trouverez l'ensemble des bouteilles présentes dans ma cave, avec la provenance, l'année de mise en bouteille, les cépages, ainsi qu'un court descriptif des saveurs que vous pourrez retrouver en venant à mes séances de dégustation. <br>
            Bientôt, une boutique en ligne vous sera proposé!</p>
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
                    </p>

                </div>

            </div>




        <?php } ?>


    </div>

    <?php include 'php/include/footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>