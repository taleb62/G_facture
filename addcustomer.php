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
require_once "conn.php";  // Assurez-vous que le script de connexion est correctement inclus

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    
    // Gestion de l'upload de l'image du client (s'il y a lieu)
    if (isset($_FILES["customer_photo"]) && $_FILES["customer_photo"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $filename = basename($_FILES["customer_photo"]["name"]);
        $target_file = $target_dir . $filename;

        // Déplacement du fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($_FILES["customer_photo"]["tmp_name"], $target_file)) {
            // Le fichier a été téléchargé avec succès
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Erreur lors du téléchargement de l'image du client.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                  </script>";
            exit; // Arrête l'exécution du script en cas d'erreur de téléchargement de l'image
        }
    } else {
        // Gérer le cas où aucun fichier n'a été téléchargé
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Veuillez sélectionner une image.',
                    showConfirmButton: false,
                    timer: 2000
                });
              </script>";
        exit; // Arrête l'exécution du script si aucun fichier n'a été téléchargé
    }
    
    // Requête SQL préparée pour l'insertion des données
    $sql = "INSERT INTO customer(customer_name, phone, `address`, `customer_photo`) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Liaison des valeurs aux paramètres de la requête
        $stmt->bind_param("ssss", $customer_name, $phone, $address, $target_file);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Nouveau client ajouté avec succès.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = 'your_php_script.php'; // Redirection après la fermeture de la fenêtre d'alerte
                            }
                        });
                      </script>";
        } else {
            echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Erreur lors de l\'ajout du client.',
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

    $conn->close(); // Fermeture de la connexion à la base de données
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
            <h4>Customer Management</h4>
            <h6>Add/Update Customer</h6>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <form method="post" action="addcustomer.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="customer_name">
                  </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone">
                  </div>
                </div>
              
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address">
                  </div>
                </div>
                
                <div class="col-lg-12">
                  <div class="form-group">
                    <label> Avatar</label>
                    <div class="image-upload">
                      <input type="file" name="customer_photo">
                      <div class="image-uploads">
                        <img src="assets/img/icons/upload.svg" alt="img">
                        <h4>Drag and drop a file to upload</h4>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-submit me-2">Submit</button>
                  <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
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
</body>

</html>
