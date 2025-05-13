

<!doctype html>
<html lang="nl">

<head>
    <title>TimeSheet</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; ?>
    
    <div class="container">

        <h1>TimeSheet / Registreren</h1>
        <?php
        if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        }
        ?>

        <form action="backend/registerController.php" method="POST">
                        <div class="form-group">
                <label for="username">gebruikersnaam:</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="name">naam:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password" placeholder="pass">
            </div>
            <div>
                <label for="password_check">Herhaal wachtwoord:</label>
                <input type="password" name="password_check" required><br>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>

</body>

</html>
