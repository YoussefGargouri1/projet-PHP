<?php 

echo '<link rel="stylesheet" type="text/css" href="detailEtudiant.css">';

if (!isset($_GET['id'])) {
    die("ID not provided.");
}
require_once 'DBclass.php';
$studentId = $_GET['id'];
$database = new Database();
$connection = $database->Connect();
$query = "SELECT * FROM etudiant WHERE id = :id";


$stmt = $connection->prepare($query);
$stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
$stmt->execute();

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if ($student) {
    echo"<div>";
    echo "<h1>Student Details</h1>";
    echo "<p><strong>ID:</strong> " . htmlspecialchars($student['id']) . "</p>";
    echo "<p><strong>Name:</strong> " . htmlspecialchars($student['name']) . "</p>";
    echo "<p><strong>Image:</strong> <img src='" . htmlspecialchars($student['image']) . "' alt='Student Image' width='100px'></p>";
    echo "<p><strong>Birthday:</strong> " . htmlspecialchars($student['birthday']) . "</p>";
    echo "</div>";
} else {
    echo "<p>No student found with this ID.</p>";
}

?>