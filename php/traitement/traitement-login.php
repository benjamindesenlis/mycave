<?php

session_start(); // On démarre la session AVANT toute chose

require_once '../include/database.php';

if (!empty($_POST)) {
    if (!empty($_POST['mdpconnect']) && !empty($_POST['mailconnect']) && filter_var($_POST['mailconnect'], FILTER_VALIDATE_EMAIL)) {
        $req = $db->prepare('SELECT * FROM users WHERE email = :mailconnect');
        $req->execute(array(
            'mailconnect' => $_POST['mailconnect']
        ));

        $user = $req->fetch(PDO::FETCH_ASSOC);

        if (!empty($user)) {
            if (password_verify($_POST['mdpconnect'], $user['password'])) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['mailconnect'] = $user['email'];
                // $_SESSION['firstname'] = $user['firstname'];
                echo 'Vous êtes connecté! ENFIN!';
                header('Location:../../administration.php');
            } else {
                $errors['mdp'] = 'Mot de passe éronnée';
            }
        } else {
            $errors['user'] = 'Utilisateur inexistant';
        }
    } else {
        $errors['form'] = 'Les champs sont requis';
    }
} else {
    $errors['form'] = 'Aucune donnée reçue';
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error;
    }
    die;
}
