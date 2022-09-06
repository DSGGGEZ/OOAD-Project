<?php
require('lock.php');
require('../dbconnect.php');

$cid = $_GET['cid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $citizenID = $_POST['citizenID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $balance = $_POST['balance'];
    $password = $_POST['password'];

    // Prepare sql and bind parameters
    $sql = "UPDATE customer SET citizenID = ? , firstname = ? , lastname = ? , email = ? , telephone = ? , address = ? , balance = ? , password = ? WHERE cid = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssssiss',$citizenID, $firstname, $lastname, $email, $telephone, $address , $balance, $password, $cid);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: customer.php');
    
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
        $sql = "select * from customer where cid = '$cid'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>DSG's Gameshop: <small>Edit Customer</small></h1>

    <form method="post" class="form">
        <input type="hidden" class="cid" name="cid">
        <div class="form-group">
            <label for="pname">Customer ID</label>
            <input type="text" name="cid" class="form-control" value="<?php echo $line['cid'] ?>" disabled>
        </div>
        <div class="form-group">
            <label for="pname">Citizen ID</label>
            <input type="text" name="citizenID" class="form-control" value="<?php echo $line['citizenID'] ?>">
        </div>
        <div class="form-group">
            <label for="pbrand">Firstname</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $line['firstname'] ?>">
        </div>
        <div class="form-group">
            <label for="pbrand">Lastname</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $line['lastname'] ?>">
        </div>
        <div class="form-group">
            <label for="price">Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $line['email'] ?>">
        </div>
        <div class="form-group">
            <label for="waranty">Telephone</label>
            <input type="text" name="telephone" class="form-control" value="<?php echo $line['telephone'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $line['address'] ?>">
        </div>
        <div class="form-group">
            <label for="stock">Balance</label>
            <input type="text" name="balance" class="form-control" value="<?php echo $line['balance'] ?>">
        </div>
        <div class="form-group">
            <label for="stock">Password</label>
            <input type="text" name="password" class="form-control" value="<?php echo $line['password'] ?>">
        </div>
        <input class="btn btn-warning" type="submit" value="Edit Customer"> 
        <a href="customer.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>