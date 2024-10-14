<?php
// Inclure le fichier de connexion à la base de données
include "conn.php";

// Vérifier si l'ID de la catégorie à supprimer est passé en paramètre
if(isset($_POST['id'])) {
    // Récupérer l'ID de la catégorie à supprimer
    $category_id = $_POST['id'];

    // Requête SQL pour supprimer la catégorie de la base de données
    $sql = "DELETE FROM `category` WHERE id = ?";

    // Préparer la requête
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Liage des paramètres et exécution de la requête
        $stmt->bind_param("i", $category_id);
        if ($stmt->execute()) {
            // Si la suppression réussit, renvoyer une réponse JSON
            echo json_encode(array("success" => true));
        } else {
            // Si la suppression échoue, renvoyer une réponse JSON avec un message d'erreur
            echo json_encode(array("success" => false, "message" => "Erreur lors de la suppression de la catégorie."));
        }
        $stmt->close();
    } else {
        // Si la préparation de la requête échoue, renvoyer une réponse JSON avec un message d'erreur
        echo json_encode(array("success" => false, "message" => "Erreur lors de la préparation de la requête."));
    }
} else {
    // Si l'ID de la catégorie n'est pas passé en paramètre, renvoyer une réponse JSON avec un message d'erreur
    echo json_encode(array("success" => false, "message" => "ID de la catégorie non spécifié."));
}

// Fermer la connexion à la base de données
$conn->close();
?>
