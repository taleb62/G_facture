<?php
session_start();

// Vérifiez si l'utilisateur n'est pas connecté
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirigez l'utilisateur vers la page de connexion
    header("Location: auth/login.php");
    exit;
}
?>

<?php
include "conn.php";

if(isset($_GET['id'])) {
    $category_id = $_GET['id'];
    
    $sql = "SELECT * FROM category WHERE id = $category_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $category_name = $row['category_name'];
        $category_code = $row['category_code'];
        $category_photo = $row['category_photo'];
    } else {
        header("Location: categorylist.php");
        exit();
    }
} else {
    header("Location: categorylist.php");
    exit();
}

if(isset($_POST['submit'])) {
    $new_category_name = $_POST['category_name'];
    $new_category_code = $_POST['category_code'];

    // Vérifier si un fichier a été téléchargé
    if(isset($_FILES['category_photo']) && $_FILES['category_photo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['category_photo']['tmp_name'];
        $file_name = $_FILES['category_photo']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        // Définir le chemin de destination pour sauvegarder le fichier
        $upload_path = "uploads/";
        $new_file_name = $category_id . "_" . time() . "." . $file_extension;
        $destination = $upload_path . $new_file_name;
        
        // Déplacer le fichier téléchargé vers le dossier de destination
        if(move_uploaded_file($file_tmp_name, $destination)) {
            // Mettre à jour le chemin de la nouvelle photo dans la base de données
            $category_photo = $destination;
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }

    // Requête SQL pour mettre à jour les données de la catégorie dans la base de données
    $update_sql = "UPDATE category SET category_name='$new_category_name', category_code='$new_category_code', category_photo='$category_photo' WHERE id=$category_id";
    if(mysqli_query($conn, $update_sql)) {
        header("Location: categorylist.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour des données de la catégorie : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
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
<link rel="stylesheet" href="assets/css/st.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>
<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Product Edit Category</h4>
<h6>Edit a product Category</h6>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-6 col-sm-6 col-12">
<form method="post" enctype="multipart/form-data">
<div class="form-group">
<label>Category Name</label>
<input type="text" name="category_name" value="<?php echo $category_name; ?>">
</div>
<div class="form-group">
<label>Category Code</label>
<input type="text" name="category_code" value="<?php echo $category_code; ?>">
</div>
<div class="form-group">
<label>Product Image</label>
<input type="file" name="category_photo">
</div>
<div class="form-group">
<img src="<?php echo $category_photo; ?>" alt="Category Photo" style="max-width: 200px;">
</div>
<button type="submit" name="submit" class="btn btn-submit me-2">Submit</button>
<a href="categorylist.html" class="btn btn-cancel">Cancel</a>
</form>
</div>
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
</body>
</html>
