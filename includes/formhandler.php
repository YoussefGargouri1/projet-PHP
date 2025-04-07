<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    echo $username;

    try {
        require_once "dbhinc.php";

        //$query = "INSERT INTO users (username,pwd,email) VALUES 
        //($username,$password,$email);";

        $query = "INSERT INTO users (username,pwd,email) VALUES 
        (?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $password, $email]);
        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}
