<?php 
    $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');
    $id = $_GET ['id'];
	$table = $_GET['table'];

    $sql = "DELETE FROM `$table` WHERE `id` = $id";
    $query = mysqli_query($conn, $sql);

    if($query){
        header('location: daily_transaction.php');
    }

    mysqli_close($conn);
?>