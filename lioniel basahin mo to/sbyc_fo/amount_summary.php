<?php 
    date_default_timezone_set('Asia/Manila'); 
    $current_date = date("Y-m-d");
    $selected_date = $_POST['daily_date'];
    $table = $_POST['table_sql'];

    $amount_table = 0;

    $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

    $sql = "SELECT * FROM `$table` WHERE `date_recorded` = '$selected_date'";
    $amount_sql = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$selected_date'";

    $query = mysqli_query($conn, $sql);
    $amount_query = mysqli_query($conn, $amount_sql);

    $row = mysqli_num_rows($query);
    $amount_row = mysqli_fetch_array($amount_query);

?>

<tr>
    <th> <h5>Cash Transaction:</h5> </th>
    <td><?php if($amount_cash_row[0] == NULL) { echo "-"; } else {echo number_format($amount_cash_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Deplsip Transaction:</h5> </th>
    <td><?php if($amount_depslip_row[0] == NULL) { echo "-"; } else {echo number_format($amount_depslip_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Check Transaction:</h5> </th>
    <td><?php if($amount_check_row[0] == NULL) { echo "-"; } else {echo number_format($amount_check_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>Credit Transaction:</h5> </th>
    <td><?php if($amount_credit_row[0] == NULL) { echo "-"; } else {echo number_format($amount_credit_row['0'], 2);}?></td>
</tr>
<tr>
    <th> <h5>PR Transaction:</h5> </th>
    <td><?php if($amount_pr_row[0] == NULL) { echo "-"; } else {echo number_format($amount_pr_row['0'], 2);}?></td>
</tr>