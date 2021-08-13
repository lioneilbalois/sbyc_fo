<?php 
    include('functions_print.php');

    $type = $_GET['type'];
    $date = $_GET['date'];
    $date_end;
    
    if(isset($_GET['date_end'])){
       $date_end = $_GET['date_end'];
    }
    
    //table arrays
    $table_header = array("CASH (CA) TRANSACTION", "DEPSLIP (DPSLP) TRANSACTION", "CHECK (CK) TRANSACTION", "CREDIT CARD (CC) TRANSACTION", "PROVISIONAL RECEIPT (PR)", "SEND BILL");
    $table_sql = array("cash_trans", "depslip_trans", "check_trans", "credit_trans", "pr_trans", "bill_trans");

    //column arrays
    $column = array("NAME", "PR", "OR", "PARTICULAR", "AMOUNT", "CASHIER", "REMARKS", "BCS DATE/BY");
    $column_send_bill = array("NAME", "INVOICE NO.", "PARTICULAR", "AMOUNT", "RECEIVED BY", "REMARKS", "BCS DATE/BY");
    $column_sql = array("name", "pr_num", "or_num", "particular", "amount", "cashier", "remarks", "date");
    $column_sql_send_bill = array("name", "invoice_no", "particular", "amount", "received_by", "remarks", "date");
    //echo '<script>alert(', sizeof($table_header), ')</script>';

    $conn = new mysqli('localhost', 'root', '', 'sbyc_fo');

    function do_query($tablename){
        $dt = $GLOBALS['date'];
        if ($GLOBALS['type'] == "'daily'") {
            //echo '<script>alert(', , ')</script>';
            return ("SELECT * FROM `$tablename` WHERE `date_recorded` = $dt");
        } else {
            if (isset($_GET['date_end'])) {
                $dte = $GLOBALS['date_end'];
                return ("SELECT * FROM `$tablename` WHERE `date_recorded` BETWEEN $dt AND $dte");
            }
        }
    }

    // for colspan 
    function is_weekly(){
        if($GLOBALS['type'] == "'weekly'"){
            echo 10;
        } else echo 8;
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    
    <style>
        table{
            border-collapse: collapse;
        }
        td, th{
            border: 1px solid #dee2e6;
        }
        .header{
            background-color: #D3D3D3;
            border-bottom: 1px solid black;
        }
        .centered{
            text-align: center;
        }
        .total-header{
            border-bottom: 1px solid black;
        }
    </style>
    
  </head>
  <body>
    <div class="container">
        <table class='table' style="border: 2px solid black; ">
            <tbody>
                <tr>
                    <th colspan="<?php is_weekly(); ?>" class="centered header">
                        <?php                         
                            $dt = str_replace("'", '', $date);

                            if ($type == "'daily'") {
                                echo date_format(date_create($dt), "l, d F Y");
                            }
                            else {
                                $dte = str_replace("'", '', $date_end);
                                echo date_format(date_create($dt), "l, d F Y"), " - ", date_format(date_create($dte), "l, d F Y");
                            }
                        ?>
                    </th>
                </tr>
                <tr>
                    <th colspan="<?php is_weekly(); ?>" class="centered header">
                        <?php  
                            if($type == "'daily'") echo "DAILY TRANSACTION";
                            else echo "WEEKLY TRANSACTION";
                        ?>                
                    </th>
                </tr>
          
                <?php 
                    for($x = 0; $x < sizeof($table_header); $x++){
                        // table title - Cash Trans, Depslip, etc NO SUMMARY TABLE
                        echo '<tr><th colspan="';
                        is_weekly();
                        echo '" class="centered header">', $table_header[$x], '</th></tr>';

                        // table columns - Name, PR, OR, etc
                        echo "<tr>";

                        // for adding date recorded column for weekly
                        if($type == "'weekly'") {
                            echo "<th colspan='2'>Date Recorded</th>";
                        }
                        
                        if($table_header[$x] != "SEND BILL") {
                            for($z = 0; $z < sizeof($column); $z++) {
                                echo "<th class='centered'>", $column[$z], "</th>";
                            }
                        } else {
                            // exclusive for table SEND BILL (different columns)
                            for($z = 0; $z < sizeof($column_send_bill); $z++) {
                                if ($column_send_bill[$z] == "INVOICE NO.") {
                                    echo "<th class='centered' colspan='2'>", $column_send_bill[$z], "</th>";
                                }
                                else {
                                    echo "<th class='centered'>", $column_send_bill[$z], "</th>";
                                }
                            }
                        }
                        echo "</tr>";
                        
                        // table rows - data from the database
                        $sql = do_query($table_sql[$x]);
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";

                                // for weekly add data for date recorded column
                                if($type == "'weekly'") {
                                    echo "<td colspan='2'>", $row['date_recorded'],"</td>";
                                }

                                if($table_header[$x] == "SEND BILL") {
                                    for($z = 0; $z < sizeof($column_sql_send_bill); $z++) {
                                        if($z == 1) {
                                            echo "<td  class='centered' colspan='2'>", $row[$column_sql_send_bill[$z]],"</td>";
                                        }
                                        elseif($column_sql_send_bill[$z] == 'amount'){
                                            if(is_numeric($row['amount'])) echo "<td style='text-align: right;'>", number_format($row['amount'], 2),"</td>";
									        else echo "<td style='text-align: right;'>", $row['amount'],"</td>";
                                        }
                                        else {
                                            echo "<td class='centered'>", $row[$column_sql_send_bill[$z]],"</td>";
                                        }
                                    }                                    
                                } else {
                                    for($z = 0; $z < sizeof($column_sql); $z++) {
                                        if($column_sql[$z] == 'amount'){
                                            if(is_numeric($row['amount'])) echo "<td style='text-align: right;'>", number_format($row['amount'], 2), "</td>";
									        else echo "<td style='text-align: right;'>", $row['amount'], "</td>";
                                        }
                                        else {
                                            echo "<td class='centered'>", $row[$column_sql[$z]],"</td>";
                                        }
                                    } 
                                }
                                echo "</tr>";
                            }
                        } else {
                            // for no transaction
                            echo "<tr><td colspan='";
                            is_weekly();
                            echo "'class='centered'> - NO TRANSACTION - </td></tr>";
                        } 
                         // for total per table
                        $cols = 4;
                        if($type == "'weekly'") {$cols = 6;}
                       
                        echo "<tr><th class='total-header' colspan='", $cols,"'>TOTAL</th><th class='total-header' style='text-align: right;'>";
                        summary($table_sql[$x]);
                        echo "</th><th colspan='3' class='total-header'></th></tr>";
                        reset_sum();
                    }
                ?>
                <!-- for summary table -->
                <tr>
                    <th colspan="<?php is_weekly(); ?>" class="centered header">SUMMARY</th>
                </tr>
            
                <?php 
                    for($x = 0; $x <= sizeof($table_header); $x++) {
                        echo "<tr>";
                        
                        $h = 6;
                        $h_2 = 2;

                        if($type == "'weekly'") {
                            ++$h;
                            ++$h_2;
                        }

                        if ($x < sizeof($table_header)) {
                            echo "<th colspan='", $h,"' class='centered'>", $table_header[$x],"</th>";
                            echo "<th style='text-align: right;' colspan='", $h_2,"'>"; 
                            summary($table_sql[$x]);
                            echo "</th>";
                        } else {
                            echo "<th colspan='", $h,"' class='centered'>TOTAL TRANSACTIONS</th><th style='text-align: right;' colspan='", $h_2,"'>";
                            sum_all();
                            echo "</th>";
                        }
                        echo "</tr>";
                    }
                ?>
                
            </tbody>
        </table>
    </div>
  </body>
</html>