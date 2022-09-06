<?php
require('lock.php');
require('../dbconnect.php');

$iddevcompany = $_GET['iddevcompany'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from devcompany where iddevcompany = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $iddevcompany);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: other.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>DSG's Gameshop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
  background-color:black
}
body {
    background-color:#241B44;
}
div{
    background-color:white;
}
</style>
</head>
<body class="container">
<div class="container-fluid">

    <h1>DSG's Gameshop: <small>Delete Devcompany</small></h1>

    <?php
    $sql = "select * from devcompany where iddevcompany = $iddevcompany";
    $mname = $conn->query($sql);
    $row = $mname->fetch_assoc();
    ?>
    <p>Are you sure you want to delete '<?php echo $row['devcompanyname'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="other.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?><br>
</body>
</html>