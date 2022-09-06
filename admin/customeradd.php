<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $cid = $_POST['cid'];
    $citizenID = $_POST['citizenID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $registered_date = date('Y-m-d');
    $balance = 0;
    $password = $_POST['password'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO customer(cid, citizenID, firstname, lastname, email, telephone ,address ,registered_date,balance,password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssssssis', $cid, $citizenID, $firstname, $lastname, $email, $telephone, $address, $registered_date , $balance, $password);
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

    <h1>DSG's Gameshop: <small>Add Member</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="pid">Customer ID</label>
            <input type="text" name="cid" class="form-control">
        </div>
        <div class="form-group">
            <label for="pname">Citizen ID</label>
            <input type="text" name="citizenID" class="form-control">
        </div>
        <div class="form-group">
            <label for="pbrand">Firstname</label>
            <input type="text" name="firstname" class="form-control">
        </div>
        <div class="form-group">
            <label for="pbrand">Lastname</label>
            <input type="text" name="lastname" class="form-control">
        </div>
        <div class="form-group">
            <label for="pbrand">Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Telephone</label>
            <input type="text" name="telephone" class="form-control">
        </div>
        <div class="form-group">
            <label for="waranty">Address</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="stock">Password</label>
            <input type="text" name="password" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Register"> 
        <a href="customer.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>