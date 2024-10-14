<?php
session_start();

// Vérifiez si l'utilisateur n'est pas connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirigez l'utilisateur vers la page de connexion
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dreams Pos admin template</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/st.css">
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="global-loader">
    <div class="whirly-loader"></div>
</div>
<div class="main-wrapper">
    <?php include "includes/header.php";?>
    <?php include "includes/sidebar.php";?>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Category list</h4>
                    <h6>View/Search product Category</h6>
                </div>
                <div class="page-btn">
                    <a href="addcategory.php" class="btn btn-added">
                        <img src="assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Filter Inputs -->
                    <div class="table-top">
                        <div class="search-set">
                            <!-- Search Path and Input -->
                        </div>
                        <div class="wordset">
                            <!-- File Export Icons -->
                        </div>
                    </div>
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <!-- Filter Inputs Form -->
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive">
                    <table class="table datanew">
    <thead>
        <tr>
            <th>
                <label class="checkboxs">
                    <input type="checkbox" id="select-all">
                    <span class="checkmarks"></span>
                </label>
            </th>
            <th>Category photo</th>
            <th>Category name</th>
            <th>Category Code</th> <!-- Ajout de la colonne Category Code -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
include "conn.php";

$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
        echo "<td class='productimgname'>";
        
        // Afficher l'image de la catégorie si elle existe
        if(!empty($row["category_photo"])) {
            echo "<a href='javascript:void(0);' class='product-img'><img src='" . $row["category_photo"] . "' alt='product'></a>";
        } else {
            echo "<span class='no-image'>No Image</span>";
        }

        // Afficher le nom de la catégorie
    
        echo "</td>";
        echo "<td>" . $row["category_name"] . "</td>";
        echo "<td>" . $row["category_code"] . "</td>";
      
        echo "<td>";
        echo "<a class='me-3' href='editcategory.php?id=" . $row['id'] . "'><img src='assets/img/icons/edit.svg' alt='img'></a>";

        echo "<a class='me-3 confirm-delete' href='javascript:void(0);' data-id='" . $row['id'] . "'><img src='assets/img/icons/delete.svg' alt='img'></a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Aucune catégorie trouvée.</td></tr>";
}

mysqli_close($conn);
?>

    </tbody>
</table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>
<script src="assets/js/script.js"></script>
<script>
$(document).ready(function(){
    // Gérer le clic sur le lien de suppression de la catégorie
    $('.confirm-delete').click(function(){
        var categoryId = $(this).data('id');
        // Afficher une alerte douce pour la confirmation
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir supprimer cette catégorie ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur confirme, envoyer une requête de suppression AJAX
                $.ajax({
                    url: 'deletecategory.php', // Le script PHP qui gère la suppression
                    type: 'POST',
                    data: { id: categoryId }, // Envoyer l'ID de la catégorie à supprimer
                    success: function(response) {
                        // Si la suppression réussit, afficher une notification de succès
                        Swal.fire({
                            icon: 'success',
                            title: 'Catégorie supprimée avec succès.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Si la suppression réussit, recharger la page pour mettre à jour le tableau
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        // En cas d'erreur, afficher un message d'erreur
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur lors de la suppression de la catégorie.',
                            text: xhr.responseText
                        });
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
});
</script>

</body>
</html>
