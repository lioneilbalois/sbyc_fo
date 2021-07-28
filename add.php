<?php 
	date_default_timezone_set('Asia/Manila');
	if(isset($_POST['submit_ca'])){
		
		$id = $_GET['id'];
		$cash_date_rec = date("Y-m-d");
		$cash_name = $_POST['name'];
		$cash_pr = $_POST['pr'];
		$cash_or = $_POST['or'];
		$cash_particular = $_POST['particular'];
		$cash_amount = $_POST['amount'];
		$cash_cashier = $_POST['cashier'];
		$cash_remarks = $_POST['remarks'];
		$cash_date = $_POST['date'];
		
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$sql_cash = "INSERT INTO `cash_trans` (`id`, `date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `date`)
		VALUES ('$id', '$cash_date_rec', '$cash_name', '$cash_pr', '$cash_or', '$cash_particular', '$cash_amount', '$cash_cashier', '$cash_remarks', '$cash_date')";
		$query = mysqli_query($conn, $sql_cash);
		
		if($query){
			header ('location: sbyc_dailytransaction.php?now=true');
		}
		
		mysqli_close($conn);
	}
	
?>

<?php 
	date_default_timezone_set('Asia/Manila');
	if(isset($_POST['submit_dp'])){
		
		$id = $_GET['id'];
		$depslip_date_rec = date("Y-m-d");
		$depslip_name = $_POST['name'];
		$depslip_pr = $_POST['pr'];
		$depslip_or = $_POST['or'];
		$depslip_particular = $_POST['particular'];
		$depslip_amount = $_POST['amount'];
		$depslip_cashier = $_POST['cashier'];
		$depslip_remarks = $_POST['remarks'];
		$depslip_date = $_POST['date'];
		
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$sql_cash = "INSERT INTO `depslip_trans` (`id`, `date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `date`)
		VALUES ('$id', '$depslip_date_rec', '$depslip_name', '$depslip_pr', '$depslip_or', '$depslip_particular', '$depslip_amount', '$depslip_cashier', '$depslip_remarks', '$depslip_date')";
		$query = mysqli_query($conn, $sql_cash);
		
		if($query){
			header ('location: sbyc_dailytransaction.php?now=true');
		}
		
		mysqli_close($conn);
	}
	
?>