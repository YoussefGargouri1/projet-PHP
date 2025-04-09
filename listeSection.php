<?php 
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Vous devez vous connecter pour accéder à cette page.";
    header('Location: index.php');
    exit;
}
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

</body>
</html>

<?php 
require_once 'DBclass.php';
$query = "SELECT * FROM section";
$database = new Database();
$connection = $database->Connect();
$stmt = $connection->query($query);
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<link rel="stylesheet" type="text/css" href="listeEtudiant.css">';

echo "<table border='1'>";
echo "<tr><th>ID</th><th>designation</th><th>description</th></tr>";

foreach ($sections as $section) {
    echo "<tr>";

    echo "<td>" . htmlspecialchars($section['id']) . "</td>";
    echo "<td>" . htmlspecialchars($section['designation']) . "</td>";
    echo "<td>" . htmlspecialchars($section['description']) . "</td>";
    
    echo "</tr>";
}

?>