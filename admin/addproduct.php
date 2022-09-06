<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $gid = $_POST['gid'];
    $idplatform = $_POST['idplatform'];
    $idgametype = $_POST['idgametype'];
    $iddevcompany = $_POST['iddevcompany'];
    $gamename = $_POST['gamename'];
    $picture = $_POST['picture'];
    $price = $_POST['price'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO game(gid, idplatform, idgametype, iddevcompany, gamename, picture ,price) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('siiissi', $gid, $idplatform, $idgametype, $iddevcompany, $gamename, $picture, $price);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: index.php');
    
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

    <h1>DSG's Gameshop: <small>Add product</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="gid">Game ID</label>
            <input type="text" name="gid" class="form-control">
        </div>
        <div class="form-group">
            <label for="gamename">Game name</label>
            <input type="text" name="gamename" class="form-control">
        </div>
        <div class="form-group">
            <label for="idplatform">Platform</label>
            <select name="idplatform" class="form-control">
                <?php
                $idplatform = $conn->query('select idplatform, platformname from platform');
                while($row = $idplatform->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idplatform'] ?>"><?php echo $row['platformname'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idgametype">Type</label>
            <select name="idgametype" class="form-control">
                <?php
                $idtypes = $conn->query('select idgametype, gametype from gametype');
                while($row = $idtypes->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idgametype'] ?>"><?php echo $row['gametype'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="iddevcompany">Developer Company</label>
            <select name="iddevcompany" class="form-control">
                <?php
                $iddevcompany = $conn->query('select iddevcompany, devcompanyname from devcompany');
                while($row = $iddevcompany->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['iddevcompany'] ?>"><?php echo $row['devcompanyname'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="text" name="picture" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>