<?php
require('lock.php');
require('../dbconnect.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container" >
<?php
$firstname = isset($_GET['firstname']) ? $_GET['firstname'] : "";
if ($firstname != "" ) {
    $sql = "SELECT * FROM customer WHERE firstname LIKE '%$firstname%'";
}
else {
    $sql = "SELECT * FROM customer ";
}
$results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>DSG Comshop</h1>
    <h4><a href="index.php" >Product</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="customer.php" >Customer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="delivery.php" >Delivery</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="waranty.php" >Waranty</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="reciept.php" >Reciept</a><h4>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    
    <a href="customeradd.php" class="btn btn-success pull-left" style="margin-left: 10px">Add Customer</a>

    
    </div>
    <br>
</div>
<div class="container-fluid">
    <form method="get" class="form-inline">
        Search: &nbsp;
        <input type="text" class="form-control" name="firstname">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
        </div>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>CustomerID</th>
                <th>CitizenID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Address</th>
                <th>Registered Date</th>
                <th>Balance</th>
                <th>Password</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['cid'] ?></td>
                <td><?php echo $row['citizenID'] ?></td>
                <td><?php echo $row['firstname'] ?></td>
                <td><?php echo $row['lastname'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['telephone'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['registered_date'] ?></td>
                <td><?php echo $row['balance'] ?></td>
                <td><?php echo $row['password'] ?></td>
                <td class="text-center">
                    <a href="customeredit.php?cid=<?php echo $row['cid'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="customerdelete.php?cid=<?php echo $row['cid'] ?>" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<?php
$conn->close();

?>
<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
<script>
$('.dropdown-toggle').dropdown()
</script>
</body>
</html>
