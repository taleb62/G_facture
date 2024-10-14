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
  <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
  <meta name="author" content="Dreamguys - Bootstrap Admin Template">
  <meta name="robots" content="noindex, nofollow">
  <title>G-Facture</title>

  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/st.css">

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
        <div class="row">
          
          
          
        
        <?php
// Inclure le fichier de connexion
include 'conn.php';

// Requête SQL pour obtenir le nombre total de clients
$query = "SELECT COUNT(*) AS total_customers FROM customer";
$result = $conn->query($query);

// Initialisation de la variable pour stocker le nombre de clients
$total_customers = 0;

if ($result) {
    // Récupération de la valeur
    $row = $result->fetch_assoc();
    $total_customers = $row['total_customers'];
}

$conn->close();
?>

<div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="customerlist.php" style="text-decoration: none; color: inherit; display: block; width: 100%; height: 100%;">
        <div class="dash-count">
            <div class="dash-counts">
                <h4><?php echo htmlspecialchars($total_customers); ?></h4>
                <h5>Clients</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="user"></i>
            </div>
        </div>
    </a>
</div>

<script>
    feather.replace(); // Activation des icônes Feather
</script>


<?php
include 'conn.php';

// Requête pour obtenir le nombre total de produits
$query_products = "SELECT COUNT(*) AS total_products FROM product";
$result_products = $conn->query($query_products);
$total_products = 0;
if ($result_products) {
    $row_products = $result_products->fetch_assoc();
    $total_products = $row_products['total_products'];
}

$conn->close();
?>

<div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="productlist.php" style="text-decoration: none; color: inherit; display: block; width: 100%; height: 100%;">
        <div class="dash-count das1">
            <div class="dash-counts">
                <h4><?php echo htmlspecialchars($total_products); ?></h4>
                <h5>Produits</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="box"></i>
            </div>
        </div>
    </a>
</div>

<script>
    feather.replace(); // Activer les icônes Feather
</script>


<?php
include 'conn.php';

// Requête pour obtenir le nombre total de catégories
$query_categories = "SELECT COUNT(*) AS total_categories FROM category";
$result_categories = $conn->query($query_categories);
$total_categories = 0;
if ($result_categories) {
    $row_categories = $result_categories->fetch_assoc();
    $total_categories = $row_categories['total_categories'];
}

$conn->close();
?>

<div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="categorylist.php" style="text-decoration: none; color: inherit; display: block; width: 100%; height: 100%;">
        <div class="dash-count das2">
            <div class="dash-counts">
                <h4><?php echo htmlspecialchars($total_categories); ?></h4>
                <h5>Categories</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="file-text"></i>
            </div>
        </div>
    </a>
</div>

<script>
    feather.replace(); // Activer les icônes Feather
</script>

<?php
include 'conn.php';

// Requête pour obtenir le nombre total de factures de vente
$query_invoices = "SELECT COUNT(*) AS total_invoices FROM invoice";
$result_invoices = $conn->query($query_invoices);
$total_invoices = 0;
if ($result_invoices) {
    $row_invoices = $result_invoices->fetch_assoc();
    $total_invoices = $row_invoices['total_invoices'];
}

$conn->close();
?>

<div class="col-lg-3 col-sm-6 col-12 d-flex">
    <a href="saleslist.php" style="text-decoration: none; color: inherit; display: block; width: 100%; height: 100%;">
        <div class="dash-count das3">
            <div class="dash-counts">
                <h4><?php echo htmlspecialchars($total_invoices); ?></h4>
                <h5>factures</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="file"></i>
            </div>
        </div>
    </a>
</div>

<script>
    feather.replace(); // Activer les icônes Feather
</script>


        <div class="row">
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

// Requête SQL pour récupérer les ventes par jour
$sql = "SELECT DATE(invoice_date) AS sale_date, SUM(total) AS total_sales 
        FROM invoice 
        GROUP BY DATE(invoice_date) 
        ORDER BY sale_date DESC
        LIMIT 5";
$result = $conn->query($sql);

// Vérifier si la requête s'est exécutée avec succès
if ($result === false) {
    die("Erreur d'exécution de la requête : " . $conn->error);
}

// Création des tableaux pour stocker les dates et les ventes
$saleDates = array();
$totalSales = array();

// Parcourir les résultats et stocker les données dans les tableaux
while ($row = $result->fetch_assoc()) {
    $saleDates[] = $row['sale_date'];
    $totalSales[] = $row['total_sales'];
}

// Fermer la connexion à la base de données
$conn->close();
?>

<div class="col-lg-7 col-sm-12 col-12 d-flex">
    <div class="card flex-fill">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Ventes par jour</h5>
            <div class="graph-sets">
                <ul>
                    <li>
                        <span>Ventes</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <!-- Ajouter un conteneur pour le graphique -->
            <canvas id="sales_chart"></canvas>
        </div>
    </div>
</div>
          <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
              <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">le 5 derineur produits ajouter</h4>
                <div class="dropdown">
                  <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                    <i class="fa fa-ellipsis-v"></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                      <a href="productlist.html" class="dropdown-item">Product List</a>
                    </li>
                    <li>
                      <a href="addproduct.html" class="dropdown-item">Product Add</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive dataview">
                <?php
include 'conn.php';

// Requête SQL pour récupérer les 5 derniers produits
$query_last_products = "SELECT * FROM product ORDER BY id DESC LIMIT 5";
$result_last_products = $conn->query($query_last_products);

// Vérifier si des résultats ont été trouvés
if ($result_last_products->num_rows > 0) {
?>
<table class="table datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Produits</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        while ($row = $result_last_products->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td class="productimgname">
                    <?php
                    // Obtenir le chemin de la photo du produit
                    $photo_path = "{$row['photo']}";

                    // Récupérer les dimensions de l'image
                    list($width, $height) = getimagesize($photo_path);

                    // Spécifier la dimension maximale (100 pixels pour la largeur ou la hauteur)
                    $max_dimension = 100;

                    // Calculer la nouvelle taille en maintenant les proportions de l'image
                    $new_width = $width;
                    $new_height = $height;
                    if ($width > $max_dimension || $height > $max_dimension) {
                        if ($width > $height) {
                            $new_width = $max_dimension;
                            $new_height = intval($height * ($max_dimension / $width));
                        } else {
                            $new_height = $max_dimension;
                            $new_width = intval($width * ($max_dimension / $height));
                        }
                    }

                    // Afficher l'image avec les nouvelles dimensions
                    echo "<img src='{$photo_path}' alt='Product Photo' style='max-width: {$new_width}px; max-height: {$new_height}px;'>";
                    ?>
                    <?php echo $row['product_name']; ?>
                </td>
                <td>$<?php echo $row['price']; ?></td>
            </tr>
            <?php
            $count++;
        }
        ?>
    </tbody>
</table>
<?php
} else {
    echo "Aucun produit trouvé.";
}

$conn->close();
?>


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

// Requête SQL pour récupérer les cinq dernières factures
$sql = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
FROM invoice 
JOIN customer ON invoice.customer_id = customer.customer_id
ORDER BY invoice.id_invoice DESC
LIMIT 5";
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
                    <th>N°</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Variable pour compter de 1 à 5
                $count = 1;
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
                        <td><?= $count ?></td>
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
                    <?php
                    $count++; // Incrémenter le compteur
                } ?>
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


  <script src="assets/js/jquery-3.6.0.min.js"></script>

  <script src="assets/js/feather.min.js"></script>

  <script src="assets/js/jquery.slimscroll.min.js"></script>

  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap4.min.js"></script>

  <script src="assets/js/bootstrap.bundle.min.js"></script>

  <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
  <script src="assets/plugins/apexchart/chart-data.js"></script>

  <script src="assets/js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Données de ventes par jour
        var saleDates = <?php echo json_encode($saleDates); ?>;
        var totalSales = <?php echo json_encode($totalSales); ?>;

        // Créer un nouveau graphique
        var ctx = document.getElementById('sales_chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Type de graphique (ligne dans cet exemple)
            data: {
                labels: saleDates, // Dates des ventes
                datasets: [{
                    label: 'Ventes', // Étiquette du jeu de données
                    data: totalSales, // Les données de ventes
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Couleur de fond de la zone sous la ligne
                    borderColor: 'rgba(54, 162, 235, 1)', // Couleur de la ligne
                    borderWidth: 1 // Largeur de la ligne
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Commencer l'axe des Y à zéro
                    }
                }
            }
        });
    });
</script>
</body>

</html>