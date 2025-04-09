<?php
require_once 'Etudiant.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    
    $etudiantRepo = new Etudiant();
    $etudiantRepo->delete($_POST['id']);
}

// Redirect back
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
