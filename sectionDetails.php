<?php
// sectionDetails.php
require_once 'DBclass.php';

// Get the section ID from the URL
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];

    // Connect to the database
    $database = new Database();
    $connection = $database->Connect();

    // Fetch section info
    $stmt_section = $connection->prepare("SELECT * FROM section WHERE id = ?");
    $stmt_section->execute([$section_id]);
    $section = $stmt_section->fetch(PDO::FETCH_ASSOC);

    // Fetch students for this section
    $stmt_students = $connection->prepare("SELECT * FROM etudiant WHERE section_id = ?");
    $stmt_students->execute([$section_id]);
    $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);

    if ($section) {
        echo "<div class='container'>";
        echo "<h2 class='section-title'>Étudiants de la section " . htmlspecialchars($section['designation']) . "</h2>";

        if (count($students) > 0) {
            echo "<ul class='student-list'>";
            foreach ($students as $student) {
                echo "<li class='student-item'>" . htmlspecialchars($student['name']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='no-students'>Aucun étudiant dans cette section.</p>";
        }
        echo "</div>";
    } else {
        echo "<p class='error-message'>Section non trouvée.</p>";
    }
} else {
    echo "<p class='error-message'>Aucun identifiant de section fourni!</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link rel="stylesheet" href="styleDetailsSection.css">

    
</body>
</html>