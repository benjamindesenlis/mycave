<?php
// Constantes d'environnements
define("DBHOST", "sql11.freemysqlhosting.net");
define("DBUSER", "sql11416813");
define("DBPASS", "TFLXNAqvgY");
define("DBNAME", "sql11416813");
// DSN de connexion - Data source name 
$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

// On va se connecter à la base avec un try/catch
try {
    // On instancie PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
    // echo "On est connectés";

    // On s'assure d'envoyer les données en UTF8
    $db->exec("SET NAMES utf8");

    // On défini le mode de fetch par default
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur:" . $e->getMessage());
}
    // Ici on est connéctés à la base
