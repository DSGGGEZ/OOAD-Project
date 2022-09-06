<?php
    include 'dbconnect.php';
    session_start();

if (isset($_SESSION['customer'])) {
    $sql = "SELECT * FROM customer WHERE cid = '".$_SESSION['customer']."'";
	$query = $conn->query($sql);
	$member = $query->fetch_assoc();
}
