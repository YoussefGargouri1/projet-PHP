<?php 
require_once 'DBclass.php';
$query = "SELECT * FROM etudiant";
$database = new Database();
$connection = $database->Connect();
$stmt = $connection->query($query);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<link rel="stylesheet" type="text/css" href="listeEtudiant.css">';


echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nom</th><th>Birthday</th><th></th></tr>";
foreach ($etudiants as $etudiant) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($etudiant['id']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['nom']) . "</td>";
    echo "<td>" . htmlspecialchars($etudiant['birthday']) . "</td>";
    echo "<td><a href='detailEtudiant.php?id=" . urlencode($etudiant['id']) . "'><img src='info (1).png' alt='Info Image' width = 20px style='cursor: pointer;'></a></td>";

    //echo"<td> <img src = 'info (1).png' alt = 'info' width = 20px > </td>";
    echo "</tr>";
}

?>