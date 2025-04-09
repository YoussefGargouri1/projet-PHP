<?php
    $host = 'localhost';
    $db_name = 'systemeGestion';
    $username = 'root';
    $password = 'Mytech6624';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
    // Créer une instance du Repository pour la table 'section'
$sectionRepository = new Repository($pdo, 'section');

// Tester findAll() pour la table 'section'
$sections = $sectionRepository->findAll();
print_r($sections);

// Tester findById() pour la table 'section'
$section = $sectionRepository->findById(1);
print_r($section);
?>