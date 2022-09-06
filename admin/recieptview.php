<?php
    require('lock.php');
    require('../dbconnect.php');

    $rid = $_GET['rid'];

    $sql = "SELECT * FROM reciept LEFT JOIN product ON reciept.pid=product.pid LEFT JOIN customer ON reciept.cid=customer.cid WHERE reciept.rid= '$rid'";
    $results = $conn->query($sql);
    $rowsi = $results->fetch_assoc();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG Comshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>DSG Comshop: <small>Reciept View</small></h1>
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
                <td colspan="2"><h4><b>วันที่/Date : </b><?php echo $rowsi['bought_date'] ?></h4></td>
            </tr>
            <tr>
                <th>Product ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
            <tr>
                <th><h4><?php echo $rowsi['pid'] ?></h4></th>
                <th><h4><?php echo $rowsi['ptype']." ".$rowsi['pname'] ?></h4></th>
                <th><h4><?php echo 1 ?></h4></th>
                <th><h4><?php echo $rowsi['total'] ?> บาท</h4></th>
            </tr>
            <tr>
                <th colspan="2"><h4><b>Total</h4></th>
                <th colspan="2"><h4><?php echo $rowsi['total'] ?> บาท</h4></th>
            </tr>
        </tbody>
        <table style="margin-top: 20px">
        <tr>
            <th><p style="color: white;">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p></th>
            <th align="right">
            <form method="post">
            <a href="reciept.php" class="btn btn-warning">Back</a>
        </th>
        </tr>
        </form>
        </table>
    
    

    
    

<?php
$conn->close();
?>
</body>
</html>