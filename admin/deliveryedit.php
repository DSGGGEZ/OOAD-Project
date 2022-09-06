<?php
require('lock.php');
require('../dbconnect.php');

$did = $_GET['did'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $trackno = $_POST['trackno'];
    $delivery_status = $_POST['delivery_status'];
    

    // Prepare sql and bind parameters
    $sql = "UPDATE delivery SET trackno = ? , delivery_status =? WHERE did = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssi', $trackno, $delivery_status , $did);
    $result = $statement->execute();

    // if($delivery_status=='จัดส่งสำเร็จ')
    // {
    //     $waranty_status = 'อยู่ในการรับประกัน';
    //     $sql4 = "INSERT INTO waranty(rid , waranty_status) VALUES (?,?)";
    //     $statement4 = $conn->prepare($sql4);
    //     $statement4->bind_param('is',$did,$waranty_status);
    //     $result4 = $statement4->execute();
    // }

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: delivery.php');
    
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
        $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid WHERE did = '$did'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>DSG's Gameshop: <small>Update Delivery</small></h1>

    <form method="post" class="form">
        <input type="hidden" class="did" name="did">
        <div class="form-group">
            <label for="pname">Product</label>
            <input type="text" name="" class="form-control" value="<?php echo $line['pid']." | ".$line['pname'] ?>" disabled>
        </div>
        <div class="form-group">
            <label for="pbrand">Customer</label>
            <input type="text" name="" class="form-control" value="<?php echo $line['cid']." | ".$line['firstname']." ".$line['lastname']  ?>" disabled>
        </div>
        <div class="form-group">
            <label for="pbrand">Bought Date</label>
            <input type="text" name="" class="form-control" value="<?php echo $line['bought_date'] ?>" disabled>
        </div>
        <div class="form-group">
            <label for="price">Total</label>
            <input type="text" name="" class="form-control" value="<?php echo $line['total'] ?>" disabled>
        </div>
        <div class="form-group">
            <label for="waranty">Address</label>
            <input type="text" name="" class="form-control" value="<?php echo $line['address'] ?>" disabled>
        </div>
        <div class="form-group">
            <label for="description">Track No.</label>
            <input type="text" name="trackno" class="form-control" value="<?php echo $line['trackno'] ?>">
        </div>
        <div class="form-group">
            <label for="delivery_status">Delivery Status</label>
            <select name="delivery_status" class="form-control">
                <option value="กำลังรอ">กำลังรอ</option>
                <option value="กำลังจัดส่ง">กำลังจัดส่ง</option>
                <option value="จัดส่งสำเร็จ">จัดส่งสำเร็จ</option>
                <option value="ยกเลิกคำสั่งซื้อ">ยกเลิกคำสั่งซื้อ</option>
            </select>
        </div>
        <input class="btn btn-warning" type="submit" value="Update Delivery"> 
        <a href="delivery.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?><br>
</body>
</html>