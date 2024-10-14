<?php
include "conn.php";

// Récupérer les données du produit à mettre à jour
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_name = $row['product_name'];
        $category_id = $row['category_id'];
        $price = $row['price'];
        $qty = $row['qty'];
        $photo = $row['photo'];
    } else {
        header("Location: productlist.php");
        exit();
    }
} else {
    header("Location: productlist.php");
    exit();
}

// Récupérer les catégories disponibles
$category_options = '';
$sql_categories = "SELECT * FROM category";
$result_categories = mysqli_query($conn, $sql_categories);
if(mysqli_num_rows($result_categories) > 0) {
    while($row_category = mysqli_fetch_assoc($result_categories)) {
        $selected = ($row_category['id'] == $category_id) ? 'selected' : '';
        $category_options .= "<option value='{$row_category['id']}' $selected>{$row_category['category_name']}</option>";
    }
}

// Mettre à jour les données du produit
if(isset($_POST['submit'])) {
    $new_product_name = $_POST['product_name'];
    $new_category_id = $_POST['category_id'];
    $new_price = $_POST['price'];
    $new_qty = $_POST['qty'];

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $upload_path = "uploads/";
        $new_file_name = $product_id . "_" . time() . "." . $file_extension;
        $destination = $upload_path . $new_file_name;
        
        if(move_uploaded_file($file_tmp_name, $destination)) {
            $photo = $destination;
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }

    // Requête SQL pour mettre à jour les données du produit
    $update_sql = "UPDATE product SET product_name=?, category_id=?, price=?, qty=?, photo=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $update_sql);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'siidsi', $new_product_name, $new_category_id, $new_price, $new_qty, $photo, $product_id);
        if(mysqli_stmt_execute($stmt)) {
            header("Location: productlist.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour des données du produit : " . mysqli_error($conn);
        }
    } else {
        echo "Erreur de préparation de la requête : " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
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

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/st.css">

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

  <?php include "includes/header.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Product Edit</h4>
          <h6>Update your product</h6>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" name="product_name" value="<?php echo $product_name; ?>">
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select class="select" name="category_id">
                    <?php echo $category_options; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Price</label>
                  <input type="text" name="price" value="<?php echo $price; ?>">
                </div>
                <div class="form-group">
                  <label>Quantity</label>
                  <input type="text" name="qty" value="<?php echo $qty; ?>">
                </div>
                <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" name="photo">
                </div>
                <div class="form-group">
                  <label>Current Product Image</label><br>
                  <img src="<?php echo $photo; ?>" alt="Product Photo" style="max-width: 200px;">
                </div>
                <button type="submit" name="submit" class="btn btn-submit me-2">Update</button>
                <a href="productlist.html" class="btn btn-cancel">Cancel</a>
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


