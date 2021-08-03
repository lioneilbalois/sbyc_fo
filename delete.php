<?php
	$id = $_GET ['id'];
	$table = $_GET['table'];
	
	$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
	$sql ="DELETE FROM `$table` WHERE `id` = $id";
	$query = mysqli_query ($conn, $sql);
	
	if ($query){
		header ('location: sbyc_dailytransaction.php');
	}
	mysqli_close($conn);
?>