<?php
    require('session.php');
    require('dbconnect.php');
    require('header.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG Comshop | In Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
    $cid = $_SESSION['customer'];
    $sql = "SELECT * FROM customer WHERE cid = '$cid'";
    $results = $conn->query($sql);
    $row = $results->fetch_assoc()
    ?>
<div class="container-fluid">
    <ul class="nav navbar-nav navbar-left">
            <li class='user user-menu'>
            <a href='inaccount.php'>Delivery</a></li>
            <li><a href='waranty.php'>Waranty</a></li>
            <li><a href='profile.php'>Profile</a></li>
        </ul>
        <a href="topup.php" class="btn btn-success pull-right" style="margin-left: 10px">Top up</a>
        <br>
        <br>

    <h2>Profile<a href="editprofile.php" class="btn btn-warning pull-right" style="margin-left: 10px">Edit profile</a></h2>
    <table class="table table" style="margin-top: 20px">
        <tbody>
            <tr>
                <th>Customer ID :</th>
                <td><?php echo $row['cid'] ?></th>
            </tr>
            <tr>
                <th>CitizenID :</td>
                <td><?php echo $row['citizenID'] ?></td>
            </tr>
            <tr>
                <th>Firstname :</td>
                <td><?php echo $row['firstname'] ?></td>
            </tr>
            <tr>
                <th>Lastname :</td>
                <td><?php echo $row['lastname'] ?></td>
            </tr>
            <tr>
                <th>Email :</td>
                <td><?php echo $row['email'] ?></td>
            </tr>
            <tr>
                <th>Telephone :</td>
                <td><?php echo $row['telephone'] ?></td>
            </tr>
            <tr>
                <th>Address :</td>
                <td><?php echo $row['address'] ?></td>
            </tr>
            <tr>
                <th>Registered Date :</td>
                <td><?php echo $row['registered_date'] ?></td>
            </tr>
            <tr>
                <th>Balance :</td>
                <td><?php echo $row['balance'] ?></td>
            </tr>
            <tr>
                <th>Password :</td>
                <td><?php echo $row['password'] ?></td>
            </tr>
        </tbody>
    </table>
    </div>
<?php
require('footer.php');
?>
</body>
</html>