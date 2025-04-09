<?php
require_once 'Etudiant.php';
require_once 'Section.php';

$sectionRepo = new Section();
$sections = $sectionRepo->findAll();

$etudiantRepo = new Etudiant();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'birthday' => $_POST['birthday'],
        'image' => $_POST['image'], // or handle upload later
        'section_id' => $_POST['section_id']
    ];

    $etudiantRepo->create($data);

    // Redirect to list
    header("Location: listeEtudiants.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="ajouterEtudiant.css">

</head>
<body>

    <div class="navbar">
        <span class="brand">Students Management System</span>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="listeEtudiants.php">Liste des étudiants</a>
        </div>
    </div>

    <div style="max-width: 500px; margin: 40px auto;">
        <h2>Ajouter un étudiant</h2>

        <form method="POST">
            <label>Nom complet :</label><br>
            <input type="text" name="name" required><br><br>

            <label>Date de naissance :</label><br>
            <input type="date" name="birthday" required><br><br>

            <label>Image (chemin) :</label><br>
            <input type="text" name="image" placeholder="img/photo.jpg"><br><br>

            <label>Section :</label><br>
            <select name="section_id" required>
                <option value="">-- Sélectionner --</option>
                <?php foreach ($sections as $section): ?>
                    <option value="<?= $section['id'] ?>"><?= htmlspecialchars($section['designation']) ?></option>
                <?php endforeach; ?>
            </select><br><br>
            
            

            <button type="submit">Ajouter</button>
        </form>
    </div>

</body>
</html>
