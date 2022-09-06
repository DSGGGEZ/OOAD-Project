<?php
require('lock.php');
require('../dbconnect.php');
$idmember = $_GET['idmember'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    
    $mid = $_POST['mid'];
    $mpassword = $_POST['mpassword'];
    $mname = $_POST['mname'];
    $address = $_POST['address'];
    $balance = $_POST['balance'];

    // Prepare sql and bind parameters
    $sql = "UPDATE member SET mid = ? , mpassword =? , mname = ? , address = ? , balance = ? WHERE idmember = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssii', $mid, $mpassword, $mname, $address, $balance,$idmember);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: member.php');
    
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<div class="container-fluid">
    <?php
        $sql = "select * from member where idmember = '$idmember'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>DSG's Gameshop: <small>Edit Member</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="mid">mid</label>
            <input type="text" name="mid" class="form-control" value="<?php echo $line['mid'] ?>">
        </div>
        <div class="form-group">
            <label for="mpassword">password</label>
            <input type="text" name="mpassword" class="form-control" value="<?php echo $line['mpassword'] ?>">
        </div>
        <div class="form-group">
            <label for="mname">Member Name</label>
            <input type="text" name="mname" class="form-control" value="<?php echo $line['mname'] ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $line['address'] ?>">
        </div>
        <div class="form-group">
            <label for="balance">Balance</label>
            <input type="text" name="balance" class="form-control" value="<?php echo $line['balance'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" value="Edit Member"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>