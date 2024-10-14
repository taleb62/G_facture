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
  <link rel="stylesheet" href="assets/css/st.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="assets/css/animate.css">

  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

  <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

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
          <h4>Customer List</h4>
          <h6>Manage your Customers</h6>
        </div>
        <div class="page-btn">
          <a href="addcustomer.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img">Add Customer</a>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-top">
            <div class="search-set">
              <div class="search-path">
                <a class="btn btn-filter" id="filter_search">
                  <img src="assets/img/icons/filter.svg" alt="img">
                  <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                </a>
              </div>
              <div class="search-input">
                <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
              </div>
            </div>
            <div class="wordset">
              <ul>
                <li>
                  <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                </li>
                <li>
                  <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                </li>
                <li>
                  <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                </li>
              </ul>
            </div>
          </div>

          <div class="card" id="filter_inputs">
            <div class="card-body pb-0">
              <div class="row">
                <div class="col-lg-2 col-sm-6 col-12">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Customer Code">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-12">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Customer Name">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-12">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Phone Number">
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-12">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Email">
                  </div>
                </div>
                <div class="col-lg-1 col-sm-6 col-12  ms-auto">
                  <div class="form-group">
                    <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table  datanew">
              <thead>
                <tr>
                  <th>
                    <label class="checkboxs">
                      <input type="checkbox" id="select-all">
                      <span class="checkmarks"></span>
                    </label>
                  </th>
                  <th>Customer Name</th>


                  <th>Phone</th>

                  <th>Adresse</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Inclure le fichier de connexion à la base de données
                require_once "conn.php";

                // Requête SQL pour sélectionner les données des clients
                $sql = "SELECT `customer_id`, `customer_name`, `phone`, `address`, `customer_photo` FROM `customer` WHERE 1";

                // Exécuter la requête SQL
                $result = $conn->query($sql);

                // Vérifier si des données ont été trouvées
                if ($result->num_rows > 0) {
                  // Afficher les données des clients dans un tableau HTML
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><label class='checkboxs'><input type='checkbox'><span class='checkmarks'></span></label></td>";
                    echo "<td class='productimgname'>";
                    // Assurez-vous que les images sont chargées depuis le dossier "uploads"
                    echo "<a href='javascript:void(0);' class='product-img'><img src='" . $row["customer_photo"] . "' alt='product'></a>";
                    echo "<a href='javascript:void(0);'>" . $row["customer_name"] . "</a>";
                    echo "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>";
                    // echo "<a class='me-3' href='editproduct.php?id=" . $row['id'] . "'><img src='assets/img/icons/edit.svg' alt='img'></a>";
                    echo "<a class='me-3' href='editcustomer.php?customer_id=" . $row["customer_id"] . "'><img src='assets/img/icons/edit.svg' alt='img'></a>";
                    // echo "<a class='me-3' href='delete_customer.php?customer_id=" . $row["customer_id"] . "'><img src='assets/img/icons/delete.svg' alt='img'></a>";
                    echo "<a class='me-3' href='javascript:void(0);' onclick='confirmDelete(" . $row["customer_id"] . ")'><img src='assets/img/icons/delete.svg' alt='img'></a>";

                    // echo "<a class='me-3 href='delete_customer.php?customer_id=" . $row["customer_id"] . "'><img src='assets/img/icons/delete.svg' alt='img'></a>";
                    echo "</td>";
                    echo "</tr>";
                  }
                } else {
                  // Aucun client trouvé
                  echo "<tr><td colspan='5'>Aucun client trouvé</td></tr>";
                }


                // Fermer la connexion à la base de données
                $conn->close();
                ?>



              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>


  
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Function to confirm deletion using SweetAlert
  function confirmDelete(customer_id) {
    Swal.fire({
      title: 'Êtes-vous sûr?',
      text: "Vous ne pourrez pas revenir en arrière!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, supprimer!',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        // If user confirms, redirect to deletecustomer.php with customer_id
        window.location.href = 'delete_customer.php?customer_id=' + customer_id;
      }
    });
  }
</script>

  <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="assets/js/jquery-3.6.0.min.js"></script>

  <script src="assets/js/feather.min.js"></script>

  <script src="assets/js/jquery.slimscroll.min.js"></script>

  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap4.min.js"></script>

  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <script src="assets/plugins/select2/js/select2.min.js"></script>

  <script src="assets/js/moment.min.js"></script>
  <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

  <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
  <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

  <script src="assets/js/script.js"></script>
  


</body>

</html>