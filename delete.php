<?php
session_start(); // On démarre la session AVANT toute chose
?>

<?php
require_once './php/include/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM vins WHERE id = $id";

$req = $db->prepare($sql);

$req->execute();
header('Location:administration.php');
