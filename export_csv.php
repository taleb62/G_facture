<?php
include 'conn.php';  // Assurez-vous que le chemin d'accès est correct

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// Créer une sortie en fichier CSV
$output = fopen("php://output", "w");

// Entêtes de colonnes
fputcsv($output, array('ID', 'Customer Name', 'Date', 'Total'));

// Requête pour récupérer les données
$sql = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
FROM invoice 
JOIN customer ON invoice.customer_id = customer.customer_id";
$result = $conn->query($sql);

// Vérifier si la requête s'est exécutée avec succès
if ($result) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, array($row['id_invoice'], $row['customer_name'], $row['invoice_date'], $row['total']));
    }
} else {
    // Gérer l'erreur ici
    echo "Erreur d'exécution de la requête : " . $conn->error;
}

fclose($output);
$conn->close();
?>
<?php
include 'conn.php';  // Assurez-vous que le chemin d'accès est correct

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// Créer une sortie en fichier CSV
$output = fopen("php://output", "w");

// Entêtes de colonnes
fputcsv($output, array('ID', 'Customer Name', 'Date', 'Total'));

// Requête pour récupérer les données
$sql = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
FROM invoice 
JOIN customer ON invoice.customer_id = customer.customer_id";
$result = $conn->query($sql);

// Vérifier si la requête s'est exécutée avec succès
if ($result) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, array($row['id_invoice'], $row['customer_name'], $row['invoice_date'], $row['total']));
    }
} else {
    // Gérer l'erreur ici
    echo "Erreur d'exécution de la requête : " . $conn->error;
}

fclose($output);
$conn->close();
?>