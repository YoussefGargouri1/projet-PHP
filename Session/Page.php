<?php
require_once 'Session.php';

$session = new Session();

$session->startSession();

$session->getVisites();

$session->incrementVisites();


if (isset($_POST['reset'])) {
    $session->reset();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$visites = $session->getVisites();
if ($visites == 1) {
    $message = "Bienvenue à notre plateforme.";
} else {
    $message = "Merci pour votre fidélité, c'est votre " . $visites . "ème visite.";
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page d'Accueil</title>
</head>

<body>
    <h1><?php echo $message; ?></h1>

    <form method="POST">
        <button type="submit" name="reset">Réinitialiser la session</button>
    </form>
</body>

</html>
