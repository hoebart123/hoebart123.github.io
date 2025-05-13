<?php
require_once 'conn.php';

$username = $_POST['username'] ?? '';
$name = $_POST['name'] ?? '';
$password = $_POST['password'] ?? '';
$password_check = $_POST['password_check'] ?? '';

if (empty($username)) {
    die("Gebruikersnaam mag niet leeg zijn.");
}

if (empty($name)) {
    die("Naam mag niet leeg zijn.");
}

if (empty($password)) {
    die("Wachtwoord mag niet leeg zijn.");
}

if ($password !== $password_check) {
    die("Wachtwoorden komen niet overeen.");
}

$query = "SELECT * FROM users WHERE username = :username OR name = :name";
$statement = $conn->prepare($query);
$statement->execute([
    ':username' => $username,
    ':name' => $name
]);
$user = $statement->fetch();

if ($user) {
    die("Gebruiker bestaat al.");
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, name, password) VALUES (:username, :name, :hash)";
$stmt = $conn->prepare($query);
$stmt->execute([
    ':username' => $username,
    ':name' => $name,
    ':hash' => $hash
]);

header("Location: " . $base_url . "/login.php");
exit;
?>
