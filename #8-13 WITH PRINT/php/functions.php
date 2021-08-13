<?php
    date_default_timezone_set('Asia/Manila');	
	$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
	$sel_date = date("Y-m-d");
	$sum = 0;

	// to sum amounts per table @ bottom of the page
	function summary($table){
		$sum_q;
		
		// for weekly
		if(isset($_POST['date_end'])){
			$date_begin = $_POST['date_begin'];
			$date_end = $_POST['date_end'];

			$sum_q = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` BETWEEN '$date_begin' AND '$date_end'"; 
		} 
		elseif(isset($_POST['date'])) {
			$date = $_POST['date'];
			// echo "<script>alert(", $date,")</script>";
			$sum_q = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$date'"; 
		}
		else{
			$dt = $GLOBALS['sel_date'];
			$sum_q = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$dt'"; 
		}

		$do_q = mysqli_query($GLOBALS['conn'], $sum_q);
		
		$summ_row = mysqli_fetch_array($do_q);
		if ($summ_row['0'] == NULL) echo "-"; // the query returns NULL if no entry on `amount` to sum
		else {
			echo number_format($summ_row['0'], 2);
			$GLOBALS['sum'] += $summ_row['0'];
		}
	}

	// grand total amounts
	function sum_all(){
		echo number_format($GLOBALS['sum'], 2);
	}
?>