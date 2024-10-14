<?php
// Inclure TCPDF
require_once('tcpdf/tcpdf.php');  // Assurez-vous que le chemin est correct

// Créer une instance de la classe TCPDF
$pdf = new TCPDF();

// Définir les informations du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Votre Nom');
$pdf->SetTitle('Rapport des Ventes');
$pdf->SetSubject('Exportation des Données de Ventes');

// Ajouter une page
$pdf->AddPage();

// Définir le contenu
$html = '<h1 style="text-align:center;">Rapport des Ventes</h1>';

// Connexion à la base de données
require 'conn.php';
$query = "SELECT invoice.id_invoice, invoice.invoice_date, invoice.total, customer.customer_name 
FROM invoice 
JOIN customer ON invoice.customer_id = customer.customer_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $html .= '<table border="1" cellpadding="5">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nom du Client</th>
                  <th>Date</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>';

    while ($row = $result->fetch_assoc()) {
        $html .= "<tr>
                    <td>{$row['id_invoice']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['invoice_date']}</td>
                    <td>{$row['total']}</td>
                  </tr>";
    }
    $html .= '</tbody></table>';
} else {
    $html .= '<p>Aucune donnée disponible.</p>';
}

$pdf->writeHTML($html, true, false, true, false, '');

// Fermer et afficher le PDF
$pdf->Output('rapport_ventes.pdf', 'I');
?>