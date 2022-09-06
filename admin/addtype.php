<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $idgametype = $_POST['idgametype'];
    $gametype = $_POST['gametype'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO gametype(idgametype,gametype) VALUES(?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ss', $idgametype,$gametype);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: other.php');
    
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
  background-color:black
}
body {
    background-color:#241B44;
}
div{
    background-color:white;
}
</style>
</head>
<body class="container">
<div class="container-fluid">

    <h1>DSG's Gameshop: <small>Add Gametype</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="idgametype">id</label>
            <input type="text" name="idgametype" class="form-control">
        </div>
        <div class="form-group">
            <label for="gametype">Gametype</label>
            <input type="text" name="gametype" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add Gametype"> 
        <a href="other.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>