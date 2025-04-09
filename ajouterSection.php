<?php 
    require_once 'Repository.php';
    
    $host = 'localhost';
    $db_name = 'systemeGestion';
    $username = 'root';
    $password = 'Mytech6624';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
    
    $sectionRepository = new Repository($pdo, 'section');

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $designation = htmlspecialchars($_POST['designation']); 
        $description = htmlspecialchars($_POST['description']); 

        // Créer les données à insérer
        $data = [
            'designation' => $designation,
            'description' => $description
        ];

        // Ajouter la section
        $sectionRepository->create($data);
        echo "<div class='success-message'>La section a été ajoutée avec succès !</div>";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une section</title>
    <link rel="stylesheet" href="styleAddSection.css">
    
</head>
<body>
    <div class="container">
        <h1>Ajouter une section</h1>
        <form action="add_section.php" method="POST">
            <label for="designation">Désignation de la section :</label>
            <input type="text" id="designation" name="designation" required>

            <label for="description">Description de la section :</label>
            <textarea id="description" name="description" required></textarea>

            <button type="submit">Ajouter la section</button>
        </form>
    </div>
</body>
</html>

