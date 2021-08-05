<?php
    date_default_timezone_set('Asia/Manila');	
	$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
	$sel_date = date("Y-m-d");

	// to sum amounts per table @ bottom of the page
	function summary($table){
		$getDate = $GLOBALS['sel_date'];
		$sum_q = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$getDate';"; 
		$do_q = mysqli_query($GLOBALS['conn'], $sum_q);
		
		$summ_row = mysqli_fetch_array($do_q);
		if ($summ_row['0'] == NULL) echo "-"; // the query returns NULL if no entry on `amount` to sum
		else echo number_format($summ_row['0'], 2);
	}
?>