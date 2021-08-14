<?php 
    date_default_timezone_set('Asia/Manila');
    
    if(isset($_POST['submit_cash'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $date_recorded = date("Y-m-d");
        $cash_name = $_POST['cash_name'];
        $cash_pr = $_POST['cash_pr'];
        $cash_or = $_POST['cash_or'];
        $cash_particular = $_POST['cash_particular'];
        $cash_amount = $_POST['cash_amount'];
        $cash_cashier = $_POST['cash_cashier'];
        $cash_remarks = $_POST['cash_remarks'];
        $cash_date = $_POST['cash_date'];

        
        $query = "INSERT INTO `cash_transaction` (`date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `bcs_date`)
        VALUES ('$date_recorded', '$cash_name', '$cash_pr', '$cash_or', '$cash_particular', '$cash_amount', '$cash_cashier', '$cash_remarks', '$cash_date')";
        $sql = mysqli_query($conn, $query);
        
        if($sql){
            header ('location: daily_transaction.php');
        }

        mysqli_close($conn);
    }

    if(isset($_POST['submit_depslip'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $date_recorded = date("Y-m-d");
        $depslip_name = $_POST['depslip_name'];
        $depslip_pr = $_POST['depslip_pr'];
        $depslip_or = $_POST['depslip_or'];
        $depslip_particular = $_POST['depslip_particular'];
        $depslip_amount = $_POST['depslip_amount'];
        $depslip_cashier = $_POST['depslip_cashier'];
        $depslip_remarks = $_POST['depslip_remarks'];
        $depslip_date = $_POST['depslip_date'];

        
        $query = "INSERT INTO `depslip_transaction` (`date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `bcs_date`)
        VALUES ('$date_recorded', '$depslip_name', '$depslip_pr', '$depslip_or', '$depslip_particular', '$depslip_amount', '$depslip_cashier', '$depslip_remarks', '$depslip_date')";
        $sql = mysqli_query($conn, $query);
        
        if($sql){
            header ('location: daily_transaction.php');
        }

        mysqli_close($conn);
    }
    
    if(isset($_POST['submit_check'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $date_recorded = date("Y-m-d");
        $check_name = $_POST['check_name'];
        $check_pr = $_POST['check_pr'];
        $check_or = $_POST['check_or'];
        $check_particular = $_POST['check_particular'];
        $check_amount = $_POST['check_amount'];
        $check_cashier = $_POST['check_cashier'];
        $check_remarks = $_POST['check_remarks'];
        $check_date = $_POST['check_date'];

        
        $query = "INSERT INTO `check_transaction` (`date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `bcs_date`)
        VALUES ('$date_recorded', '$check_name', '$check_pr', '$check_or', '$check_particular', '$check_amount', '$check_cashier', '$check_remarks', '$check_date')";
        $sql = mysqli_query($conn, $query);
        
        if($sql){
            header ('location: daily_transaction.php');
        }

        mysqli_close($conn);
    }

    if(isset($_POST['submit_credit'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $date_recorded = date("Y-m-d");
        $credit_name = $_POST['credit_name'];
        $credit_pr = $_POST['credit_pr'];
        $credit_or = $_POST['credit_or'];
        $credit_particular = $_POST['credit_particular'];
        $credit_amount = $_POST['credit_amount'];
        $credit_cashier = $_POST['credit_cashier'];
        $credit_remarks = $_POST['credit_remarks'];
        $credit_date = $_POST['credit_date'];

        
        $query = "INSERT INTO `credit_transaction` (`date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `bcs_date`)
        VALUES ('$date_recorded', '$credit_name', '$credit_pr', '$credit_or', '$credit_particular', '$credit_amount', '$credit_cashier', '$credit_remarks', '$credit_date')";
        $sql = mysqli_query($conn, $query);
        
        if($sql){
            header ('location: daily_transaction.php');
        }

        mysqli_close($conn);
    }

    if(isset($_POST['submit_pr'])){
        $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

        $date_recorded = date("Y-m-d");
        $pr_name = $_POST['pr_name'];
        $pr_pr = $_POST['pr_pr'];
        $pr_or = $_POST['pr_or'];
        $pr_particular = $_POST['pr_particular'];
        $pr_amount = $_POST['pr_amount'];
        $pr_cashier = $_POST['pr_cashier'];
        $pr_remarks = $_POST['pr_remarks'];
        $pr_date = $_POST['pr_date'];

        
        $query = "INSERT INTO `pr_transaction` (`date_recorded`, `name`, `pr_num`, `or_num`, `particular`, `amount`, `cashier`, `remarks`, `bcs_date`)
        VALUES ('$date_recorded', '$pr_name', '$pr_pr', '$pr_or', '$pr_particular', '$pr_amount', '$pr_cashier', '$pr_remarks', '$pr_date')";
        $sql = mysqli_query($conn, $query);
        
        if($sql){
            header ('location: daily_transaction.php');
        }

        mysqli_close($conn);
    }

?>