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

<?php 
	date_default_timezone_set('Asia/Manila');
	if(isset($_POST['submit_ck'])){
		
		$id = $_GET['id'];
		$check_date_rec = date("Y-m-d");
		$check_name = $_POST['name'];
		$check_pr = $_POST['pr'];
		$check_or = $_POST['or'];
		$check_particular = $_POST['particular'];
		$check_amount = $_POST['amount'];
		$check_cashier = $_POST['cashier'];
		$check_remarks = $_POST['remarks'];
		$check_date = $_POST['date'];
		
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$sql_cash = "INSERT INTO `check_trans` (`id`, `date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `date`)
		VALUES ('$id', '$check_date_rec', '$check_name', '$check_pr', '$check_or', '$check_particular', '$check_amount', '$check_cashier', '$check_remarks', '$check_date')";
		$query = mysqli_query($conn, $sql_cash);
		
		if($query){
			header ('location: sbyc_dailytransaction.php?now=true');
		}
		
		mysqli_close($conn);
	}
	
?>

<?php 
	date_default_timezone_set('Asia/Manila');
	if(isset($_POST['submit_cc'])){
		
		$id = $_GET['id'];
		$credit_date_rec = date("Y-m-d");
		$credit_name = $_POST['name'];
		$credit_pr = $_POST['pr'];
		$credit_or = $_POST['or'];
		$credit_particular = $_POST['particular'];
		$credit_amount = $_POST['amount'];
		$credit_cashier = $_POST['cashier'];
		$credit_remarks = $_POST['remarks'];
		$credit_date = $_POST['date'];
		
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$sql_cash = "INSERT INTO `credit_trans` (`id`, `date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `date`)
		VALUES ('$id', '$credit_date_rec', '$credit_name', '$credit_pr', '$credit_or', '$credit_particular', '$credit_amount', '$credit_cashier', '$credit_remarks', '$credit_date')";
		$query = mysqli_query($conn, $sql_cash);
		
		if($query){
			header ('location: sbyc_dailytransaction.php?now=true');
		}
		
		mysqli_close($conn);
	}
	
?>

<?php 
	date_default_timezone_set('Asia/Manila');
	if(isset($_POST['submit_pr'])){
		
		$id = $_GET['id'];
		$pr_date_rec = date("Y-m-d");
		$pr_name = $_POST['name'];
		$pr_pr = $_POST['pr'];
		$pr_or = $_POST['or'];
		$pr_particular = $_POST['particular'];
		$pr_amount = $_POST['amount'];
		$pr_cashier = $_POST['cashier'];
		$pr_remarks = $_POST['remarks'];
		$pr_date = $_POST['date'];
		
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$sql_cash = "INSERT INTO `pr_trans` (`id`, `date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `date`)
		VALUES ('$id', '$pr_date_rec', '$pr_name', '$pr_pr', '$pr_or', '$pr_particular', '$pr_amount', '$pr_cashier', '$pr_remarks', '$pr_date')";
		$query = mysqli_query($conn, $sql_cash);
		
		if($query){
			header ('location: sbyc_dailytransaction.php?now=true');
		}
		
		mysqli_close($conn);
	}
	
?>

<?php 
	date_default_timezone_set('Asia/Manila');
	if(isset($_POST['submit_bill'])){
		
		$id = $_GET['id'];
		$bill_date_rec = date("Y-m-d");
		$bill_name = $_POST['name'];
		$bill_invoice_no = $_POST['invoice'];
		$bill_particular = $_POST['particular'];
		$bill_amount = $_POST['amount'];
		$bill_receive = $_POST['received_by'];
		$bill_remarks = $_POST['remarks'];
		$bill_date = $_POST['date'];
		
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$sql_cash = "INSERT INTO `bill_trans` (`id`, `date_recorded`, `name`, `invoice_no`, `particular`, `amount`, `received_by`, `remarks`, `date`)
		VALUES ('$id', '$bill_date_rec', '$bill_name', '$bill_invoice_no', '$bill_particular', '$bill_amount', '$bill_receive', '$bill_remarks', '$bill_date')";
		$query = mysqli_query($conn, $sql_cash);
		
		if($query){
			header ('location: sbyc_dailytransaction.php?now=true');
		}
		
		mysqli_close($conn);
	}
	
?>