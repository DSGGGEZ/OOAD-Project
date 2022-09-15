<?php
    require('session.php');
    require('dbconnect.php');

    $pid = $_GET['pid'];
    $cid = $_SESSION['customer'];

    $sqli = "select * from product where pid = '$pid'";
    $res = $conn->query($sqli);
    $rows = $res->fetch_assoc();

    $sqlii = "select * from customer where cid = '$cid'";
    $resii = $conn->query($sqlii);
    $rowsi = $resii->fetch_assoc();

    $balance = $rowsi['balance']-$rows['price'];
    $stock = $rows['stock']-1;
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $bought_date= date('Y-m-d');
    $total = $rows['price'];
    $delivery_status = "กำลังรอ";

    $sql = "INSERT INTO delivery(pid , cid,bought_date,total,delivery_status) VALUES (?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssss',$pid,$cid,$bought_date,$total,$delivery_status);
    $result = $statement->execute();

    
    $sql2 = "UPDATE customer SET balance = ? WHERE cid = '$cid'";
    $statement2 = $conn->prepare($sql2);
    $statement2->bind_param('i',$balance);
    $result2 = $statement2->execute();

    $sql3 = "UPDATE product SET stock = ? WHERE pid = ?";
    $statement3 = $conn->prepare($sql3);
    $statement3->bind_param('is',$stock,$pid);
    $result3 = $statement3->execute();

    $sql4 = "INSERT INTO order(pid , cid, bought_date, total) VALUES (?,?,?,?)";
    $statement4 = $conn->prepare($sql4);
    $statement4->bind_param('ssss',$pid,$cid,$bought_date,$total);
    $result4 = $statement4->execute();

    $sql5 = "INSERT INTO reciept(pid , cid, bought_date, total) VALUES (?,?,?,?)";
    $statement5 = $conn->prepare($sql4);
    $statement5->bind_param('ssss',$pid,$cid,$bought_date,$total);
    $result5 = $statement5->execute();

    // Execute sql and check for failure
    if (!$result4) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: inaccount.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG Comshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>DSG Comshop: <small>Buy product</small></h1>
    <br>
    <table class="table table" style="margin-top: 20px">
        <tbody>
            <tr>
                <td colspan="4"><center><h2>DSG Comshop</h2><h4>290/95 หมู่ 7 ต.ท่าโพธิ์ อ.เมืองพิษณุโลก จ.พิษณุโลก</h4></center></td>
            <tr>
            <tr>
                <td colspan="4"><center><h3><b>Reciept</b></h3></center></td>
            <tr>
                <td colspan="2"><h4><b>รหัสลูกค้า/CustomerID : </b><?php echo $rowsi['cid'] ?></h4><h4><b>ลูกค้า/Customer : </b><?php echo $rowsi['firstname']." ".$rowsi['lastname'] ?></h4><h4><b>ที่อยู่/Address : </b><?php echo $rowsi['address']?></h4></td>
                <td colspan="2"><h4><b>วันที่/Date : </b><?php echo date('Y-m-d'); ?></h4></td>
            </tr>
            <tr>
                <th>Product ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
            <tr>
                <th><h4><?php echo $rows['pid'] ?></h4></th>
                <th><h4><?php echo $rows['ptype']." ".$rows['pname'] ?></h4></th>
                <th><h4><?php echo 1 ?></h4></th>
                <th><h4><?php echo $rows['price'] ?> บาท</h4></th>
            </tr>
            <tr>
                <th colspan="2"><h4><b>Total</h4></th>
                <th colspan="2"><h4><?php echo $rows['price'] ?> บาท</h4></th>
            </tr>
        </tbody>
        <table style="margin-top: 20px">
        <tr>
            <th><p style="color: white;">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p></th>
            <th align="right">
            <form method="post">
            <?php
            if($rowsi['balance']>=$rows['price'])
            {
                ?>
                <input class="btn btn-danger" type="submit" value="BUY">
                <?php
            }
            else{
                ?>
                <h3>Not enogh balance</h3>
                <?php
            }?>
            <a href="index.php" class="btn btn-default">Cancel</a>
        </th>
        </tr>
        </form>
        </table>
    
    

    
    

<?php
$conn->close();
?>
</body>
</html>