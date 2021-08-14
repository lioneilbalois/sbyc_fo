<?php 
    date_default_timezone_set('Asia/Manila'); 
    $current_date = date("Y-m-d");
    $selected_date = $_POST['daily_date'];

    $total_amount = 0;
    $amount_cash = 0;
    $amount_depslip = 0;
    $amount_check = 0;
    $amount_credit = 0;
    $amount_pr = 0;

    $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

    $amount_cash_sql = "SELECT SUM(`amount`) FROM `cash_transaction` WHERE `date_recorded` = '$selected_date'";
    $amount_depslip_sql = "SELECT SUM(`amount`) FROM `depslip_transaction` WHERE `date_recorded` = '$selected_date'";
    $amount_check_sql = "SELECT SUM(`amount`) FROM `check_transaction` WHERE `date_recorded` = '$selected_date'";
    $amount_credit_sql = "SELECT SUM(`amount`) FROM `credit_transaction` WHERE `date_recorded` = '$selected_date'";
    $amount_pr_sql = "SELECT SUM(`amount`) FROM `pr_transaction` WHERE `date_recorded` = '$selected_date'";

    $amount_cash_query = mysqli_query($conn, $amount_cash_sql);
    $amount_depslip_query = mysqli_query($conn, $amount_depslip_sql);
    $amount_check_query = mysqli_query($conn, $amount_check_sql);
    $amount_credit_query = mysqli_query($conn, $amount_credit_sql);
    $amount_pr_query = mysqli_query($conn, $amount_pr_sql);

    $amount_cash_row = mysqli_fetch_array($amount_cash_query);
    $amount_depslip_row = mysqli_fetch_array($amount_depslip_query);
    $amount_check_row = mysqli_fetch_array($amount_check_query);
    $amount_credit_row = mysqli_fetch_array($amount_credit_query);
    $amount_pr_row = mysqli_fetch_array($amount_pr_query);

?>

<tr>
    <th> <h5>Cash Transaction:</h5> </th>
    <td><?php if($amount_cash_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_cash_row['0'], 2); $amount_cash = round($amount_cash_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Deplsip Transaction:</h5> </th>
    <td><?php if($amount_depslip_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_depslip_row['0'], 2); $amount_depslip = round($amount_depslip_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Check Transaction:</h5> </th>
    <td><?php if($amount_check_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_check_row['0'], 2); $amount_check = round($amount_check_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Credit Transaction:</h5> </th>
    <td><?php if($amount_credit_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_credit_row['0'], 2);$amount_credit = round($amount_credit_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>PR Transaction:</h5> </th>
    <td><?php if($amount_pr_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_pr_row['0'], 2); $amount_pr = round($amount_pr_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Total Amount:</h5> </th>
    <td><?php 
        $total_amount = $amount_cash + $amount_depslip + $amount_check + $amount_credit + $amount_pr;
        echo number_format($total_amount, 2);
    ?></td>
</tr>