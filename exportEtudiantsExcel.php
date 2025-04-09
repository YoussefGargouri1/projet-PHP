<?php
session_start();

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page.";
    header('Location: index.php');
    exit;
}

require_once 'Etudiant.php';
require_once 'DBclass.php';

// Récupérer les données des étudiants
$etudiantRepo = new Etudiant();
$search = $_GET['search'] ?? ''; // Récupère la recherche, si elle existe
$etudiants = ($search !== '') ? $etudiantRepo->findByName($search) : $etudiantRepo->findAllWithSection();

// Définir les en-têtes HTTP pour forcer le téléchargement du fichier Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=etudiants.xls");

// Créer le contenu du tableau Excel
echo '<table border="1">';
echo "<tr><th>ID</th><th>Nom</th><th>Filière</th><th>Birthday</th></tr>";

// Remplir les lignes avec les données des étudiants
foreach ($etudiants as $etudiant) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($etudiant['id']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['name']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['section_name']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['birthday']) . "</td>";
    echo "</tr>";
}

echo "</table>";

exit();  // Terminer le script après l'exportation
?>
