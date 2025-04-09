<?php
require_once('tcpdf/tcpdf.php');
require_once 'Etudiant.php';

$etudiantRepo = new Etudiant();
$etudiants = $etudiantRepo->findAllWithSection();

// Création du PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ton nom');
$pdf->SetTitle('Liste des étudiants');
$pdf->AddPage();

// Titre
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Liste des étudiants', 0, 1, 'C');

// Contenu du tableau
$pdf->SetFont('helvetica', '', 12);
$html = '<table border="1" cellpadding="4">
<tr>
    <th><b>ID</b></th>
    <th><b>Nom</b></th>
    <th><b>Filière</b></th>
    <th><b>Date de naissance</b></th>
</tr>';

foreach ($etudiants as $etudiant) {
    $html .= '<tr>
        <td>' . htmlspecialchars($etudiant['id']) . '</td>
        <td>' . htmlspecialchars($etudiant['name']) . '</td>
        <td>' . htmlspecialchars($etudiant['section_name']) . '</td>
        <td>' . htmlspecialchars($etudiant['birthday']) . '</td>
    </tr>';
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Télécharger le fichier
$pdf->Output('liste_etudiants.pdf', 'D');
exit;
?>
