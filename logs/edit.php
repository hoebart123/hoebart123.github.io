<?php session_start() ?>

<!doctype html>
<html lang="nl">

<head>
    <title>TimeSheet / Logs / Bewerken</title>
    <?php require_once '../head.php'; ?>
</head>

<body>
    <?php require_once '../header.php'; ?>
<?php


require_once '../backend/conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM logs WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([":id" => $id]);
$log = $statement->fetch(PDO::FETCH_ASSOC);

if (!$log) {
    header("Location: index.php");
    exit;
}
?>

<div class="container">

    <h1>TimeSheet / Logs / Bewerken</h1>

    <form action="../backend/logsController.php" method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?php echo $log['id']; ?>">

        <div class="form-group">
            <label>Datum:</label>
            <p><?php echo htmlspecialchars($log['date']); ?></p>
        </div>

        <div class="form-group">
            <label for="duration">Duur (uren):</label>
            <input type="number" name="duration" id="duration" class="form-input" value="<?php echo htmlspecialchars($log['duration']); ?>" required>
        </div>

        <div class="form-group">
            <label>Afdeling:</label>
            <p><?php echo htmlspecialchars($log['department']); ?></p>
        </div>

        <input type="submit" value="Wijzigingen opslaan">
    </form>

    <br>

    <form action="../backend/logsController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze log wilt verwijderen?');">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="id" value="<?php echo $log['id']; ?>">
        <input type="submit" value="Verwijderen">
    </form>

    <p><a href="index.php">Terug naar overzicht</a></p>

</div>

</body>
</html>
