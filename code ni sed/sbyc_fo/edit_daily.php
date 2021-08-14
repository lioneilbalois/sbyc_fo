<?php

    if(isset($_POST['edit_cash'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $id = $_GET['id'];
        $cash_name = $_POST['cash_edit_name'];
		$cash_pr = $_POST['cash_edit_pr'];
		$cash_or = $_POST['cash_edit_or'];
		$cash_particular = $_POST['cash_edit_particular'];
		$cash_amount = $_POST['cash_edit_amount'];
		$cash_cashier = $_POST['cash_edit_cashier'];
		$cash_remarks = $_POST['cash_edit_remarks'];
		$cash_date = $_POST['cash_edit_date'];

        $sql = "UPDATE `cash_transaction` SET `name`='$cash_name',`pr_num`='$cash_pr',`or_num`='$cash_or',`particular`='$cash_particular',`amount`='$cash_amount',`cashier`='$cash_cashier',`remarks`='$cash_remarks', `bcs_date`='$cash_date' WHERE `id` = $id";
        
        $query = mysqli_query($conn, $sql);

        if($query){
            header ('location: daily_transaction.php');
        }
    }
    
    if(isset($_POST['edit_depslip'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $id = $_GET['id'];
        $depslip_name = $_POST['depslip_edit_name'];
		$depslip_pr = $_POST['depslip_edit_pr'];
		$depslip_or = $_POST['depslip_edit_or'];
		$depslip_particular = $_POST['depslip_edit_particular'];
		$depslip_amount = $_POST['depslip_edit_amount'];
		$depslip_cashier = $_POST['depslip_edit_cashier'];
		$depslip_remarks = $_POST['depslip_edit_remarks'];
		$depslip_date = $_POST['depslip_edit_date'];

        $sql = "UPDATE `depslip_transaction` SET `name`='$depslip_name',`pr_num`='$depslip_pr',`or_num`='$depslip_or',`particular`='$depslip_particular',`amount`='$depslip_amount',`cashier`='$depslip_cashier',`remarks`='$depslip_remarks', `bcs_date`='$depslip_date' WHERE `id` = $id";
        
        $query = mysqli_query($conn, $sql);

        if($query){
            header ('location: daily_transaction.php');
        }
    }

    if(isset($_POST['edit_check'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $id = $_GET['id'];
        $check_name = $_POST['check_edit_name'];
		$check_pr = $_POST['check_edit_pr'];
		$check_or = $_POST['check_edit_or'];
		$check_particular = $_POST['check_edit_particular'];
		$check_amount = $_POST['check_edit_amount'];
		$check_cashier = $_POST['check_edit_cashier'];
		$check_remarks = $_POST['check_edit_remarks'];
		$check_date = $_POST['check_edit_date'];

        $sql = "UPDATE `check_transaction` SET `name`='$check_name',`pr_num`='$check_pr',`or_num`='$check_or',`particular`='$check_particular',`amount`='$check_amount',`cashier`='$check_cashier',`remarks`='$check_remarks', `bcs_date`='$check_date' WHERE `id` = $id";
        
        $query = mysqli_query($conn, $sql);

        if($query){
            header ('location: daily_transaction.php');
        }
    }

    if(isset($_POST['edit_credit'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $id = $_GET['id'];
        $credit_name = $_POST['credit_edit_name'];
		$credit_pr = $_POST['credit_edit_pr'];
		$credit_or = $_POST['credit_edit_or'];
		$credit_particular = $_POST['credit_edit_particular'];
		$credit_amount = $_POST['credit_edit_amount'];
		$credit_cashier = $_POST['credit_edit_cashier'];
		$credit_remarks = $_POST['credit_edit_remarks'];
		$credit_date = $_POST['credit_edit_date'];

        $sql = "UPDATE `credit_transaction` SET `name`='$credit_name',`pr_num`='$credit_pr',`or_num`='$credit_or',`particular`='$credit_particular',`amount`='$credit_amount',`cashier`='$credit_cashier',`remarks`='$credit_remarks', `bcs_date`='$credit_date' WHERE `id` = $id";
        
        $query = mysqli_query($conn, $sql);

        if($query){
            header ('location: daily_transaction.php');
        }
    }

    if(isset($_POST['edit_pr'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $id = $_GET['id'];
        $pr_name = $_POST['pr_edit_name'];
		$pr_pr = $_POST['pr_edit_pr'];
		$pr_or = $_POST['pr_edit_or'];
		$pr_particular = $_POST['pr_edit_particular'];
		$pr_amount = $_POST['pr_edit_amount'];
		$pr_cashier = $_POST['pr_edit_cashier'];
		$pr_remarks = $_POST['pr_edit_remarks'];
		$pr_date = $_POST['pr_edit_date'];

        $sql = "UPDATE `pr_transaction` SET `name`='$pr_name',`pr_num`='$pr_pr',`or_num`='$pr_or',`particular`='$pr_particular',`amount`='$pr_amount',`cashier`='$pr_cashier',`remarks`='$pr_remarks', `bcs_date`='$pr_date' WHERE `id` = $id";
        
        $query = mysqli_query($conn, $sql);

        if($query){
            header ('location: daily_transaction.php');
        }
    }


?>