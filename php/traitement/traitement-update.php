<?php
session_start(); // On démarre la session AVANT toute chose

require_once '../include/database.php';



$data = [];
$errors = [];
$sql = '';

if (!empty($_POST)) {
    $id = htmlspecialchars($_POST['id']);
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
        //gestion d'image
        $dossier = 'avatarfolder';
        $fichier = $_FILES['picture']['name'];
        $taille_maxi = 100000;
        $taille = filesize($_FILES['picture']['tmp_name']);
        $extensions = array('.png', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['picture']['name'], '.');


        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau c'est queele n'est pas valide
        {
            $errors['picture'] = 'Vous devez uploader un fichier de type png, jpg, ou jpeg...';
        }

        if ($taille > $taille_maxi) {
            $errors['picture_size'] = 'Le fichier est trop gros...';
        }

        if (!isset($errors['picture']) && !isset($errors['picture_size'])) //S'il n'y a pas d'erreur, on upload
        {

            $temp = explode(".", $_FILES["picture"]["name"]);
            $temp[2] = rand(0, 30000); //Set to random number
            $fileName = $temp[0] . "_" . $temp[2] . "." . $temp[1];
            $data['picture'] = strtolower($fileName);

            if (file_exists("../../assets/img/avatarfolder/" . $fileName)) {
                echo $fileName . " already exists. ";
            } else {
                move_uploaded_file($_FILES["picture"]["tmp_name"], "../../assets/img/avatarfolder/" . $fileName);
            }

            // if (!empty($data['picture'])) {
            //     $sql = "UPDATE vins SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description, picture = :picture WHERE id = $id";
            // } else {
            //     $sql = "UPDATE vins SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description WHERE id = $id";
            // }


            $sql = "UPDATE vins SET name = :name, year = :year, grapes = :grapes, country = :country, region = :region, description = :description, picture = :picture WHERE id = $id";
            $req = $db->prepare($sql);
            $req->execute($data);
            header('Location:../../administration.php');
        } else {
            $errors['empty-post'] = 'aucune données';
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
        }
    }
}
