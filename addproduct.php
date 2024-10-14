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
require_once "conn.php";

function getCategoryOptions() {
    global $conn;
    $options = "";
    $sql = "SELECT id, Category_name FROM category";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $options .= "<option value='" . $row["id"] . "'>" . $row["Category_name"] . "</option>";
        }
    }
    return $options;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = htmlspecialchars($_POST['Product_Name']);
    $category_id = htmlspecialchars($_POST['Category_id']);
    $price = htmlspecialchars($_POST['Price']);
    $qty = htmlspecialchars($_POST['Qty']);

    $target_dir = "uploads/";
    $filename = basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $filename;
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $errors = [];

    if ($_FILES["photo"]["size"] > 5000000) {
        $errors[] = "Désolé, votre fichier est trop volumineux.";
    }
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $errors[] = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
    }
    if (file_exists($target_file)) {
        $errors[] = "Désolé, le fichier existe déjà.";
    }

    if (empty($errors) && move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO `product` (`photo`, `product_name`, `category_id`, `price`, `qty`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidi", $target_file, $product_name, $category_id, $price, $qty);
        if ($stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        icon: 'Success',
                        title: 'Success',
                        text: 'Nouveau produit ajouté avec succès.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = 'productlist.php';
                    });
                  </script>";
                  header('Location: productlist.php');
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Erreur lors de l\'ajout du produit.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>";
        }
        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '" . $error . "',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>";
        }
    }
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
<link rel="stylesheet" href="assets/css/st.css">
<title>Dreams Pos admin template</title>
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
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

<div class="main-wrapper">
<?php include "includes/header.php";?>
<?php include "includes/sidebar.php";?>

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>Product Add</h4>
<h6>Create new product</h6>
</div>
</div>

<div class="card">
<div class="card-body">
<form method="post" action="addproduct.php" enctype="multipart/form-data">
<div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Product Name</label>
<input type="text" name="Product_Name" class="form-control">
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Category</label>
<select name="Category_id" class="form-control select">
<option value="">Choose Category</option>
<?= getCategoryOptions(); ?>
</select>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Price</label>
<input type="text" name="Price" class="form-control">
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Quantity</label>
<input type="text" name="Qty" class="form-control">
</div>
</div>
<div class="col-lg-12">
<div class="form-group">
<label>Product Image</label>
<div class="image-upload">
<input type="file" name="photo">
<div class="image-uploads">
<img src="assets/img/icons/upload.svg" alt="img">
<h4>Drag and drop a file to upload</h4>
</div>
</div>
</div>
</div>
<div class="col-lg-12">
<button type="submit" class="btn btn-submit me-2">Submit</button>
<a href="productlist.html" class="btn btn-cancel">Cancel</a>
</div>
</div>
</form>
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
