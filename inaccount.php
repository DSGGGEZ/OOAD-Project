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
$pbrand = isset($_GET['pbrand']) ? $_GET['pbrand'] : "";
$ptype = isset($_GET['ptype']) ? $_GET['ptype'] : "";
    if ($pbrand != "" && $ptype != "") {
        $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid WHERE delivery.cid = '$cid' AND product.pbrand = '$pbrand' AND product.type = '$ptype' ";
    }
    else if ($pbrand != "") {
        $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid WHERE delivery.cid = '$cid' AND product.pbrand = '$pbrand'  ";
    }
    else if ($ptype != "") {
        $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid WHERE delivery.cid = '$cid' AND product.ptype = '$ptype'";
    }
    else {
        $sql = "SELECT * FROM delivery LEFT JOIN product ON delivery.pid=product.pid LEFT JOIN customer ON delivery.cid=customer.cid WHERE delivery.cid = '$cid'";
    }
    $results = $conn->query($sql);
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
    <h2>Delivery</h2>
    <form method="get" class="form-inline">
        Brand: &nbsp;
        <select name="pbrand" class="form-control">
            <option value="">All</option>
            <option value="AMD">AMD</option>
            <option value="INTEL">INTEL</option>
            <option value="NVIDIA">NVIDIA</option>
            <option value="G.Skill">G.Skill</option>
            <option value="Kingston">Kingston</option>
            <option value="Corsair">Corsair</option>
            <option value="Apacer">Apacer</option>
            <option value="Adata">Adata</option>
            <option value="ROG">ROG</option>
            <option value="BIOSTAR">BIOSTAR</option>
            
        </select> &nbsp;
        Type:
        <select name="ptype" class="form-control">
            <option value="">All</option>
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
        </select> &nbsp; &nbsp;
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Product</th>
                <th>Bought Date</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
            <td><?php echo $row['pname'] ?><br><b>Brand : </b><?php echo $row['pbrand'] ?> <b>Type : </b><?php echo $row['ptype'] ?></td>
                <td><?php echo $row['bought_date'] ?></td>
                <td><?php echo $row['total'] ?></td>
                <td><?php echo $row['delivery_status'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    </div>
<?php
require('footer.php');
?>
</body>
</html>