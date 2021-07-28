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
?>
