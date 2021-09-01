<?php
	require 'connect.php';
	$query = $conn->query("SELECT * FROM `owner` WHERE `owner_id` = '$_SESSION[id]'") or die(mysqli_error());
	$fetch = $query->fetch_array();
	$username = $fetch['owner_username'];
	$fname = $fetch['owner_fname'];
	$lname = $fetch['owner_lname'];
	$email = $fetch['owner_email'];
	$date = $fetch['owner_reg_date'];
?>
