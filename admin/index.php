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
$pbrand = isset($_GET['pbrand']) ? $_GET['pbrand'] : "";
$ptype = isset($_GET['ptype']) ? $_GET['ptype'] : "";
if ($pbrand != "" && $ptype != "") {
    $sql = "SELECT * FROM product WHERE pbrand = '$pbrand' AND type = '$ptype'";
}
else if ($pbrand != "") {
    $sql = "SELECT * FROM product WHERE pbrand = '$pbrand'";
}
else if ($ptype != "") {
    $sql = "SELECT * FROM product WHERE ptype = '$ptype'";
}
else {
    $sql = "SELECT * FROM product ";
}
$results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>DSG Comshop</h1>
    <h4><a href="index.php" >Product</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="customer.php" >Customer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="delivery.php" >Delivery</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="waranty.php" >Waranty</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="reciept.php" >Reciept</a><h4>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    
    <a href="productadd.php" class="btn btn-success pull-left" style="margin-left: 10px">Add Product</a>

    
    </div>
    <br>
</div>
<div class="container-fluid">
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
        </div>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Waranty</th>
                <th>Description</th>
                <th>Price</th>
                <th>In stock</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['pid'] ?></td>
                <td><?php echo $row['pname'] ?></td>
                <td><?php echo $row['pbrand'] ?></td>
                <td><?php echo $row['ptype'] ?></td>
                <td><?php echo $row['waranty'] ?></td>
                <td><?php echo $row['description'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td><?php echo $row['stock'] ?></td>
                <td class="text-center">
                    <a href="productedit.php?pid=<?php echo $row['pid'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="productdelete.php?pid=<?php echo $row['pid'] ?>" class="btn btn-sm btn-danger">
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
