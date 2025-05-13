<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// 1. Verbinding
require_once 'conn.php';

// 2. Query
$query = "SELECT * FROM users WHERE username = :username";

// 3. Prepare
$statement = $conn->prepare($query);

// 4. Execute
$statement->execute([":username" => $username]);

// 5. Fetch
$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Gebruikersnaam bestaat niet.");
}

if (!password_verify($password, $user['password'])) {
    die("Wachtwoord is onjuist.");
}

// 6. Save session and redirect
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['username'];

header("Location: ../index.php?msg=ingelogd");
exit;
?>
