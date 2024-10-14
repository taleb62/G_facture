<?php
include "conn.php";

// Récupérer les données du client à mettre à jour
if(isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    
    $sql = "SELECT * FROM customer WHERE customer_id = $customer_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $customer_name = $row['customer_name'];
        $phone = $row['phone'];
        $address = $row['address'];
        $customer_photo = $row['customer_photo'];
    } else {
        header("Location: customerlist.php");
        exit();
    }
} else {
    header("Location: customerlist.php");
    exit();
}

// Mettre à jour les données du client
if(isset($_POST['submit'])) {
    $new_customer_name = $_POST['customer_name'];
    $new_phone = $_POST['phone'];
    $new_address = $_POST['address'];

    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        $file_name = $_FILES['photo']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        $upload_path = "uploads/";
        $new_file_name = $customer_id . "_" . time() . "." . $file_extension;
        $destination = $upload_path . $new_file_name;
        
        if(move_uploaded_file($file_tmp_name, $destination)) {
            $customer_photo = $destination;
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }

    // Requête SQL pour mettre à jour les données du client
    $update_sql = "UPDATE customer SET customer_name=?, phone=?, address=?, customer_photo=? WHERE customer_id=?";
    $stmt = mysqli_prepare($conn, $update_sql);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $new_customer_name, $new_phone, $new_address, $customer_photo, $customer_id);
        if(mysqli_stmt_execute($stmt)) {
            header("Location: customerlist.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour des données du client : " . mysqli_error($conn);
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

  <?php include "includes/header.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Edit Customer Management</h4>
          <h6>Edit/Update Customer</h6>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </div>
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" value="<?php echo $phone; ?>">
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="address" value="<?php echo $address; ?>">
                </div>
                <div class="form-group">
                  <label>Customer Photo</label>
                  <input type="file" name="photo">
                </div>
                <div class="form-group">
                  <label>Current Customer Photo</label><br>
                  <img src="<?php echo $customer_photo; ?>" alt="Customer Photo" style="max-width: 200px;">
                </div>
                <button type="submit" name="submit" class="btn btn-submit me-2">Update</button>
                <a href="customerlist.html" class="btn btn-cancel">Cancel</a>
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
