<?php
require_once "../conn.php"; 
session_start();

// Détruire toutes les données de session
$_SESSION = array();
session_destroy();

// Supprimer le cookie de session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 1, '/');
}

// Rediriger vers la page de connexion
header("Location: login.php");
exit;
?>
