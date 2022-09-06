<?php
require('lock.php');
require('../dbconnect.php');

$pid = $_GET['pid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $pname = $_POST['pname'];
    $pbrand = $_POST['pbrand'];
    $ptype = $_POST['ptype'];
    $price = $_POST['price'];
    $waranty = $_POST['waranty'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    // Prepare sql and bind parameters
    $sql = "UPDATE product SET pname = ? , pbrand =? , ptype = ? , price = ? , waranty = ? , description = ? , stock = ? WHERE pid = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssiisis', $pname, $pbrand, $ptype, $price, $waranty, $description, $stock, $pid);
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
</head>
<body class="container">
<div class="container-fluid">
    <?php
        $sql = "select * from product where pid = '$pid'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>DSG's Gameshop: <small>Edit product</small></h1>

    <form method="post" class="form">
        <input type="hidden" class="pid" name="pid">
        <div class="form-group">
            <label for="pname">Product Name</label>
            <input type="text" name="pname" class="form-control" value="<?php echo $line['pname'] ?>">
        </div>
        <div class="form-group">
            <label for="pbrand">Brand</label>
            <input type="text" name="pbrand" class="form-control" value="<?php echo $line['pbrand'] ?>">
        </div>
        <div class="form-group">
            <label for="pbrand">Product Type</label>
            <input type="text" name="pbrand" class="form-control" value="<?php echo $line['pbrand'] ?>">
        </div>
        <div class="form-group">
            <label for="ptype">Product Type</label>
            <select name="ptype" class="form-control">
                <option value="CPU">CPU</option>
                <option value="GPU">GPU</option>
                <option value="Mainboard">Mainboard</option>
                <option value="RAM">RAM</option>
                <option value="Power Supply">Power Supply</option>
                <option value="HDD">HDD</option>
                <option value="SSD">SSD</option>
                <option value="Case">Case</option>
                <option value="Monitor">Monitor</option>
                <option value="Cooling">Cooling</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo $line['price'] ?>">
        </div>
        <div class="form-group">
            <label for="waranty">Waranty</label>
            <input type="text" name="waranty" class="form-control" value="<?php echo $line['waranty'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" value="<?php echo $line['description'] ?>">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" name="stock" class="form-control" value="<?php echo $line['stock'] ?>">
        </div>
        <input class="btn btn-warning" type="submit" value="Edit product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>