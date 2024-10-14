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

require_once "conn.php";  // Ensure the connection script is properly included

function handleUpload($file)
{
  $target_dir = "uploads/";
  $filename = basename($file["name"]);
  $target_file = $target_dir . $filename;
  $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  $allowedFileTypes = ['jpg', 'png', 'jpeg', 'gif'];
  $errors = [];

  // Validate file size and type
  if ($file['size'] > 5000000) {
    $errors[] = "Désolé, votre fichier est trop volumineux.";
  }
  if (!in_array($imageFileType, $allowedFileTypes)) {
    $errors[] = "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
  }
  if (file_exists($target_file)) {
    $errors[] = "Désolé, le fichier existe déjà.";
  }

  // Attempt to move the file if no errors
  if (empty($errors) && move_uploaded_file($file["tmp_name"], $target_file)) {
    return $target_file;
  } else {
    $errors[] = "Erreur lors du téléchargement du fichier.";
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
    return false;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $category_name = htmlspecialchars($_POST['Category_name']);
  $category_code = htmlspecialchars($_POST['Category_code']);
  $uploadedFile = handleUpload($_FILES['Category_image']);

  if ($uploadedFile) {
    $sql = "INSERT INTO `category` (`Category_photo`, `Category_name`, `Category_Code`) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("sss", $uploadedFile, $category_name, $category_code);
      if ($stmt->execute()) {
        echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Nouvelle catégorie ajoutée avec succès.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
      } else {
        echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Erreur lors de l\'ajout de la catégorie.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
      }
      $stmt->close();
    } else {
      echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Erreur de préparation de la requête SQL.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>";
    }
  }

  $conn->close();
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

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

  <div class="main-wrapper">

    <?php include "includes/header.php"; ?>
    <?php include "includes/sidebar.php"; ?>

    <div class="page-wrapper">
      <div class="content">
        <div class="page-header">
          <div class="page-title">
            <h4>Product Add Category</h4>
            <h6>Create new product Category</h6>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <form method="post" action="addcategory.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="Category_name">
                  </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Category Code</label>
                    <input type="text" name="Category_code">
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label> category Image</label>
                    <div class="image-upload">
                      <input type="file" name="Category_image">
                      <div class="image-uploads">
                        <img src="assets/img/icons/upload.svg" alt="img">
                        <h4>Drag and drop a file to upload</h4>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-submit me-2">Submit</button>
                  <a href="categorylist.html" class="btn btn-cancel">Cancel</a>
                </div>
              </div>
            </form>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <script>
    // Function to show Sweet Alert
    function showAlert(message, icon) {
      swal({
        title: "Alert!",
        text: message,
        icon: icon,
        button: "OK",
      });
    }

    // Check if the URL contains a success message
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');
    if (successMessage) {
      showAlert(successMessage, "success");
    }

    // Listen for form submission
    document.getElementById('categoryForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission
      this.submit(); // Submit the form
    });
  </script>
</body>

</html>