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
$cusid = isset($_GET['cusid']) ? $_GET['cusid'] : "";
if ($cusid != "") {
    $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid WHERE customer.cid LIKE '%$cusid%' ORDER BY did DESC";
}
else {
    $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid ORDER BY did DESC";
}
$results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>DSG Comshop</h1>
    <h4><a href="index.php" >Product</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="customer.php" >Customer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="delivery.php" >Delivery</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="waranty.php" >Waranty</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="reciept.php" >Reciept</a><h4>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>

    
    </div>
    <br>
</div>
<div class="container-fluid">
<form method="get" class="form-inline">
        Search from Customer ID: &nbsp;
        <input type="text" class="form-control" name="cusid">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
        </div>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Product</th>
                <th>Customer</th>
                <th>Bought Date</th>
                <th>Total (Baht)</th>
                <th>Delivery Address</th>
                <th>Track No.</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><b><?php echo $row['pid'] ?></b><br><?php echo $row['pname'] ?><br><b>Brand : </b><?php echo $row['pbrand'] ?> <b>Type : </b><?php echo $row['ptype'] ?></td>
                <td><b><?php echo $row['cid'] ?></b> <br><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?><br><b>Telephone : </b><?php echo $row['telephone'] ?></td>
                <td><?php echo $row['bought_date'] ?></td>
                <td><?php echo $row['total'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['trackno'] ?></td>
                <td><?php echo $row['delivery_status'] ?></td>
                <td class="text-center">
                    <a href="deliveryedit.php?did=<?php echo $row['did'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
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
