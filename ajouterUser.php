<?php
require_once 'User.php';

$userRepo = new User();

if (isset($_POST['add_user'])) {
    $username = htmlspecialchars(trim($_POST['new_username']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $role = $_POST['role'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'adresse e-mail n'est pas valide.";
    } else {
        // Check if username exists
        $existing = $userRepo->findByUsername($username);
        if ($existing) {
            $error = "Ce nom d'utilisateur existe déjà.";
        } else {
            // Insert new user
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="ajouterUser.css">
</head>
<body>

<?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
<?php if (isset($message)) { echo "<p style='color:green;'>$message</p>"; } ?>
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
