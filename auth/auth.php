<?php
session_start();

$error = '';  // Variable pour stocker le message d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Identifiants pré-définis pour l'authentification
    $valid_username = "taleb";
    $valid_password = "123";  // En pratique, ne jamais utiliser de mots de passe en clair comme ceci

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user_id'] = 1;  // ID statique pour la session
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        header("Location: ../index.php");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>