<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page.";
    header('Location: index.php');
    exit;
}

require_once 'Etudiant.php';
$etudiantRepo = new Etudiant();
$search = $_GET['search'] ?? '';

if ($search !== '') {
    $etudiants = $etudiantRepo->findByName($search);
} else {
    $etudiants = $etudiantRepo->findAllWithSection();
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=liste_etudiants.csv');

$output = fopen('php://output', 'w');

// En-tête du tableau
fputcsv($output, ['ID', 'Nom', 'Filière', 'Birthday']);

foreach ($etudiants as $etudiant) {
    fputcsv($output, [
        $etudiant['id'],
        $etudiant['name'],
        $etudiant['section_name'],
        $etudiant['birthday']
    ]);
}

fclose($output);
exit;
