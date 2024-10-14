<?php
// Configuration de la base de données
$host = "localhost"; // Hôte de la base de données
$utilisateur = "root"; // Nom d'utilisateur de la base de données
$mdp = ""; // Mot de passe de la base de données
$base_de_donnees = "me"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($host, $utilisateur, $mdp, $base_de_donnees);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Vérification si le formulaire de connexion a été soumis
