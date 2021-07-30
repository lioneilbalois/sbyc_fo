<?php 
	if(isset($_POST['editcaBtn'])){
		
		$id = $_GET['id'];
		$cash_name = $_POST['name'];
		$cash_pr = $_POST['pr'];
		$cash_or = $_POST['or'];
		$cash_particular = $_POST['particular'];
		$cash_amount = $_POST['amount'];
		$cash_cashier = $_POST['cashier'];
		$cash_remarks = $_POST['remarks'];
		$cash_date = $_POST['date'];

		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$query = "UPDATE `cash_trans` SET `name`='$cash_name',`pr_num`='$cash_pr',`or_num`='$cash_or',`particular`='$cash_particular',`amount`='$cash_amount',`cashier`='$cash_cashier',`remarks`='$cash_remarks', `date`='$cash_date' WHERE `id` = $id";
		
		$result = mysqli_query($conn, $query);
		
		if($result){
			header('location: sbyc_dailytransaction.php?now=true');
		}
		mysqli_close($conn);
	}
	
	if(isset($_POST['editdpBtn'])){
		
		$id = $_GET['id'];
		$depslip_name = $_POST['name'];
		$depslip_pr = $_POST['pr'];
		$depslip_or = $_POST['or'];
		$depslip_particular = $_POST['particular'];
		$depslip_amount = $_POST['amount'];
		$depslip_cashier = $_POST['cashier'];
		$depslip_remarks = $_POST['remarks'];
		$depslip_date = $_POST['date'];

		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$query = "UPDATE `depslip_trans` SET `name`='$depslip_name',`pr_num`='$depslip_pr',`or_num`='$depslip_or',`particular`='$depslip_particular',`amount`='$depslip_amount',`cashier`='$depslip_cashier',`remarks`='$depslip_remarks' WHERE `id` = $id";
		
		$result = mysqli_query($conn, $query);
		if($result){
			header('location: sbyc_dailytransaction.php?now=true');
		}
		mysqli_close($conn);
	}

	if(isset($_POST['editckBtn'])){
		
		$id = $_GET['id'];
		$check_name = $_POST['name'];
		$check_pr = $_POST['pr'];
		$check_or = $_POST['or'];
		$check_particular = $_POST['particular'];
		$check_amount = $_POST['amount'];
		$check_cashier = $_POST['cashier'];
		$check_remarks = $_POST['remarks'];
		$check_date = $_POST['date'];

		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$query = "UPDATE `check_trans` SET `name`='$check_name',`pr_num`='$check_pr',`or_num`='$check_or',`particular`='$check_particular',`amount`='$check_amount',`cashier`='$check_cashier',`remarks`='$check_remarks' WHERE `id` = $id";
		
		$result = mysqli_query($conn, $query);
		if($result){
			header('location: sbyc_dailytransaction.php?now=true');
		}
		mysqli_close($conn);
	}

	if(isset($_POST['editccBtn'])){
		
		$id = $_GET['id'];
		$credit_name = $_POST['name'];
		$credit_pr = $_POST['pr'];
		$credit_or = $_POST['or'];
		$credit_particular = $_POST['particular'];
		$credit_amount = $_POST['amount'];
		$credit_cashier = $_POST['cashier'];
		$credit_remarks = $_POST['remarks'];
		$credit_date = $_POST['date'];

		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$query = "UPDATE `credit_trans` SET `name`='$credit_name',`pr_num`='$credit_pr',`or_num`='$credit_or',`particular`='$credit_particular',`amount`='$credit_amount',`cashier`='$credit_cashier',`remarks`='$credit_remarks' WHERE `id` = $id";
		
		$result = mysqli_query($conn, $query);
		if($result){
			header('location: sbyc_dailytransaction.php?now=true');
		}
		mysqli_close($conn);
	}

	if(isset($_POST['editprBtn'])){
		
		$id = $_GET['id'];
		$bill_name = $_POST['name'];
		$bill_pr = $_POST['pr'];
		$bill_or = $_POST['or'];
		$bill_particular = $_POST['particular'];
		$bill_amount = $_POST['amount'];
		$bill_cashier = $_POST['cashier'];
		$bill_remarks = $_POST['remarks'];
		$bill_date = $_POST['date'];

		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$query = "UPDATE `pr_trans` SET `name`='$bill_name',`pr_num`='$bill_pr', `or_num`='$bill_or', `particular`='$bill_particular',`amount`='$bill_amount',`cashier`='$bill_cashier',`remarks`='$bill_remarks' WHERE `id` = $id";
		
		$result = mysqli_query($conn, $query);
		if($result){
			header('location: sbyc_dailytransaction.php?now=true');
		}
		mysqli_close($conn);
	}
	
	if(isset($_POST['editbillBtn'])){
		
		$id = $_GET['id'];
		$bill_name = $_POST['name'];
		$bill_invoice = $_POST['invoice'];
		$bill_particular = $_POST['particular'];
		$bill_amount = $_POST['amount'];
		$bill_receive = $_POST['received_by'];
		$bill_remarks = $_POST['remarks'];
		$bill_date = $_POST['date'];
		
		$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
		$query = "UPDATE `bill_trans` SET `name`='$bill_name',`invoice_no`='$bill_invoice',`particular`='$bill_particular',`amount`='$bill_amount',`received_by`='$bill_receive',`remarks`='$bill_remarks' WHERE `id` = $id";
		
		$result = mysqli_query($conn, $query);
		if($result){
			header('location: sbyc_dailytransaction.php?now=true');
		}
		mysqli_close($conn);
	}
?>
