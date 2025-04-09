<?php
session_start();
require_once 'User.php';


$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
$userRepo = new User();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    if(isset($_POST['login'])) {

        $username = $_POST['username'];
        $user = $userRepo->findByUsername($username);
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            header("Location: listeEtudiants.php");
            exit;
        } else {
            $error = "Utilisateur introuvable";
        }
    }   


    if (isset($_POST['add_user'])) {
    $username = trim($_POST['new_username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    $existing = $userRepo->findByUsername($username);
    if ($existing) {
        $error = "Ce nom d'utilisateur existe déjà.";
    } else {
        $data = [
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];
        $userRepo->create($data);
        $message = "Utilisateur ajouté avec succès.";
    }
}   

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

    <!-- Navigation -->
    <div class="navbar">
        <span class="brand">Students Management System</span>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="listeEtudiants.php">Liste des étudiants</a>
            <a href="listeSection.php">Liste des sections</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Welcome message -->
    <div class="welcome" >
        <h1>Hello, Welcome to your</h1>
        <h1>administration Platform</h1>
    </div>

    


    <div class="login-container">
    <h2>Se connecter</h2>
    
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (isset($message)) echo "<p class='success-message'>$message</p>"; ?>


    <form method="POST">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>
        <button type="submit" name='login'>Se connecter</button>
    </form>
    </div>


    <h3>Ajouter un nouvel utilisateur</h3>
    <form method="POST" class="auth-form">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="new_username" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Rôle :</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="administrateur">administrateur</option>
        </select>

        <button type="submit" name="add_user">Ajouter</button>
    </form>


</body>
</html>

