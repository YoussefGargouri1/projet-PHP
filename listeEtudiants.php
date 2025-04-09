<?php 
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page.";
    header('Location: index.php');
    exit;
}

require_once 'Etudiant.php';
require_once 'DBclass.php';

$etudiantRepo = new Etudiant();
$search = $_GET['search'] ?? '';
$etudiants = ($search !== '') ? $etudiantRepo->findByName($search) : $etudiantRepo->findAllWithSection();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <span class="brand">Students Management System</span>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="listeEtudiants.php">Liste des étudiants</a>
        <a href="listeSection.php">Liste des sections</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<?php if ($_SESSION['user']['role'] === 'administrateur'): ?>
    <div class="actions">
        <a href="ajouterEtudiant.php">
            <button type="button">Ajouter un étudiant</button>
        </a>
    </div>
<?php endif; ?>

<form method="GET" action="listeEtudiants.php" class="filter-form">
    <input type="text" name="search" placeholder="Rechercher par nom" 
           value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Filtrer</button>
</form>

<div class="actions">
    <a href="exportEtudiantsCSV.php<?= isset($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?>">
        <button type="button">Exporter en CSV</button>
    </a>

    <a href="exportEtudiantsExcel.php<?= isset($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?>">
        <button type="button">Exporter en Excel</button>
    </a>
    <a href="exportEtudiantsPDF.php<?= isset($_GET['search']) ? '?search=' . urlencode($_GET['search']) : '' ?>">
        <button type="button">Exporter en PDF</button>
    </a>
    
    
</div>

<?php 
echo '<link rel="stylesheet" type="text/css" href="listeEtudiant.css">';

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Image</th><th>Nom</th><th>Filière</th><th>Birthday</th><th>Action</th><th></th></tr>";
foreach ($etudiants as $etudiant) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($etudiant['id']) . "</td>";
    echo "<td><img src='" . htmlspecialchars($etudiant['image']) . "' alt='Student Image' width='100px'></td>";
    echo "<td>" . htmlspecialchars($etudiant['name']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['section_name']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['birthday']) . "</td>";
    echo "<td><a href='detailEtudiant.php?id=" . urlencode($etudiant['id']) . "'><img src='info (1).png' alt='Info Image' width='20px' style='cursor: pointer;'></a></td>";

    if ($_SESSION['user']['role'] === 'administrateur') {
        echo "<td>";
        echo '<form action="deleteEtudiant.php" method="POST" onsubmit="return confirm(\'Voulez-vous vraiment supprimer cet étudiant ?\');">';
        echo '<input type="hidden" name="id" value="' . $etudiant['id'] . '">';
        echo '<button type="submit" class="delete-btn">Supprimer</button>';
        echo '</form>';
        echo "</td>";
    } else {
        echo "<td></td>";
    }

    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>
