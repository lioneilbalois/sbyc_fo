<?php 
	date_default_timezone_set('Asia/Manila');	
	$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
	$sel_date = date("Y-m-d");

	// apply sorted date, this is the main variable for all table and sorts
	if($_GET['now'] != 'true'){
		$sel_date = $_GET['date_sort'];
	}
	
	// to sum amounts per table @ bottom of the page
	function summary($table){
		$getDate = $GLOBALS['sel_date'];
		$sum_q = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$getDate';"; 
		$do_q = mysqli_query($GLOBALS['conn'], $sum_q);
		
		$summ_row = mysqli_fetch_array($do_q);
		if(mysqli_num_rows($do_q)) echo ($summ_row['0']);
		if ($summ_row['0'] == "") echo "-";
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js" ></script>
	<script src="js/script.js"></script>
	
    <title>Front Office</title>
  </head>
  <body>
	<!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE-->
	  <div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12">
				<h3> Date: <input type="date" value="<?php echo $sel_date; ?>" id="date_selector"> </h3> <hr>				
				<h3>Cash (CA) Transaction <button type="button" class="btn btn-primary" style="float:right;" data-backdrop="static" data-toggle="modal" data-target="#addcaModal">Add</button></h3>
				<div class="modal fade" id="addcaModal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <div class="modal-header bg-primary ft-white">
						<h4 class="modal-title">Add Cash Transaction Entry</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>

					  <div class="modal-body">
						<form action="add.php" method="POST">
							<label for="name">Name:</label>
							<input type="text" id="name" name="name" placeholder="Input Name" class="form-control">
							<label for="pr">PR:</label>
							<input type="text" id="pr" name="pr" placeholder="Input PR" class="form-control"> 
							<label for="or">OR:</label>
							<input type="text" id="or" name="or" placeholder="Input OR" class="form-control"> 
							<label for="particular">Particular:</label>
							<input type="text" id="particular" id="particular" placeholder="Input Particular" class="form-control"> 
							<label for="amount">Amount:</label>
							<input type="text" id="amount_cash" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount_cash').value))"> 
							<label for="cashier">Cashier:</label>
							<select class="form-select form-control" aria-label="Default select example" name="cashier">
							  <option selected disabled>Select Cashier</option>
							  <option value="Atheena">Atheena</option>
							  <option value="Dianne">Dianne</option>
							  <option value="Alvin">Alvin</option>
							  <option value="Glydel">Glydel</option>
							</select> 
							<label for="remarks">Remarks:</label>
							<input type="text" id="remarks" name="remarks" placeholder="Input Remarks" class="form-control"> 
							<label for="date">BCS Date / By:</label>
							<input type="text" id="date" name="date" placeholder="Input BCS Date / By" class="form-control"> <br>
						
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" id="submit_ca" name="submit_ca" class="btn btn-primary">
					  </div>
						</form>
					</div>
				  </div>
				</div>
				<table class="table table-bordered table-striped">
					<thead class="thead-light">
						<tr>
							
							<th>Name</th>
							<th>PR</th>
							<th>OR</th>
							<th>Particular</th>
							<th>Amount</th>
							<th>Cashier</th>
							<th>Remarks</th>
							<th>BCS Date/By</th>
							<th></th>
						
						<tr>
					</thead>
					<tbody>
					<?php 
						$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
						$sql  = "SELECT * FROM `cash_trans` WHERE `date_recorded` = '$sel_date'";
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
							<td><?php echo $row['amount'];?></td>
							<td><?php echo $row['cashier'];?></td>
							<td><?php echo $row['remarks'];?></td>
							<td><?php echo $row['date'];?></td>
							<td>
							
								<button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editcaModal<?php echo $row['id']; ?>">
									Edit
								</button>

								<!-- The Modal edit-->
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
													<input type="text" id="particular" id="particular" placeholder="Input Particular" class="form-control" value="<?php echo $row['particular'];?>"> 
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
							
							<!--delete-->
							<button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#deletecaModal<?php echo $row['id'];?>">Delete</button>
								<div class="modal" id="deletecaModal<?php echo $row['id'];?>">
								  <div class="modal-dialog">
									<div class="modal-content">

										  <!-- Modal Header -->
										<div class="modal-header bg-danger ft-white">
											<h4 class="modal-title">Delete Cash Transaction Entry </h4>
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
					</tbody>
				
				</table>
				
			</div>
		</div>
	  </div>
	  
	<!--SECOND TABLE--><!--SECOND TABLE--><!--SECOND TABLE--><!--SECOND TABLE--><!--SECOND TABLE--><!--SECOND TABLE--><!--SECOND TABLE-->
		<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12">
				<h3>Depslip Transaction (DPSLP)<button type="button" class="btn btn-primary" style="float:right;" data-backdrop="static" data-toggle="modal" data-target="#adddpModal">Add</button></h3>
				<div class="modal fade" id="adddpModal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <div class="modal-header bg-primary ft-white">
						<h4 class="modal-title">Add Deposit Slip Transaction Entry</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>
	
					  <div class="modal-body">
						<form action="add.php" method="POST">
							<label for="name">Name:</label>
							<input type="text" id="name" name="name" placeholder="Input Name" class="form-control">
							<label for="pr">PR:</label>
							<input type="text" id="pr" name="pr" placeholder="Input PR" class="form-control"> 
							<label for="or">OR:</label>
							<input type="text" id="or" name="or" placeholder="Input OR" class="form-control"> 
							<label for="particular">Particular:</label>
							<input type="text" id="particular" name="particular" placeholder="Input Particular" class="form-control"> 
							<label for="amount">Amount:</label>
							<input type="text" id="amount_depslip" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount_depslip').value))"> 
							<label for="cashier">Cashier:</label>
							<select class="form-select form-control" aria-label="Default select example" name="cashier">
							  <option selected disabled>Select Cashier</option>
							  <option value="Atheena">Atheena</option>
							  <option value="Dianne">Dianne</option>
							  <option value="Alvin">Alvin</option>
							  <option value="Glydel">Glydel</option>
							</select> 
							<label for="remarks">Remarks:</label>
							<input type="text" id="remarks" name="remarks" placeholder="Input Remarks" class="form-control"> 
							<label for="date">BCS Date / By:</label>
							<input type="text" id="date" name="date" placeholder="Input BCS Date / By" class="form-control"> <br>
						
					  </div>

					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" id="submit_dp" name="submit_dp" class="btn btn-primary">
					  </div>
						</form>
					</div>
				  </div>
				</div>
				<table class="table table-bordered table-striped">
					<thead class="thead-light">
						<tr>
							
							<th>Name</th>
							<th>PR</th>
							<th>OR</th>
							<th>Particular</th>
							<th>Amount</th>
							<th>Cashier</th>
							<th>Remarks</th>
							<th>BCS Date/By</th>
							<th></th>
						
						<tr>
					</thead>
					<tbody>
					<?php 
						$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
						$sql  = "SELECT * FROM `depslip_trans` WHERE `date_recorded` = '$sel_date'";
						$query = mysqli_query($conn, $sql);
						$row = mysqli_num_rows($query);
						if ($row > 0) {
						  while($row = mysqli_fetch_assoc($query)) {
					?>
						<tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['pr_num'];?></td>
							<td><?php echo $row['or_num'];?></td>
							<td><?php echo $row['particular'];?></td>
							<td><?php echo $row['amount'];?></td>
							<td><?php echo $row['cashier'];?></td>
							<td><?php echo $row['remarks'];?></td>
							<td><?php echo $row['date'];?></td>
							<td>
							
								<button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editdpModal<?php echo $row['id']; ?>">
									Edit
								</button>

								<!-- The Modal edit-->
								<div class="modal" id="editdpModal<?php echo $row['id']; ?>">
									<div class="modal-dialog">
										<div class="modal-content">

											<div class="modal-header bg-primary ft-white">
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
													<input type="text" id="particular" id="particular" placeholder="Input Particular" class="form-control" value="<?php echo $row['particular'];?>"> 
													<label for="amount">Amount:</label>
													<input type="text" id="amount<?php echo $row['id']; ?>" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, document.getElementById('amount<?php echo $row['id']; ?>').value)" value="<?php echo $row['amount'];?>"> 
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
												<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
												<input type="submit" class="btn btn-primary" value="Save" name="editdpBtn" id="editdpBtn">
											</div>
												</form>
										</div>
									</div>
								</div>
							
							<!--delete-->
							<button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#deletedpModal<?php echo $row['id'];?>">Delete</button>
								<div class="modal" id="deletedpModal<?php echo $row['id'];?>">
								  <div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header bg-danger ft-white">
											<h4 class="modal-title">Delete Cash Transaction Entry </h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<div class="modal-body">
											Do you want to delete this transaction?
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											<a href="delete.php?id=<?php echo $row['id'];?>&table=depslip_trans"><button type="button" class="btn btn-danger"> Yes </button> </a>
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
					</tbody>
				
				</table>

				
			</div>
		</div>
	  </div>
	  <!--THIRD TABLE--><!--THIRD TABLE--><!--THIRD TABLE--><!--THIRD TABLE--><!--THIRD TABLE--><!--THIRD TABLE--><!--THIRD TABLE-->
	  
	  
	  
	  
	  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-12">
				<h3>Summary</h3>
			
				<table class="table table-bordered table-striped" style="max-width: 50%;">
					<thead>
						<tr>
							<th>Transaction Type</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Cash Transaction (CA)</th>
							<td><?php summary('cash_trans'); ?></td>
						</tr>
						<tr>
							<th>Depslip Transaction (DPSLP)</th>
							<td><?php summary('depslip_trans'); ?></td>
						</tr>
						<tr>
							<th>Check Transaction (CK)</th>
							<td><?php summary('check_trans'); ?></td>
						</tr>
						<tr>
							<th>Credit Card Transaction (CC)</th>
							<td><?php summary('credit_trans'); ?></td>
						</tr>
						<tr>
							<th>Provisional Receipt (PR)</th>
							<td><?php summary('pr_trans'); ?></td>
						</tr>
						<tr>
							<th>Send Bill</th>
							<td><?php summary('bill_trans'); ?></td>
						</tr>
						<tr>
							<th>TOTAL TRANSACTIONS</th>
							<td></td>
						</tr>
					</tbody
				</table>
			</div>
		</div>
	</div>
  </body>
</html>