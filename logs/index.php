<?php
session_start();
?>

<!doctype html>
<html lang="nl">
<head>
    
    <title>TimeSheet / Logs</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
        <?php require_once '../header.php'; ?>

<?php
require_once '../backend/config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}



require_once '../backend/conn.php';

// Basisquery: logs ophalen van ingelogde gebruiker
if(!isset($_GET['department']) || empty($_GET['department'])) {
    $query = "SELECT * FROM logs WHERE user = :user ORDER BY date DESC";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':user' => $_SESSION['user_id']
    ]);
} else {
    // Als filter actief is
    $query = "SELECT * FROM logs WHERE user = :user AND department = :department ORDER BY date DESC";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':user' => $_SESSION['user_id'],
        ':department' => $_GET['department']
    ]);
}

$logs = $statement->fetchAll(PDO::FETCH_ASSOC);
$logCount = count($logs);
?>

<div class="container">

    <h1>TimeSheet / Logs</h1>
    <a href="create.php">Nieuwe log maken &gt;</a>

    <!-- Filter en log-count -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin: 20px 0;">
        <p><strong>Aantal logs: <?php echo $logCount; ?></strong></p>

        <form action="" method="GET">
    <select name="department" id="department">
        <option value="">        geen filter</option>
        <option value="attractie">Attracties (gastheer/vrouw)</option>
        <option value="horeca">Restaurants en cafes</option>
        <option value="techniek">Technische dienst</option>
        <option value="groen">Groenbeheer</option>
        <option value="klantenservice">Klantenservice</option>
        <option value="personeel">Personeel en HR</option>
        <option value="inkoop">Inkoop</option>
    </select>
    <input type="submit" value="filter">
</form>

    </div>

    <table>
        <tr>
            <th>Duur</th>
            <th>Afdeling</th>
            <th>Datum &downarrow;</th>
            <th>Gebruikers-id</th>
            <th>Acties</th>
        </tr>
        <?php foreach($logs as $log): ?>
            <tr>
                <td><?php echo $log['duration'] . 'u'; ?></td>
                <td><?php echo ucfirst($log['department']); ?></td>
                <td><?php echo $log['date']; ?></td>
                <td>#<?php echo $log['user']; ?></td>
                <td><a href="edit.php?id=<?php echo $log['id']; ?>">Aanpassen</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

</body>

</html>
