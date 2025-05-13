<?php session_start() ?>
<!doctype html>
<html lang="nl">

<head>
    <title>TimeSheet / Logs / Nieuw</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php';
    
    
    if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}?>
    <div class="container">

    

        <h1>TimeSheet / Logs / Nieuw</h1>

        <form action="../backend/logsController.php" method="POST">
            <input type="hidden" name="action" value="create">
        
            <div class="form-group">
                <label for="date">Datum:</label>
                <input type="date" name="date" id="date" class="form-input" value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="form-group">
                <label for="duration">Duur (uren):</label>
                <input type="number" name="duration" id="duration" class="form-input">
            </div>
            <div class="form-group">
                <label for="department">Afdeling:</label>
                   <select name="department">
                    <option value="horeca">horeca</option>
                    <option value="personeel">personeel</option>
                    <option value="techniek">techniek</option>
                    <option value="klantenservice">klantenservice</option>
                    <option value="groen">groen</option>
                    <option value="attractie">attractie</option>
                   </select>

                
            </div>

            <input type="submit" value="Log opslaan">


    </div>

</body>

</html>
