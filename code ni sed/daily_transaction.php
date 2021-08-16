<?php 

    date_default_timezone_set('Asia/Manila'); 
    $current_date = date("Y-m-d");

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/sbyc.png">
        <title>Front Office | Home</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <script src="js/scripts.js"></script>
        <script src="js/jquery-3.6.0.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>

        <script>
            const tables = ["#table_cash", "#table_depslip", "#table_check", "#table_credit", "#table_pr"];
            const tables_sql = ["cash_transaction", "depslip_transaction", "check_transaction", "credit_transaction", "pr_transaction"];
            const delete_modals = ["deletecash_modal", "deletedepslip_modal", "deletecheck_modal", "deletecredit_modal", "deletepr_modal"];
            const edit_modals = ["editcash_modal", "editdepslip_modal", "editcheck_modal", "editcredit_modal", "editpr_modal"];
            const delete_entries = ["delete_cash", "delete_depslip", "delete_check", "delete_credit", "delete_pr"];
            const edit_entries = ["edit_cash", "edit_depslip", "edit_check", "edit_credit", "edit_pr"];

            $(document).ready(function(){

                $("#daily").datepicker({
                    changeYear: true,
                    changeMonth: true,
                    dateFormat: 'yy-mm-dd'
                });

                $("#date_begin").datepicker({
                    changeYear: true,
                    changeMonth: true,
                    dateFormat: 'yy-mm-dd'
                });

                $("#date_end").datepicker({
                    changeYear: true,
                    changeMonth: true,
                    dateFormat: 'yy-mm-dd'
                });

                $("#search").on('click', function(){
                    var date_begin = $("#date_begin").datepicker().val();
                    var date_end = $("#date_end").datepicker().val();
                    
                    for(let i = 0; i < tables.length; i++){
                        $(tables[i]).load("table_contents_weekly.php", {
                            weekly_begin : date_begin,
                            weekly_end : date_end,

                            table_sql : tables_sql[i],
                            delete_modal : delete_modals[i],
                            edit_modal : edit_modals[i],
                            delete_entry : delete_entries[i],
                            edit_entry : edit_entries[i]
                        });
                    }

                    $("#amount_summary").load("amount_summary_weekly.php", {
                        weekly_begin : date_begin,
                        weekly_end : date_end
                    });

                    $("#addButton_cash").load("addButton.php", {});
                    $("#addButton_depslip").load("addButton.php", {});
                    $("#addButton_credit").load("addButton.php", {});
                    $("#addButton_check").load("addButton.php", {});
                    $("#addButton_pr").load("addButton.php", {});

                });

                $("#daily").on('change', function() {
                    var selected_date = $(this).datepicker().val();
                    
                    for(let i = 0; i < tables.length; i++){
                        $(tables[i]).load("table_contents_daily.php", {
                            daily_date : selected_date,
                            table_sql : tables_sql[i],
                            delete_modal : delete_modals[i],
                            edit_modal : edit_modals[i],
                            delete_entry : delete_entries[i],
                            edit_entry : edit_entries[i]
                        });
                    }

                    $("#amount_summary").load("amount_summary_daily.php", {
                        daily_date : selected_date,
                    });

                    $("#addButton_cash").load("addButton.php", {});
                    $("#addButton_depslip").load("addButton.php", {});
                    $("#addButton_credit").load("addButton.php", {});
                    $("#addButton_check").load("addButton.php", {});
                    $("#addButton_pr").load("addButton.php", {});
                });
            });  

        </script>

    </head>

    <body>

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md" style="background-color:#D7DBDD;">
            <a class="navbar-brand" href="index.php"><img src="img/sbyc.png" width="50px" height="50px" class="rounded"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="daily_transaction.php" style="color:#4C4C6D; text-decoration: none;"><h5>Daily Transaction</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color:#4C4C6D; text-decoration: none;">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color:#4C4C6D; text-decoration: none;">Link</a>
                </li>
                </ul>
            </div>
        </nav> <br>

        <div class="row">
            <div class="col-md-3">
                <h4>Date: &nbsp;</h4> <input type="text" name="daily" id="daily" readonly class="form-control" value="<?php echo $current_date ?>"> <br> 
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <h4>From: &nbsp;</h4> <input type="text" name="date_begin" id="date_begin" readonly class="form-control" value="<?php echo $current_date ?>"> <br> 
            </div>
            <div class="col-md-2">
                <h4>To: &nbsp;</h4> <input type="text" name="date_end" id="date_end" readonly class="form-control" value="YY-MM-DD"> <br> 
            </div>
            <div class="col-md-1">
                <br> <button id="search" name="search" class="btn btn-info form-control">Search</button>
            </div>
        </div>
       
        <!--CASH TRANSACTION TABLE-->
        <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                <!-- add entry part -->
                    <h2 style="margin-bottom:0%; margin-top:0%;">
                        CASH TRANSACTION
                        <div id="addButton_cash">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cash_Modal" style="float:right; margin-bottom:7px;" id="addButton">
                                Add Entry
                            </button>
                        </div>
                    </h2>
                    <div class="modal fade" id="cash_Modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <div class="modal-header bg-primary ft-white">
                                <h4 class="modal-title" style="color: white;">Add Cash Transaction Entry?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <form action="add_daily.php" method="POST">
                                    <label for="cash_name">Name:</label>
                                    <input type="text" name="cash_name" id="cash_name" class="form-control" placeholder="Input Name">
                                    <label for="cash_pr">PR:</label>
                                    <input type="text" name="cash_pr" id="cash_pr" class="form-control" placeholder="Input PR number">
                                    <label for="cash_or">OR:</label>
                                    <input type="text" name="cash_or" id="cash_or" class="form-control" placeholder="Input OR number">
                                    <label for="cash_particular">Particular:</label>
                                    <input type="text" name="cash_particular" id="cash_particular" class="form-control" placeholder="Input Particular">
                                    <label for="cash_amount">Amount:</label>
                                    <input type="text" name="cash_amount" id="cash_amount" class="form-control" placeholder="Input Amount" onkeypress="return isNumber(event)">
                                    <label for="cash_cashier">Cashier:</label>
                                    <select class="form-control" name="cash_cashier" id="cash_cashier">
                                        <option selected>Select Cashier</option>
                                        <option value="Glydel">Glydel</option>
                                        <option value="Athena">Athena</option>
                                        <option value="Dianne">Dianne</option>
                                        <option value="Alvin">Alvin</option>
                                    </select>
                                    <label for="cash_remarks">Remarks:</label>
                                    <input type="text" name="cash_remarks" id="cash_remarks" class="form-control" placeholder="Input Remarks">
                                    <label for="cash_date">Bcs Date/By:</label>
                                    <input type="text" name="cash_date" id="cash_date" class="form-control" placeholder="Input Bcs Date/By">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="submit_cash" id="submit_cash">
                                </form>
                            </div>

                            </div>
                        </div>
                    </div> <br>
                    <!-- add entry end part -->
                
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>PR</th>
                            <th>OR</th>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Cashier</th>
                            <th>Remarks</th>
                            <th>Bcs Date/By</th>
                            <th></th>
                        </thead>
                        <tbody id="table_cash">
                            <!-- Show data to table part -->
                            <?php 

                                $amount_cash = 0.00;

                                $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

                                $sql = "SELECT * FROM `cash_transaction` WHERE `date_recorded` = '$current_date'";
                                $amount_cash_sql = "SELECT SUM(`amount`) FROM `cash_transaction` WHERE `date_recorded` = '$current_date'"; 

                                $query = mysqli_query($conn, $sql);
                                $amount_cash_query = mysqli_query($conn, $amount_cash_sql);

                                $amount_cash_row = mysqli_fetch_array($amount_cash_query);
                                $row = mysqli_num_rows($query);

                                if ($row > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['pr_num'] ?></td>
                                <td><?php echo $row['or_num'] ?></td>
                                <td><?php echo $row['particular'] ?></td>
                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo $row['cashier'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                                <td><?php echo $row['bcs_date'] ?></td>
                                <td width=9%>

                                    <!-- Delete Data part -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletecash_Modal<?php echo $row['id']; ?>">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deletecash_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title" style="color:white;">Delete Cash Transaction Entry?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                Do you want to delete this transaction?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn " data-dismiss="modal">No</button>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=cash_transaction">
                                                    <input type="submit" name="delete_cash" id="delete_cash" class="btn btn-danger" value="Delete">
                                                </a>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Data end part -->

                                    <!-- Edit Data part -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editcash_Modal<?php echo $row['id']; ?>">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="editcash_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title" style="color:white;">Edit Cash Transaction Entry</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="edit_daily.php?id=<?php echo $row['id'];?>" method="POST">
                                                    <label for="cash_edit_name">Name:</label>
                                                    <input type="text" name="cash_edit_name" id="cash_edit_name" class="form-control" placeholder="Input Name" value="<?php echo $row['name'];?>">
                                                    <label for="cash_edit_pr">PR:</label>
                                                    <input type="text" name="cash_edit_pr" id="cash_edit_pr" class="form-control" placeholder="Input PR number" value="<?php echo $row['pr_num'];?>">
                                                    <label for="cash_edit_or">OR:</label>
                                                    <input type="text" name="cash_edit_or" id="cash_edit_or" class="form-control" placeholder="Input OR number" value="<?php echo $row['or_num'];?>">
                                                    <label for="cash_edit_particular">Particular:</label>
                                                    <input type="text" name="cash_edit_particular" id="cash_edit_particular" class="form-control" placeholder="Input Particular" value="<?php echo $row['particular'];?>">
                                                    <label for="cash_edit_amount">Amount:</label>
                                                    <input type="text" name="cash_edit_amount" id="cash_edit_amount" class="form-control" placeholder="Input Amount" value="<?php echo $row['amount'];?>" onkeypress="return isNumber(event)">
                                                    <label for="cash_edit_cashier">Cashier:</label>
                                                    <select class="form-control" name="cash_edit_cashier" id="cash_edit_cashier">
                                                        <option selected>Select Cashier</option>
                                                        <option value="Glydel" <?php if($row['cashier']=='Glydel') {echo "Selected";}?>>Glydel</option>
                                                        <option value="Athena" <?php if($row['cashier']=='Athena') {echo "Selected";}?>>Athena</option>
                                                        <option value="Dianne" <?php if($row['cashier']=='Dianne') {echo "Selected";}?>>Dianne</option>
                                                        <option value="Alvin" <?php if($row['cashier']=='Alvin') {echo "Selected";}?>>Alvin</option>
                                                    </select>
                                                    <label for="cash_edit_remarks">Remarks:</label>
                                                    <input type="text" name="cash_edit_remarks" id="cash_edit_remarks" class="form-control" placeholder="Input Remarks" value="<?php echo $row['remarks'];?>">
                                                    <label for="cash_edit_date">Bcs Date/By:</label>
                                                    <input type="text" name="cash_edit_date" id="cash_edit_date" class="form-control" placeholder="Input Bcs Date/By" value="<?php echo $row['bcs_date'];?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                                <input type="submit" class="btn btn-info" name="edit_cash" id="edit_cash" value="Save">
                                                </form>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Data end part -->

                                </td>
                            </tr>

                            <?php
                                }}
                                else{
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>No Transaction</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <td>
                                    <h5>Total Amount:</h5>
                                </td>
                                <td>
                                    <?php if($amount_cash_row[0] == NULL) { echo "-"; } else {echo number_format($amount_cash_row['0'], 2); $amount_cash = round($amount_cash_row['0'], 2);}?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    
                    
                </div> <br>


                <!--DEPSLIP TRANSACTION TABLE-->
                <div class="container-fluid mt-3">
                <h2 style="margin-bottom:0%; margin-top:0%;">
                    DEPSLIP TRANSACTION
                    <!-- add entry part -->
                    <div id="addButton_depslip">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#depslip_Modal" style="float:right; margin-bottom:7px;">
                            Add Entry
                        </button>
                    </div>
                </h2>

                    <div class="modal fade" id="depslip_Modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <div class="modal-header bg-primary ft-white">
                                <h4 class="modal-title" style="color: white;">Add Depslip Transaction Entry?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <form action="add_daily.php" method="POST">
                                    <label for="depslip_name">Name:</label>
                                    <input type="text" name="depslip_name" id="depslip_name" class="form-control" placeholder="Input Name">
                                    <label for="depslp_pr">PR:</label>
                                    <input type="text" name="depslip_pr" id="depslip_pr" class="form-control" placeholder="Input PR number">
                                    <label for="depslp_or">OR:</label>
                                    <input type="text" name="depslip_or" id="depslip_or" class="form-control" placeholder="Input OR number">
                                    <label for="depslip_particular">Particular:</label>
                                    <input type="text" name="depslip_particular" id="depslip_particular" class="form-control" placeholder="Input Particular">
                                    <label for="depslip_amount">Amount:</label>
                                    <input type="text" name="depslip_amount" id="depslip_amount" class="form-control" placeholder="Input Amount" onkeypress="return isNumber(event)">
                                    <label for="depslip_cashier">Cashier:</label>
                                    <select class="form-control" name="depslip_cashier" id="depslip_cashier">
                                        <option selected>Select Cashier</option>
                                        <option value="Glydel">Glydel</option>
                                        <option value="Athena">Athena</option>
                                        <option value="Dianne">Dianne</option>
                                        <option value="Alvin">Alvin</option>
                                    </select>
                                    <label for="depslip_remarks">Remarks:</label>
                                    <input type="text" name="depslip_remarks" id="depslip_remarks" class="form-control" placeholder="Input Remarks">
                                    <label for="depslip_date">Bcs Date/By:</label>
                                    <input type="text" name="depslip_date" id="depslip_date" class="form-control" placeholder="Input Bcs Date/By">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="submit_depslip" id="submit_depslp">
                                </form>
                            </div>

                            </div>
                        </div>
                    </div> <br>
                    <!-- add entry end part -->
                
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>PR</th>
                            <th>OR</th>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Cashier</th>
                            <th>Remarks</th>
                            <th>Bcs Date/By</th>
                            <th></th>
                        </thead>
                        <tbody id="table_depslip">
                            <!-- Show data to table part -->
                            <?php 
                                $amount_depslip = 0;

                                $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

                                $sql = "SELECT * FROM `depslip_transaction` WHERE `date_recorded` = '$current_date'";
                                $amount_depslip_sql = "SELECT SUM(`amount`) FROM `depslip_transaction` WHERE `date_recorded` = '$current_date'";

                                $query = mysqli_query($conn, $sql);
                                $amount_depslip_query = mysqli_query($conn, $amount_depslip_sql);

                                $row = mysqli_num_rows($query);
                                $amount_depslip_row = mysqli_fetch_array($amount_depslip_query);

                                if ($row > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['pr_num'] ?></td>
                                <td><?php echo $row['or_num'] ?></td>
                                <td><?php echo $row['particular'] ?></td>
                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo $row['cashier'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                                <td><?php echo $row['bcs_date'] ?></td>
                                <td width=9%>

                                    <!-- Delete Data part -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletedepslip_Modal<?php echo $row['id']; ?>">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deletedepslip_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title" style="color:white;">Delete Depslip Transaction Entry?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                Do you want to delete this transaction?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn " data-dismiss="modal">No</button>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=depslip_transaction">
                                                    <input type="submit" name="delete_depslip" id="delete_depslip" class="btn btn-danger" value="Delete">
                                                </a>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Data end part -->

                                    <!-- Edit Data part -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editdepslip_Modal<?php echo $row['id']; ?>">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="editdepslip_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title" style="color:white;">Edit Depslip Transaction Entry</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="edit_daily.php?id=<?php echo $row['id'];?>" method="POST">
                                                    <label for="depslip_edit_name">Name:</label>
                                                    <input type="text" name="depslip_edit_name" id="depslip_edit_name" class="form-control" placeholder="Input Name" value="<?php echo $row['name'];?>">
                                                    <label for="depslip_edit_pr">PR:</label>
                                                    <input type="text" name="depslip_edit_pr" id="depslip_edit_pr" class="form-control" placeholder="Input PR number" value="<?php echo $row['pr_num'];?>">
                                                    <label for="depslip_edit_or">OR:</label>
                                                    <input type="text" name="depslip_edit_or" id="depslip_edit_or" class="form-control" placeholder="Input OR number" value="<?php echo $row['or_num'];?>">
                                                    <label for="depslip_edit_particular">Particular:</label>
                                                    <input type="text" name="depslip_edit_particular" id="depslip_edit_particular" class="form-control" placeholder="Input Particular" value="<?php echo $row['particular'];?>">
                                                    <label for="depslip_edit_amount">Amount:</label>
                                                    <input type="text" name="depslip_edit_amount" id="depslip_edit_amount" class="form-control" placeholder="Input Amount" value="<?php echo $row['amount'];?>" onkeypress="return isNumber(event)">
                                                    <label for="depslip_edit_cashier">Cashier:</label>
                                                    <select class="form-control" name="depslip_edit_cashier" id="depslip_edit_cashier">
                                                        <option selected>Select Cashier</option>
                                                        <option value="Glydel" <?php if($row['cashier']=='Glydel') {echo "Selected";}?>>Glydel</option>
                                                        <option value="Athena" <?php if($row['cashier']=='Athena') {echo "Selected";}?>>Athena</option>
                                                        <option value="Dianne" <?php if($row['cashier']=='Dianne') {echo "Selected";}?>>Dianne</option>
                                                        <option value="Alvin" <?php if($row['cashier']=='Alvin') {echo "Selected";}?>>Alvin</option>
                                                    </select>
                                                    <label for="depslip_edit_remarks">Remarks:</label>
                                                    <input type="text" name="depslip_edit_remarks" id="depslip_edit_remarks" class="form-control" placeholder="Input Remarks" value="<?php echo $row['remarks'];?>">
                                                    <label for="depslip_edit_date">Bcs Date/By:</label>
                                                    <input type="text" name="depslip_edit_date" id="depslip_edit_date" class="form-control" placeholder="Input Bcs Date/By" value="<?php echo $row['bcs_date'];?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                                <input type="submit" class="btn btn-info" name="edit_depslip" id="edit_depslip" value="Save">
                                                </form>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Data end part -->

                                </td>
                            </tr>

                            <?php
                                }}
                                else{
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>No Transaction</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>
                            <tr>
                                <td>
                                    <h5>Total Amount:</h5>
                                </td>
                                <td>
                                <?php if($amount_depslip_row[0] == NULL) { echo "-"; } else {echo number_format($amount_depslip_row['0'], 2); $amount_depslip = round($amount_depslip_row['0'], 2);}?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <br>


                <!--CHECK TRANSACTION TABLE-->
                <div class="container-fluid mt-3">
                <h2 style="margin-bottom:0%; margin-top:0%;">
                    CHECK TRANSACTION
                    <!-- add entry part -->
                    <div id="addButton_check">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#check_Modal" style="float:right; margin-bottom:7px;">
                            Add Entry
                        </button>
                    </div>
                </h2>

                    <div class="modal fade" id="check_Modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <div class="modal-header bg-primary ft-white">
                                <h4 class="modal-title" style="color: white;">Add Check Transaction Entry?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <form action="add_daily.php" method="POST">
                                    <label for="check_name">Name:</label>
                                    <input type="text" name="check_name" id="check_name" class="form-control" placeholder="Input Name">
                                    <label for="check_pr">PR:</label>
                                    <input type="text" name="check_pr" id="check_pr" class="form-control" placeholder="Input PR number">
                                    <label for="check_or">OR:</label>
                                    <input type="text" name="check_or" id="check_or" class="form-control" placeholder="Input OR number">
                                    <label for="check_particular">Particular:</label>
                                    <input type="text" name="check_particular" id="check_particular" class="form-control" placeholder="Input Particular">
                                    <label for="check_amount">Amount:</label>
                                    <input type="text" name="check_amount" id="check_amount" class="form-control" placeholder="Input Amount" onkeypress="return isNumber(event)">
                                    <label for="check_cashier">Cashier:</label>
                                    <select class="form-control" name="check_cashier" id="check_cashier">
                                        <option selected>Select Cashier</option>
                                        <option value="Glydel">Glydel</option>
                                        <option value="Athena">Athena</option>
                                        <option value="Dianne">Dianne</option>
                                        <option value="Alvin">Alvin</option>
                                    </select>
                                    <label for="check_remarks">Remarks:</label>
                                    <input type="text" name="check_remarks" id="check_remarks" class="form-control" placeholder="Input Remarks">
                                    <label for="check_date">Bcs Date/By:</label>
                                    <input type="text" name="check_date" id="check_date" class="form-control" placeholder="Input Bcs Date/By">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="submit_check" id="submit_check">
                                </form>
                            </div>

                            </div>
                        </div>
                    </div> <br>
                    <!-- add entry end part -->
                
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>PR</th>
                            <th>OR</th>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Cashier</th>
                            <th>Remarks</th>
                            <th>Bcs Date/By</th>
                            <th></th>
                        </thead>
                        <tbody id="table_check">
                            <!-- Show data to table part -->
                            <?php 
                                $amount_check = 0;

                                $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

                                $sql = "SELECT * FROM `check_transaction` WHERE `date_recorded` = '$current_date'";
                                $amount_check_sql = "SELECT SUM(`amount`) FROM `check_transaction` WHERE `date_recorded` = '$current_date'";

                                $query = mysqli_query($conn, $sql);
                                $amount_check_query = mysqli_query($conn, $amount_check_sql);

                                $row = mysqli_num_rows($query);
                                $amount_check_row = mysqli_fetch_array($amount_check_query);

                                if ($row > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['pr_num'] ?></td>
                                <td><?php echo $row['or_num'] ?></td>
                                <td><?php echo $row['particular'] ?></td>
                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo $row['cashier'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                                <td><?php echo $row['bcs_date'] ?></td>
                                <td width=9%>

                                    <!-- Delete Data part -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletecheck_Modal<?php echo $row['id']; ?>">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deletecheck_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title" style="color:white;">Delete Check Transaction Entry?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                Do you want to delete this transaction?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn " data-dismiss="modal">No</button>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=check_transaction">
                                                    <input type="submit" name="delete_check" id="delete_check" class="btn btn-danger" value="Delete">
                                                </a>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Data end part -->

                                    <!-- Edit Data part -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editcheck_Modal<?php echo $row['id'];?>">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="editcheck_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title" style="color:white;">Edit Check Transaction Entry</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="edit_daily.php?id=<?php echo $row['id'];?>" method="POST">
                                                    <label for="check_edit_name">Name:</label>
                                                    <input type="text" name="check_edit_name" id="check_edit_name" class="form-control" placeholder="Input Name" value="<?php echo $row['name'];?>">
                                                    <label for="check_edit_pr">PR:</label>
                                                    <input type="text" name="check_edit_pr" id="check_edit_pr" class="form-control" placeholder="Input PR number" value="<?php echo $row['pr_num'];?>">
                                                    <label for="check_edit_or">OR:</label>
                                                    <input type="text" name="check_edit_or" id="check_edit_or" class="form-control" placeholder="Input OR number" value="<?php echo $row['or_num'];?>">
                                                    <label for="check_edit_particular">Particular:</label>
                                                    <input type="text" name="check_edit_particular" id="check_edit_particular" class="form-control" placeholder="Input Particular" value="<?php echo $row['particular'];?>">
                                                    <label for="check_edit_amount">Amount:</label>
                                                    <input type="text" name="check_edit_amount" id="check_edit_amount" class="form-control" placeholder="Input Amount" value="<?php echo $row['amount'];?>" onkeypress="return isNumber(event)">
                                                    <label for="check_edit_cashier">Cashier:</label>
                                                    <select class="form-control" name="check_edit_cashier" id="check_edit_cashier">
                                                        <option selected>Select Cashier</option>
                                                        <option value="Glydel" <?php if($row['cashier']=='Glydel') {echo "Selected";}?>>Glydel</option>
                                                        <option value="Athena" <?php if($row['cashier']=='Athena') {echo "Selected";}?>>Athena</option>
                                                        <option value="Dianne" <?php if($row['cashier']=='Dianne') {echo "Selected";}?>>Dianne</option>
                                                        <option value="Alvin" <?php if($row['cashier']=='Alvin') {echo "Selected";}?>>Alvin</option>
                                                    </select>
                                                    <label for="check_edit_remarks">Remarks:</label>
                                                    <input type="text" name="check_edit_remarks" id="check_edit_remarks" class="form-control" placeholder="Input Remarks" value="<?php echo $row['remarks'];?>">
                                                    <label for="check_edit_date">Bcs Date/By:</label>
                                                    <input type="text" name="check_edit_date" id="check_edit_date" class="form-control" placeholder="Input Bcs Date/By" value="<?php echo $row['bcs_date'];?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                                <input type="submit" class="btn btn-info" name="edit_check" id="edit_check" value="Save">
                                                </form>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Data end part -->

                                </td>
                            </tr>

                            <?php
                                }}
                                else{
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>No Transaction</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>

                            <tr>
                                <td>
                                    <h5>Total Amount:</h5>
                                </td>
                                <td>
                                    <?php if($amount_check_row[0] == NULL) { echo "-"; } else {echo number_format($amount_check_row['0'], 2); $amount_check = round($amount_check_row['0'], 2);}?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div> <br>


                <!--CREDIT TRANSACTION TABLE-->
                <div class="container-fluid mt-3">
                <h2 style="margin-bottom:0%; margin-top:0%;">
                    CREDIT TRANSACTION
                    <!-- add entry part -->
                    <div id="addButton_credit">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#credit_Modal" style="float:right; margin-bottom:7px;">
                            Add Entry
                        </button>
                    </div>
                </h2>

                    <div class="modal fade" id="credit_Modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <div class="modal-header bg-primary ft-white">
                                <h4 class="modal-title" style="color: white;">Add Credit Transaction Entry?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <form action="add_daily.php" method="POST">
                                    <label for="credit_name">Name:</label>
                                    <input type="text" name="credit_name" id="credit_name" class="form-control" placeholder="Input Name">
                                    <label for="credit_pr">PR:</label>
                                    <input type="text" name="credit_pr" id="credit_pr" class="form-control" placeholder="Input PR number">
                                    <label for="credit_or">OR:</label>
                                    <input type="text" name="credit_or" id="credit_or" class="form-control" placeholder="Input OR number">
                                    <label for="credit_particular">Particular:</label>
                                    <input type="text" name="credit_particular" id="credit_particular" class="form-control" placeholder="Input Particular">
                                    <label for="credit_kamount">Amount:</label>
                                    <input type="text" name="credit_amount" id="credit_amount" class="form-control" placeholder="Input Amount" onkeypress="return isNumber(event)">
                                    <label for="credit_cashier">Cashier:</label>
                                    <select class="form-control" name="credit_cashier" id="credit_cashier">
                                        <option selected>Select Cashier</option>
                                        <option value="Glydel">Glydel</option>
                                        <option value="Athena">Athena</option>
                                        <option value="Dianne">Dianne</option>
                                        <option value="Alvin">Alvin</option>
                                    </select>
                                    <label for="credit_remarks">Remarks:</label>
                                    <input type="text" name="credit_remarks" id="credit_remarks" class="form-control" placeholder="Input Remarks">
                                    <label for="credit_date">Bcs Date/By:</label>
                                    <input type="text" name="credit_date" id="credit_date" class="form-control" placeholder="Input Bcs Date/By">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="submit_credit" id="submit_credit">
                                </form>
                            </div>

                            </div>
                        </div>
                    </div> <br>
                    <!-- add entry end part -->
                
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>PR</th>
                            <th>OR</th>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Cashier</th>
                            <th>Remarks</th>
                            <th>Bcs Date/By</th>
                            <th></th>
                        </thead>
                        <tbody id="table_credit">
                            <!-- Show data to table part -->
                            <?php 
                                $amount_credit = 0;

                                $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

                                $sql = "SELECT * FROM `credit_transaction` WHERE `date_recorded` = '$current_date'";
                                $amount_credit_sql = "SELECT SUM(`amount`) FROM `credit_transaction` WHERE `date_recorded` = '$current_date'";

                                $query = mysqli_query($conn, $sql);
                                $amount_credit_query = mysqli_query($conn, $amount_credit_sql);

                                $amount_credit_row = mysqli_fetch_array($amount_credit_query);
                                $row = mysqli_num_rows($query);

                                if ($row > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['pr_num'] ?></td>
                                <td><?php echo $row['or_num'] ?></td>
                                <td><?php echo $row['particular'] ?></td>
                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo $row['cashier'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                                <td><?php echo $row['bcs_date'] ?></td>
                                <td width=9%>

                                    <!-- Delete Data part -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletecredit_Modal<?php echo $row['id']; ?>">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deletecredit_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title" style="color:white;">Delete Credit Transaction Entry?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                Do you want to delete this transaction?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn " data-dismiss="modal">No</button>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=credit_transaction">
                                                    <input type="submit" name="delete_credit" id="delete_credit" class="btn btn-danger" value="Delete">
                                                </a>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Data end part -->

                                    <!-- Edit Data part -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editcredit_Modal<?php echo $row['id'];?>">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="editcredit_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title" style="color:white;">Edit Credit Transaction Entry</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="edit_daily.php?id=<?php echo $row['id'];?>" method="POST">
                                                    <label for="credit_edit_name">Name:</label>
                                                    <input type="text" name="credit_edit_name" id="credit_edit_name" class="form-control" placeholder="Input Name" value="<?php echo $row['name'];?>">
                                                    <label for="credit_edit_pr">PR:</label>
                                                    <input type="text" name="credit_edit_pr" id="credit_edit_pr" class="form-control" placeholder="Input PR number" value="<?php echo $row['pr_num'];?>">
                                                    <label for="credit_edit_or">OR:</label>
                                                    <input type="text" name="credit_edit_or" id="credit_edit_or" class="form-control" placeholder="Input OR number" value="<?php echo $row['or_num'];?>">
                                                    <label for="credit_edit_particular">Particular:</label>
                                                    <input type="text" name="credit_edit_particular" id="credit_edit_particular" class="form-control" placeholder="Input Particular" value="<?php echo $row['particular'];?>">
                                                    <label for="credit_edit_amount">Amount:</label>
                                                    <input type="text" name="credit_edit_amount" id="credit_edit_amount" class="form-control" placeholder="Input Amount" value="<?php echo $row['amount'];?>" onkeypress="return isNumber(event)">
                                                    <label for="credit_edit_cashier">Cashier:</label>
                                                    <select class="form-control" name="credit_edit_cashier" id="credit_edit_cashier">
                                                        <option selected>Select Cashier</option>
                                                        <option value="Glydel" <?php if($row['cashier']=='Glydel') {echo "Selected";}?>>Glydel</option>
                                                        <option value="Athena" <?php if($row['cashier']=='Athena') {echo "Selected";}?>>Athena</option>
                                                        <option value="Dianne" <?php if($row['cashier']=='Dianne') {echo "Selected";}?>>Dianne</option>
                                                        <option value="Alvin" <?php if($row['cashier']=='Alvin') {echo "Selected";}?>>Alvin</option>
                                                    </select>
                                                    <label for="credit_edit_remarks">Remarks:</label>
                                                    <input type="text" name="credit_edit_remarks" id="credit_edit_remarks" class="form-control" placeholder="Input Remarks" value="<?php echo $row['remarks'];?>">
                                                    <label for="credit_edit_date">Bcs Date/By:</label>
                                                    <input type="text" name="credit_edit_date" id="credit_edit_date" class="form-control" placeholder="Input Bcs Date/By" value="<?php echo $row['bcs_date'];?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                                <input type="submit" class="btn btn-info" name="edit_credit" id="edit_credit" value="Save">
                                                </form>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Data end part -->

                                </td>
                            </tr>

                            <?php
                                }}
                                else{
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>No Transaction</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>

                            <tr>
                                <td>
                                    <h5>Total Amount:</h5>
                                </td>
                                <td>
                                    <?php if($amount_credit_row[0] == NULL) { echo "-"; } else {echo number_format($amount_credit_row['0'], 2); $amount_credit = round($amount_credit_row['0'], 2);}?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div> <br>

                
                <!--PR TRANSACTION TABLE-->
                <div class="container-fluid mt-3">
                <h2 style="margin-bottom:0%; margin-top:0%;">
                    PR TRANSACTION
                    <!-- add entry part -->
                    <div id="addButton_pr">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pr_Modal" style="float:right; margin-bottom:7px;">
                            Add Entry
                        </button>
                    </div>
                </h2>

                    <div class="modal fade" id="pr_Modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                            <div class="modal-header bg-primary ft-white">
                                <h4 class="modal-title" style="color: white;">Add PR Transaction Entry?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <form action="add_daily.php" method="POST">
                                    <label for="pr_name">Name:</label>
                                    <input type="text" name="pr_name" id="pr_name" class="form-control" placeholder="Input Name">
                                    <label for="pr_pr">PR:</label>
                                    <input type="text" name="pr_pr" id="pr_pr" class="form-control" placeholder="Input PR number">
                                    <label for="pr_or">OR:</label>
                                    <input type="text" name="pr_or" id="pr_or" class="form-control" placeholder="Input OR number">
                                    <label for="pr_particular">Particular:</label>
                                    <input type="text" name="pr_particular" id="pr_particular" class="form-control" placeholder="Input Particular">
                                    <label for="pr_kamount">Amount:</label>
                                    <input type="text" name="pr_amount" id="pr_amount" class="form-control" placeholder="Input Amount" onkeypress="return isNumber(event)">
                                    <label for="pr_cashier">Cashier:</label>
                                    <select class="form-control" name="pr_cashier" id="pr_cashier">
                                        <option selected>Select Cashier</option>
                                        <option value="Glydel">Glydel</option>
                                        <option value="Athena">Athena</option>
                                        <option value="Dianne">Dianne</option>
                                        <option value="Alvin">Alvin</option>
                                    </select>
                                    <label for="pr_remarks">Remarks:</label>
                                    <input type="text" name="pr_remarks" id="pr_remarks" class="form-control" placeholder="Input Remarks">
                                    <label for="pr_date">Bcs Date/By:</label>
                                    <input type="text" name="pr_date" id="pr_date" class="form-control" placeholder="Input Bcs Date/By">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="submit_pr" id="submit_pr">
                                </form>
                            </div>

                            </div>
                        </div>
                    </div> <br>
                    <!-- add entry end part -->
                
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>PR</th>
                            <th>OR</th>
                            <th>Particular</th>
                            <th>Amount</th>
                            <th>Cashier</th>
                            <th>Remarks</th>
                            <th>Bcs Date/By</th>
                            <th></th>
                        </thead>
                        <tbody id="table_pr">
                            <!-- Show data to table part -->
                            <?php 
                                $amount_pr = 0;

                                $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

                                $sql = "SELECT * FROM `pr_transaction` WHERE `date_recorded` = '$current_date'";
                                $amount_pr_sql = "SELECT SUM(`amount`) FROM `pr_transaction` WHERE `date_recorded` = '$current_date'";

                                $query = mysqli_query($conn, $sql);
                                $amount_pr_query = mysqli_query($conn, $amount_pr_sql);

                                $row = mysqli_num_rows($query);
                                $amount_pr_row = mysqli_fetch_array($amount_pr_query);

                                if ($row > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['pr_num'] ?></td>
                                <td><?php echo $row['or_num'] ?></td>
                                <td><?php echo $row['particular'] ?></td>
                                <td><?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo $row['cashier'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                                <td><?php echo $row['bcs_date'] ?></td>
                                <td width=9%>

                                    <!-- Delete Data part -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletepr_Modal<?php echo $row['id']; ?>">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deletepr_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title" style="color:white;">Delete PR Transaction Entry?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                Do you want to delete this transaction?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn " data-dismiss="modal">No</button>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=pr_transaction">
                                                    <input type="submit" name="delete_pr" id="delete_pr" class="btn btn-danger" value="Delete">
                                                </a>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Data end part -->

                                    <!-- Edit Data part -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editpr_Modal<?php echo $row['id'];?>">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="editpr_Modal<?php echo $row['id']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title" style="color:white;">Edit PR Transaction Entry</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="edit_daily.php?id=<?php echo $row['id'];?>" method="POST">
                                                    <label for="pr_edit_name">Name:</label>
                                                    <input type="text" name="pr_edit_name" id="pr_edit_name" class="form-control" placeholder="Input Name" value="<?php echo $row['name'];?>">
                                                    <label for="pr_edit_pr">PR:</label>
                                                    <input type="text" name="pr_edit_pr" id="pr_edit_pr" class="form-control" placeholder="Input PR number" value="<?php echo $row['pr_num'];?>">
                                                    <label for="pr_edit_or">OR:</label>
                                                    <input type="text" name="pr_edit_or" id="pr_edit_or" class="form-control" placeholder="Input OR number" value="<?php echo $row['or_num'];?>">
                                                    <label for="pr_edit_particular">Particular:</label>
                                                    <input type="text" name="pr_edit_particular" id="pr_edit_particular" class="form-control" placeholder="Input Particular" value="<?php echo $row['particular'];?>">
                                                    <label for="pr_edit_amount">Amount:</label>
                                                    <input type="text" name="pr_edit_amount" id="pr_edit_amount" class="form-control" placeholder="Input Amount" value="<?php echo $row['amount'];?>" onkeypress="return isNumber(event)">
                                                    <label for="pr_edit_cashier">Cashier:</label>
                                                    <select class="form-control" name="pr_edit_cashier" id="pr_cashier">
                                                        <option selected>Select Cashier</option>
                                                        <option value="Glydel" <?php if($row['cashier']=='Glydel') {echo "Selected";}?>>Glydel</option>
                                                        <option value="Athena" <?php if($row['cashier']=='Athena') {echo "Selected";}?>>Athena</option>
                                                        <option value="Dianne" <?php if($row['cashier']=='Dianne') {echo "Selected";}?>>Dianne</option>
                                                        <option value="Alvin" <?php if($row['cashier']=='Alvin') {echo "Selected";}?>>Alvin</option>
                                                    </select>
                                                    <label for="pr_edit_remarks">Remarks:</label>
                                                    <input type="text" name="pr_edit_remarks" id="pr_edit_remarks" class="form-control" placeholder="Input Remarks" value="<?php echo $row['remarks'];?>">
                                                    <label for="pr_edit_date">Bcs Date/By:</label>
                                                    <input type="text" name="pr_edit_date" id="pr_edit_date" class="form-control" placeholder="Input Bcs Date/By" value="<?php echo $row['bcs_date'];?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                                <input type="submit" class="btn btn-info" name="edit_pr" id="edit_pr" value="Save">
                                                </form>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Data end part -->

                                </td>
                            </tr>

                            <?php
                                }}
                                else{
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>No Transaction</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>

                            <tr>
                                <td>
                                    <h5>Total Amount:</h5>
                                </td>
                                <td>
                                    <?php if($amount_pr_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_pr_row['0'], 2); $amount_pr = round($amount_pr_row['0'], 2);}?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div> <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <h3>Total Amount Summary</h3>

                <table class="table table-bordered" style="max-width: 65%;" id="amount_summary">
                    <tr>
                        <th> <h5>Cash Transaction:</h5> </th>
                        <td><?php if($amount_cash_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_cash_row['0'], 2);}?></td>
                    </tr>
                    <tr>
                        <th> <h5>Deplsip Transaction:</h5> </th>
                        <td><?php if($amount_depslip_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_depslip_row['0'], 2);}?></td>
                    </tr>
                    <tr>
                        <th> <h5>Check Transaction:</h5> </th>
                        <td><?php if($amount_check_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_check_row['0'], 2);}?></td>
                    </tr>
                    <tr>
                        <th> <h5>Credit Transaction:</h5> </th>
                        <td><?php if($amount_credit_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_credit_row['0'], 2);}?></td>
                    </tr>
                    <tr>
                        <th> <h5>PR Transaction:</h5> </th>
                        <td><?php if($amount_pr_row[0] == NULL) { echo "-" ; } else {echo number_format($amount_pr_row['0'], 2);}?></td>
                    </tr>
                    <tr>
                        <th> <h5>Total Amount:</h5> </th>
                        <td><?php 
                            $total_amount = $amount_cash + $amount_depslip + $amount_check + $amount_credit + $amount_pr;
                            echo number_format($total_amount, 2);
                        ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </body>
    <?php //$total_amount = 0;?>
</html>