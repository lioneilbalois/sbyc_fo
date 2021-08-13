<<!-- load for tbody per table of daily -->
<?php 
    $date = $_POST['datepicker'];
    $table_name = $_POST['table_sql'];
    
    $conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
    $sql  = "SELECT * FROM `$table_name` WHERE `date_recorded` = '$date'";
    $query = mysqli_query($conn, $sql);
    //$row = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['pr_num'];?></td>
        <td><?php echo $row['or_num'];?></td>
        <td><?php echo $row['particular'];?></td>
        <td> 
			<?php 
				if(is_numeric($row['amount'])) echo number_format($row['amount'], 2);
				else echo $row['amount'];
			?>
		</td>
        <td><?php echo $row['cashier'];?></td>
        <td><?php echo $row['remarks'];?></td>
        <td><?php echo $row['date'];?></td>
        <td>
        
            <!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editcaModal<?php echo $row['id']; ?>">
                Edit
            </button>

            <div class="modal" id="editcaModal<?php echo $row['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header bg-primary">
                        <h4 class="modal-title" style="color: white;">Edit Cash Transaction Entry</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form action="edit.php?id=<?php echo $row['id']; ?>" method="POST">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" placeholder="Input Name" class="form-control" value="<?php echo $row['name'];?>"> 
                                <label for="pr">PR:</label>
                                <input type="text" id="pr" name="pr" placeholder="Input PR" class="form-control" value="<?php echo $row['pr_num'];?>"> 
                                <label for="or">OR:</label>
                                <input type="text" id="or" name="or" placeholder="Input OR" class="form-control" value="<?php echo $row['or_num'];?>"> 
                                <label for="particular">Particular:</label>
                                <input type="text" id="particular" name="particular" placeholder="Input Particular" class="form-control" value="<?php echo $row['particular'];?>"> 
                                <label for="amount">Amount:</label>
                                <input type="text" id="amount<?php echo $row['id']; ?>" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount<?php echo $row['id']; ?>').value))" value="<?php echo $row['amount'];?>"> 
                                <label for="cashier">Cashier:</label>
                                
                    
                                <select class="form-select form-control"  name="cashier" value="<?php echo $row['cashier'];?>">
                                    <option value="" disabled selected>Select Cashier</option>
                                    <option value="Glydel" <?php if($row['cashier'] == 'Glydel') {echo "Selected";}?>>Glydel</option>
                                    <option value="Atheena" <?php if($row['cashier'] == 'Atheena') {echo "Selected";} ?>>Atheena</option>
                                    <option value="Dianne" <?php if($row['cashier'] == 'Dianne') {echo "Selected";} ?>>Dianne</option>
                                    <option value="Alvin" <?php if($row['cashier'] == 'Alvin') {echo "Selected";} ?>>Alvin</option>
                                </select>
                                <label for="remarks">Remarks:</label>
                                <input type="text" id="remarks" name="remarks" placeholder="Input Remarks" class="form-control" value="<?php echo $row['remarks'];?>"> 
                                <label for="date">BCS Date / By:</label>
                                <input type="text" id="date" name="date" placeholder="Input BCS Date / By" class="form-control" value="<?php echo $row['date'];?>"> <br>
                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" value="Save" name="editcaBtn" id="editcaBtn">
                        </div>
                            </form>
                    </div>
                </div>
            </div>
        
        <!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete-->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#deletecaModal<?php echo $row['id'];?>">Delete</button>
            <div class="modal" id="deletecaModal<?php echo $row['id'];?>">
                <div class="modal-dialog">
                <div class="modal-content">

                        <!-- Modal Header -->
                    <div class="modal-header bg-danger ft-white">
                        <h4 class="modal-title" style="color:white;">Delete Cash Transaction Entry </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                        <!-- Modal body -->
                    <div class="modal-body">
                        Do you want to delete this transaction?
                    </div>

                        <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn pull-left btn-default" data-dismiss="modal">No</button>
                        <a href="delete.php?id=<?php echo $row['id'];?>&table=cash_trans"><button type="button" class="btn btn-danger"> Yes </button></a>
                    </div>
                </div>
                </div>
            </div>
        </td>
    </tr>
    
    <?php 
        }}
        else{
            ?>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo 'No Transaction'?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php
        }
        //mysqli_close($conn);
    ?>
