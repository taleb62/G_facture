<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté, si oui, le rediriger vers la page d'accueil
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Inclure votre fichier de configuration de base de données
require_once "../conn.php";

// Définir les variables et initialiser avec des valeurs vides
$username = $password = "";
$username_err = $password_err = "";

// Traitement du formulaire de soumission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Vérifier si le nom d'utilisateur est vide
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Vérifier si le mot de passe est vide
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Valider les informations d'identification
    if(empty($username_err) && empty($password_err)){
        // Préparer une requête de sélection
        $sql = "SELECT id, username, password FROM admin WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Lier les variables à la déclaration préparée en tant que paramètres
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Définir les paramètres
            $param_username = $username;
            
            // Tentative d'exécution de la déclaration préparée
            if(mysqli_stmt_execute($stmt)){
                // Stocker le résultat
                mysqli_stmt_store_result($stmt);
                
                // Vérifier si le nom d'utilisateur existe, si oui, vérifier le mot de passe
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Lier les variables résultantes
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Mot de passe correct, démarrer une nouvelle session
                            session_start();
                            
                            // Stocker les données dans des variables de session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirection vers la page de bienvenue
                            header("location: ../productlist.php");
                        } else{
                            // Affichage d'un message d'erreur si le mot de passe est incorrect
                            $password_err = "Invalid password.";
                        }
                    }
                } else{
                    // Affichage d'un message d'erreur si le nom d'utilisateur n'existe pas
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Fermeture de la déclaration
            mysqli_stmt_close($stmt);
        }
    }
    
    // Fermeture de la connexion
    mysqli_close($link);
}
?>
