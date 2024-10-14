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
<!-- Inclure SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <h4>List_Facture</h4>
            <h6></h6>
          </div>
          <div class="page-btn">
            <a href="bill/creat_facture.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add Sales</a>
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
    <a href="path_to_your_pdf_script.php" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
</li>

                  <li>
    <a href="export_csv.php" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
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
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                      <input type="text" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                      <input type="text" placeholder="Enter Reference No">
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                      <select class="select">
                        <option>Completed</option>
                        <option>Paid</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                      <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php
// Inclure le fichier de connexion
include 'conn.php';

// Vérifier si une requête de suppression a été envoyée et si l'identifiant de la facture est valide
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Requête SQL pour supprimer la facture spécifiée en utilisant une requête préparée
    $delete_sql = "DELETE FROM invoice WHERE id_invoice = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    // Exécuter la requête de suppression
    if ($stmt->execute()) {
        echo "La facture a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la facture : " . $conn->error;
    }
    $stmt->close();
}

// Requête SQL pour récupérer les données
$sql = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
FROM invoice 
JOIN customer ON invoice.customer_id = customer.customer_id";
$result = $conn->query($sql);

// Vérifier si la requête s'est exécutée avec succès
if ($result === false) {
    die("Erreur d'exécution de la requête : " . $conn->error);
}

// Vérification s'il y a des résultats
if ($result->num_rows > 0) {
    // Commencer l'affichage du tableau HTML
    ?>
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
                    <th>id </th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Boucle à travers les résultats et affichage dans le tableau
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td><?= $row["id_invoice"] ?></td>
                        <td><?= $row["customer_name"] ?></td>
                        <td><?= $row["invoice_date"] ?></td>
                        <td><?= $row["total"] ?></td>
                        <td class="text-center">
                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="bill/facture/view.php?id=<?= $row['id_invoice'] ?>" class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2" alt="img">Sale Detail</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item"><img src="assets/img/icons/download.svg" class="me-2" alt="img">Download pdf</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item confirm-delete" data-id="<?= $row['id_invoice'] ?>"><img src="assets/img/icons/delete1.svg" class="me-2" alt="img">Delete Sale</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sélectionnez tous les éléments avec la classe confirm-delete
            var confirmLinks = document.querySelectorAll('.confirm-delete');

            // Ajoutez un gestionnaire d'événements pour chaque lien de suppression
            confirmLinks.forEach(function(link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    var id = this.getAttribute('data-id');

                    // Affichez la boîte de dialogue de confirmation
                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: "Vous ne pourrez pas annuler cela!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, supprimer!',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si l'utilisateur confirme la suppression, redirigez vers la page de suppression avec l'ID de la facture
                            window.location.href = '?delete_id=' + id;
                        }
                    });
                });
            });
        });
    </script>
<?php } else {
    echo "0 résultats";
}

// Fermer la connexion à la base de données
$conn->close();

?>



          </div>
        </div>

      </div>
    </div>
  </div>


  <div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Show Payments</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Reference</th>
                  <th>Amount </th>
                  <th>Paid By </th>
                  <th>Paid By </th>
                </tr>
              </thead>
              <tbody>
                <tr class="bor-b1">
                  <td>2022-03-07 </td>
                  <td>INV/SL0101</td>
                  <td>$ 0.00 </td>
                  <td>Cash</td>
                  <td>
                    <a class="me-2" href="javascript:void(0);">
                      <img src="assets/img/icons/printer.svg" alt="img">
                    </a>
                    <a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment" data-bs-toggle="modal" data-bs-dismiss="modal">
                      <img src="assets/img/icons/edit.svg" alt="img">
                    </a>
                    <a class="me-2 confirm-text" href="javascript:void(0);">
                      <img src="assets/img/icons/delete.svg" alt="img">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Customer</label>
                <div class="input-groupicon">
                  <input type="text" value="2022-03-07" class="datetimepicker">
                  <div class="addonset">
                    <img src="assets/img/icons/calendars.svg" alt="img">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Reference</label>
                <input type="text" value="INV/SL0101">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Received Amount</label>
                <input type="text" value="0.00">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Paying Amount</label>
                <input type="text" value="0.00">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Payment type</label>
                <select class="select">
                  <option>Cash</option>
                  <option>Online</option>
                  <option>Inprogress</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group mb-0">
                <label>Note</label>
                <textarea class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-submit">Submit</button>
          <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Payment</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Customer</label>
                <div class="input-groupicon">
                  <input type="text" value="2022-03-07" class="datetimepicker">
                  <div class="addonset">
                    <img src="assets/img/icons/datepicker.svg" alt="img">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Reference</label>
                <input type="text" value="INV/SL0101">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Received Amount</label>
                <input type="text" value="0.00">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Paying Amount</label>
                <input type="text" value="0.00">
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Payment type</label>
                <select class="select">
                  <option>Cash</option>
                  <option>Online</option>
                  <option>Inprogress</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group mb-0">
                <label>Note</label>
                <textarea class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-submit">Submit</button>
          <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
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

  <script src="assets/js/moment.min.js"></script>
  <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

  <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
  <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

  <script src="assets/js/script.js"></script>
</body>

</html>