<?php
    require('session.php');
    require('dbconnect.php');
    require('header.php');
    require('navbar.php');

    $pbrand = isset($_GET['pbrand']) ? $_GET['pbrand'] : "";
    if ($pbrand != "") {
        $sql = "SELECT * FROM product WHERE ptype = 'Mainboard' AND pbrand = '$pbrand'";
    }
    else {
        $sql = "SELECT * FROM product WHERE ptype = 'Mainboard'";
    }
    $results = $conn->query($sql);
    ?>
<html>
    <head>
</head>
    <body>
    <div class="row">
    <div class="container-fluid">
    <form method="get" class="form-inline">
        Brand: &nbsp;
        <select name="pbrand" class="form-control">
            <option value="">All</option>
            <option value="AMD">AMD</option>
            <option value="INTEL">INTEL</option>
        </select> &nbsp;
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
        </div>
        <br>
        <?php
        
        while ($row = $results->fetch_assoc()) {
            ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="caption text-center">
                    <h2><?php echo $row['pbrand'] ?></h2>
                        <h5><b><?php echo $row['pname'] ?></b></h5>
                        <h5><?php echo $row['ptype'] ?></h5>
                        <h5>Price : <?php echo $row['price'] ?> Bath</h5>
                        <h5>Waranty : <?php echo $row['waranty'] ?> Years</h5>
                        <h5><?php echo $row['description'] ?></h5>
                    <?php
                        if($row['stock']!=0)
                        {
                            ?>
                            <p><a href="checkout.php?pid=<?php echo $row['pid'] ?>" class="btn btn-success" role="button">Buy now</a></p>
                            <?php
                        }
                        else{
                            ?>
                            <p><a href="" class="btn btn-danger" role="button">Out of Stock</a></p>
                            <?php
                        }?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

<?php
require('footer.php');
?>
</body>
</html>