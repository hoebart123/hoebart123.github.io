<?php
session_start();
$action = $_POST['action'];

if($action == 'create')
{
    //Validatie
    $date = $_POST['date'];
    if(empty($date))
    {
        $errors[] = "Vul een datum in!";
    }

    $duration = $_POST['duration'];
    if(empty($duration))
    {
        $errors[] = "Vul een duur in!";
    }

    $department = $_POST['department'];
    if(empty($department))
    {
        $errors[] = "Vul een afdeling in!";
    }

    //Evt. errors dumpen
    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    $user = $_SESSION['user_id'];

    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO logs (department, date, duration, user) 
    VALUES(:department, :date, :duration, :user)";


    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
    ":department" => $department,
    ":date" => $date,
    ":duration" => $duration,
    ":user" => $user
]);
    header("Location: ../logs/index.php");
    exit;
}

if ($action == "update") {
    $id = $_POST['id'];
    $duration = $_POST['duration'];

    if (empty($duration)) {
        $errors[] = "Vul een duur in!";
    }

    if (isset($errors)) {
        var_dump($errors);
        die();
    }

    require_once 'conn.php';

    $query = "UPDATE logs SET duration = :duration WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":duration" => $duration,
        ":id" => $id
    ]);

    header("Location: ../logs/index.php");
    exit;
}

if ($action == "delete") {
    $id = $_POST['id'];

    require_once 'conn.php';

    $query = "DELETE FROM logs WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([":id" => $id]);

    header("Location: ../logs/index.php");
    exit;
}