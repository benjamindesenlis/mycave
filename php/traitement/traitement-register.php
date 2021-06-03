<?php
session_start(); // On démarre la session AVANT toute chose

require_once '../include/database.php';

$data = [];
$error = [];

if (!empty($_POST)) {

    if (empty($_POST['firstname'] || strlen($_POST['firstname'] <= 3))) {
        $error['firstname'] = ' Le champs prénom est requis';
    } else {
        $firstname = htmlspecialchars($_POST['firstname']);
        $data['firstname'] = strip_tags($_POST['firstname']);
    }

    if (empty($_POST['lastname'] || strlen($_POST['lastname'] <= 3))) {
        $error['lastname'] = ' Le champs nom est requis';
    } else {
        $lastname = htmlspecialchars($_POST['lastname']);
        $data['lastname'] = strip_tags($_POST['lastname']);
    }

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars($_POST['email']);
        $data['email'] = strip_tags($_POST['email']);
    } else {
        $error['email'] = "L\'adresse email" . $_POST['email'] . " est considérée comme invalide.";
    }

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password-confirm'] || strlen($_POST['password'] <= 6)) {
        $error['password'] = ' Le champs mot de passe est requis ou invalide';
    } else {
        $password = htmlspecialchars($_POST['password']);
        $passwordconfirm = htmlspecialchars($_POST['password-confirm']);
        $data['password'] = password_hash(strip_tags($_POST['password']), PASSWORD_DEFAULT);
    }

    $req = $db->prepare('INSERT INTO users(firstname, lastname, email, password) VALUES(:firstname, :lastname, :email, :password)');
    $req->execute($data);

    header('Location:/index.php');
} else {
    header('Location:/index.php');
}
