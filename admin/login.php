<?php
session_start();
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the posted data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedUsername = md5($username);

    $expectedUsername = md5('DSGGGEZ');

    $hashedPassword = md5($password);

    $expectedPassword = md5('14022514'); // TODO: get from database

    if ($hashedPassword == $expectedPassword) {
        // Save in the session
        $_SESSION['loggedin'] = true;
        // Redirect
        header('Location: index.php');
        exit();
    }

    $error = "Incorrect username/password";
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
    <div class="container">

    <h1>DSG's Gameshop Admin <small>Login</small></h1>

    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    }
    ?>

    <form method="post" class="form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <input class="btn btn-primary" type="submit" value="Login">
    </form>
    <br>

<?php
$conn->close();
?>
</div>
</body>
</html>
