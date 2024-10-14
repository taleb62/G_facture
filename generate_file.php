<?php
// Inclure le fichier de connexion
include 'conn.php';

// Vérifier si les données doivent être exportées vers Excel
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    // Nom du fichier CSV à télécharger
    $filename = 'invoices.csv';

    // Entête du fichier CSV
    $csv_file = fopen('php://output', 'w');
    fputcsv($csv_file, array('ID', 'Customer Name', 'Date', 'Total'));

    // Requête SQL pour récupérer les données
    $sql = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
            FROM invoice 
            JOIN customer ON invoice.customer_id = customer.customer_id";
    $result = $conn->query($sql);

    // Vérifier si la requête s'est exécutée avec succès
    if ($result === false) {
        die("Erreur d'exécution de la requête : " . $conn->error);
    }

    // Remplissage des données dans le fichier CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($csv_file, $row);
    }

    // Fermer le fichier CSV
    fclose($csv_file);

    // En-têtes pour télécharger le fichier CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Arrêter l'exécution du script
    exit;
}
?>

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
                        <a href="?export=csv" data-bs-toggle="tooltip" data-bs-placement="top" title="Export to CSV"><img src="assets/img/icons/excel.svg" alt="img"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Requête SQL pour récupérer les données
                    $sql = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
                            FROM invoice 
                            JOIN customer ON invoice.customer_id = customer.customer_id";
                    $result = $conn->query($sql);

                    // Vérifier si la requête s'est exécutée avec succès
                    if ($result === false) {
                        die("Erreur d'exécution de la requête : " . $conn->error);
                    }

                    // Affichage des données dans le tableau
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_invoice"] . "</td>";
                        echo "<td>" . $row["customer_name"] . "</td>";
                        echo "<td>" . $row["invoice_date"] . "</td>";
                        echo "<td>" . $row["total"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
