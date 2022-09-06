<?php
    include 'session.php';
    include 'dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cid= $_POST['cid'];
        $password= $_POST['password'];

        $sql = "SELECT * FROM customer where cid= '$cid' and password = '$password'";
		$query = $conn->query($sql);

        if($query->num_rows > 0){
            $row = $query->fetch_assoc();
			$_SESSION['customer'] = $row['cid'];
			header('location: index.php');
        } 
        else{
            $_SESSION['error'] = 'Customer not found';
			header('location: login.php');
        }
    }
	else{
		$_SESSION['error'] = 'Enter Customer id first';
		header('location: login.php');
    }
?>
