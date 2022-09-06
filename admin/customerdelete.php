<?php
require('lock.php');
require('../dbconnect.php');

$cid = $_GET['cid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from customer where cid = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $cid);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: customer.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<div class="container-fluid">

    <h1>DSG Comshop: <small>Delete Product</small></h1>

    <?php
        $sql = "select * from customer where cid = '$cid'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <p>Are you sure you want to delete <br><h3>'<b><?php echo $line['cid'] ?> <?php echo $line['firstname'] ?> <?php echo $line['lastname'] ?></b>'?</h3></p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="customer.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?><br>
</body>
</html>