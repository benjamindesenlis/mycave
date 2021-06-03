<?php
session_start(); // On démarre la session AVANT toute chose


// j'initialise 2 tableau vide pour stocké mes datas traité et mes erreur de validation
$data = [];
$error = [];
$folder = 'avatarfolder';
// faire un tableau 


if (!empty($_POST)) {

    if (empty($_POST['name'] || strlen($_POST['name'] <= 3))) {
        $error['name'] = ' Le champs nom est requis';
    } else {
        $data['name'] = strip_tags($_POST['name']);
    }

    if (empty($_POST['year'] || strlen($_POST['year'] <= 3))) {
        $error['year'] = ' Le champs année est requis';
    } else {
        $data['year'] = strip_tags($_POST['year']);
    }

    if (empty($_POST['grapes'] || strlen($_POST['grapes'] <= 3))) {
        $error['grapes'] = ' Le champs raisin est requis';
    } else {
        $data['grapes'] = strip_tags($_POST['grapes']);
    }

    if (empty($_POST['country'] || strlen($_POST['country'] <= 3))) {
        $error['country'] = ' Le champs pays est requis';
    } else {
        $data['country'] = strip_tags($_POST['country']);
    }

    if (empty($_POST['region'] || strlen($_POST['region'] <= 3))) {
        $error['region'] = ' Le champs région est requis';
    } else {

        $data['region'] = strip_tags($_POST['region']);
    }

    if (empty($_POST['description'] || strlen($_POST['description'] <= 3))) {
        $error['description'] = ' Le champs description est requis';
    } else {
        $data['description'] = strip_tags($_POST['description']);
    }

    if (!empty($_FILES)) {
        if (!is_dir($folder)) {

            mkdir($folder, 0755);
        }

        $temp = explode(".", $_FILES["picture"]["name"]);
        $temp[2] = rand(0, 30000); //Set to random number
        $fileName = $temp[0] . "_" . $temp[2] . "." . $temp[1];
        $data['picture'] = strtolower($fileName);
        // var_dump($tmp_name);
        // var_dump($temp);
        // var_dump($fileName);
        // die;
        // var_dump($_FILES['picture']);
        // die;
        // move_uploaded_file($_FILES["picture"]['tmp_name'], "./assets/img/avatarfolder/" . $fileName);

        // echo "Stored in: " . "../../assets/img/avatarfolder" . $_FILES["picture"]['name'];




        if (file_exists("avatarfolder/" . $fileName)) {
            echo $fileName . " already exists. ";
        } else {
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../../assets/img/avatarfolder/" . $fileName);

            // echo "Stored in: " . "../../assets/img/avatarfolder" . $fileName;
        }
    } else {
        $data['picture'] = null;
    }
}

if (!empty($error)) {
    foreach ($error as $e) {
        echo $e . '<br>';
    }
    die;
}

require_once '../include/database.php';

$req = $db->prepare('INSERT INTO vins(name, year, grapes, country, region, description, picture) VALUES(:name, :year, :grapes, :country, :region , :description, :picture)');
$req->execute($data);
header('Location:../../administration.php');


echo 'Les infos ont bien été ajoutées !';
