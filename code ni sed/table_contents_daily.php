<?php 
    date_default_timezone_set('Asia/Manila'); 
    $current_date = date("Y-m-d");

    $selected_date = $_POST['daily_date'];
    $table = $_POST['table_sql'];
    $delete_modal = $_POST['delete_modal'];
    $edit_modal = $_POST['edit_modal'];
    $delete_entry = $_POST['delete_entry'];
    $edit_entry = $_POST['edit_entry'];

    $amount_table = 0;

    $conn = new mysqli('localhost', 'root', '', 'sbyc_fo1');

    $sql = "SELECT * FROM `$table` WHERE `date_recorded` = '$selected_date'";
    $amount_sql = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$selected_date'";

    $query = mysqli_query($conn, $sql);
    $amount_query = mysqli_query($conn, $amount_sql);

    $row = mysqli_num_rows($query);
    $amount_row = mysqli_fetch_array($amount_query);

    if ($row > 0) {
        while($row = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['pr_num'] ?></td>
    <td><?php echo $row['or_num'] ?></td>
    <td><?php echo $row['particular'] ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['cashier'] ?></td>
    <td><?php echo $row['remarks'] ?></td>
    <td><?php echo $row['bcs_date'] ?></td>
    <td width=9%>

        <!-- Delete Data part -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $delete_modal, $row['id']; ?>" <?php if($current_date != $selected_date){ echo "disabled";}?>>
            Delete
        </button>

        <div class="modal fade" id="<?php echo $delete_modal, $row['id']; ?>">
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
                    <button type="button" class="btn" data-dismiss="modal">No</button>
                    <a href="delete.php?id=<?php echo $row['id']; ?>&table=<?php echo $table;?>">
                        <input type="submit" name="<?php echo $delete_entry;?>" id="<?php echo $delete_entry;?>" class="btn btn-danger" value="Delete">
                    </a>
                </div>

                </div>
            </div>
        </div>
        <!-- Delete Data end part -->

        <!-- Edit Data part -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $edit_modal, $row['id']; ?>" <?php if($current_date != $selected_date){ echo "disabled";}?>>
            Edit
        </button>

        <div class="modal fade" id="<?php echo $edit_modal, $row['id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header bg-info">
                    <h4 class="modal-title" style="color:white;">Edit Cash Transaction Entry</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="edit_daily.php?id=<?php echo $row['id'];?>" method="POST">
                        <label for="edit_name">Name:</label>
                        <input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="Input Name" value="<?php echo $row['name'];?>">
                        <label for="edit_pr">PR:</label>
                        <input type="text" name="edit_pr" id="edit_pr" class="form-control" placeholder="Input PR number" value="<?php echo $row['pr_num'];?>">
                        <label for="edit_or">OR:</label>
                        <input type="text" name="edit_or" id="edit_or" class="form-control" placeholder="Input OR number" value="<?php echo $row['or_num'];?>">
                        <label for="edit_particular">Particular:</label>
                        <input type="text" name="edit_particular" id="edit_particular" class="form-control" placeholder="Input Particular" value="<?php echo $row['particular'];?>">
                        <label for="edit_amount">Amount:</label>
                        <input type="text" name="edit_amount" id="edit_amount" class="form-control" placeholder="Input Amount" value="<?php echo $row['amount'];?>" onkeypress="return isNumber(event)">
                        <label for="edit_cashier">Cashier:</label>
                        <select class="form-control" name="edit_cashier" id="edit_cashier">
                            <option selected>Select Cashier</option>
                            <option value="Glydel" <?php if($row['cashier']=='Glydel') {echo "Selected";}?>>Glydel</option>
                            <option value="Athena" <?php if($row['cashier']=='Athena') {echo "Selected";}?>>Athena</option>
                            <option value="Dianne" <?php if($row['cashier']=='Dianne') {echo "Selected";}?>>Dianne</option>
                            <option value="Alvin" <?php if($row['cashier']=='Alvin') {echo "Selected";}?>>Alvin</option>
                        </select>
                        <label for="edit_remarks">Remarks:</label>
                        <input type="text" name="edit_remarks" id="edit_remarks" class="form-control" placeholder="Input Remarks" value="<?php echo $row['remarks'];?>">
                        <label for="edit_date">Bcs Date/By:</label>
                        <input type="text" name="edit_date" id="edit_date" class="form-control" placeholder="Input Bcs Date/By" value="<?php echo $row['bcs_date'];?>">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-info" name="<?php echo $edit_entry; ?>" id="<?php echo $edit_entry; ?>" value="Save">
                    </form>
                </div>

                </div>
            </div>
        </div>
        <!-- Edit Data end part -->

    </td>
</tr>

<?php
    }
?>

  <?php  } /*end of if*/
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
        <?php if($amount_row[0] == NULL) { echo "-"; } else {echo number_format($amount_row['0'], 2);}?>
    </td>
</tr>




