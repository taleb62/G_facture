<?php
// Inclure le fichier de connexion à la base de données
require_once "conn.php";

// Vérifier si l'ID de la catégorie est fourni
if(isset($_GET['categoryId']) && is_numeric($_GET['categoryId'])) {
    // Récupérer l'ID de la catégorie
    $categoryId = mysqli_real_escape_string($conn, $_GET['categoryId']);
    
    // Requête SQL pour sélectionner les produits de la catégorie spécifiée
    $sql = "SELECT * FROM `products` WHERE `category_id` = $categoryId";

    // Exécuter la requête SQL
    $result = $conn->query($sql);

    // Vérifier si des produits ont été trouvés
    if ($result->num_rows > 0) {
        // Afficher les produits
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-lg-3 col-sm-6 d-flex'>";
            echo "<div class='productset flex-fill active'>";
            echo "<div class='productsetimg'>";
            echo "<img src='" . $row["product_photo"] . "' alt='img'>";
            echo "<h6>Qty: " . $row["qty"] . "</h6>";
            echo "<div class='check-product'><i class='fa fa-check'></i></div>";
            echo "</div>";
            echo "<div class='productsetcontent'>";
            echo "<h5>" . $row["category_name"] . "</h5>";
            echo "<h4>" . $row["product_name"] . "</h4>";
            echo "<h6>" . $row["price"] . "</h6>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        // Aucun produit trouvé pour cette catégorie
        echo "<p>Aucun produit trouvé pour cette catégorie</p>";
    }
} else {
    // Aucun ID de catégorie fourni
    echo "<p>Aucun ID de catégorie fourni</p>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
