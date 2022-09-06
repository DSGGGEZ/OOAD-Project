<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $iddevcompany = $_POST['iddevcompany'];
    $devcompanyname = $_POST['devcompanyname'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO devcompany(iddevcompany,devcompanyname) VALUES(?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ss', $iddevcompany,$devcompanyname);
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

    <h1>DSG's Gameshop: <small>Add Developer Company</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="iddevcompany">id</label>
            <input type="text" name="iddevcompany" class="form-control">
        </div>
        <div class="form-group">
            <label for="devcompanyname">Developer Company name</label>
            <input type="text" name="devcompanyname" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add Company"> 
        <a href="other.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
    <br>
</body>
</html>