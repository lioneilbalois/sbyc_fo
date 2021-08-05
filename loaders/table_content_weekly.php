<?php 
	date_default_timezone_set('Asia/Manila');	
	$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
	$sel_date = date("Y-m-d");
	
	// to sum amounts per table @ bottom of the page
	function summary($table){
		$getDate = $GLOBALS['sel_date'];
		$sum_q = "SELECT SUM(`amount`) FROM `$table` WHERE `date_recorded` = '$getDate';"; 
		$do_q = mysqli_query($GLOBALS['conn'], $sum_q);
		
		$summ_row = mysqli_fetch_array($do_q);
		if ($summ_row['0'] == NULL) echo "-"; // the query returns NULL if no entry on `amount` to sum
		else echo number_format($summ_row['0'], 2);
	}
?>

<!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE--><!--FIRST TABLE-->
<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-md-12">
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

					<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" id="submit_ca" name="submit_ca" class="btn btn-primary">
					</div>
					</form>
				</div>
				</div>
			</div>
			<table class="table table-bordered ">
				<thead >
					<tr>
						
						<th>Date Recorded</th>
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
				<tbody id="tbody_cash">
				
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
						<td><?php echo $row['date_recorded'];?></td>
						<td><?php echo $row['name'];?></td>
						<td><?php echo $row['pr_num'];?></td>
						<td><?php echo $row['or_num'];?></td>
						<td><?php echo $row['particular'];?></td>
						<td><?php echo number_format($row['amount'], 2) ?></td>
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
						
						<!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete-->
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
			<table class="table table-bordered ">
				<thead >
					<tr>
						
						<th>Date Recorded</th>
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
						<td><?php echo $row['date_recorded'];?></td>
						<td><?php echo $row['name'];?></td>
						<td><?php echo $row['pr_num'];?></td>
						<td><?php echo $row['or_num'];?></td>
						<td><?php echo $row['particular'];?></td>
						<td><?php echo number_format($row['amount'], 2) ?></td>
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
												<input type="text" id="particular" name="particular" placeholder="Input Particular" class="form-control" value="<?php echo $row['particular'];?>"> 
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
	<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-md-12">
			<h3>Check (CK) Transaction <button type="button" class="btn btn-primary" style="float:right;" data-backdrop="static" data-toggle="modal" data-target="#addckModal">Add</button></h3>
			<div class="modal fade" id="addckModal">
				<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header bg-primary ft-white">
					<h4 class="modal-title">Add Check Transaction Entry</h4>
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
						<input type="text" id="amount_check" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount_check').value))"> 
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
					<input type="submit" id="submit_ck" name="submit_ck" class="btn btn-primary">
					</div>
					</form>
				</div>
				</div>
			</div>
			<table class="table table-bordered ">
				<thead >
					<tr>
						<th>Date Recorded</th>
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
					$sql  = "SELECT * FROM `check_trans` WHERE `date_recorded` = '$sel_date'";
					$query = mysqli_query($conn, $sql);
					//$row = mysqli_fetch_array($query);
					$row = mysqli_num_rows($query);
					if ($row > 0) {
						while($row = mysqli_fetch_assoc($query)) {
				?>
					<tr>
						<td><?php echo $row['date_recorded'];?></td>
						<td><?php echo $row['name'];?></td>
						<td><?php echo $row['pr_num'];?></td>
						<td><?php echo $row['or_num'];?></td>
						<td><?php echo $row['particular'];?></td>
						<td><?php echo number_format($row['amount'], 2) ?></td>
						<td><?php echo $row['cashier'];?></td>
						<td><?php echo $row['remarks'];?></td>
						<td><?php echo $row['date'];?></td>
						<td>
						
							<!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit-->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editckModal<?php echo $row['id']; ?>">
								Edit
							</button>

							<div class="modal" id="editckModal<?php echo $row['id']; ?>">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header bg-primary">
										<h4 class="modal-title" style="color: white;">Edit Check Transaction Entry</h4>
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
											<input type="submit" class="btn btn-primary" value="Save" name="editckBtn" id="editckBtn">
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
										<h4 class="modal-title">Delete Check Transaction Entry </h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

										<!-- Modal body -->
									<div class="modal-body">
										Do you want to delete this transaction? <?php echo $row['name'];?>
									</div>

										<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn pull-left btn-default" data-dismiss="modal">No</button>
										<a href="delete.php?id=<?php echo $row['id'];?>&table=check_trans"><button type="button" class="btn btn-danger"> Yes </button></a>
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
	
<!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE--><!--FOURTH TABLE-->
<div class="container-fluid mt-3">
<div class="row">
	<div class="col-md-12">
		<h3>Credit Card (CC) Transaction <button type="button" class="btn btn-primary" style="float:right;" data-backdrop="static" data-toggle="modal" data-target="#addccModal">Add</button></h3>
		<div class="modal fade" id="addccModal">
			<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header bg-primary ft-white">
				<h4 class="modal-title">Add Credit Card Transaction Entry</h4>
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
					<input type="text" id="amount_cc" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount_cc').value))"> 
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
				<input type="submit" id="submit_cc" name="submit_cc" class="btn btn-primary">
				</div>
				</form>
			</div>
			</div>
		</div>
		<table class="table table-bordered ">
			<thead>
				<tr>
					<th>Date Recorded</th>
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
				$sql  = "SELECT * FROM `credit_trans` WHERE `date_recorded` = '$sel_date'";
				$query = mysqli_query($conn, $sql);
				//$row = mysqli_fetch_array($query);
				$row = mysqli_num_rows($query);
				if ($row > 0) {
					while($row = mysqli_fetch_assoc($query)) {
			?>
				<tr>
					<td><?php echo $row['date_recorded'];?></td>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['pr_num'];?></td>
					<td><?php echo $row['or_num'];?></td>
					<td><?php echo $row['particular'];?></td>
					<td><?php echo number_format($row['amount'], 2) ?></td>
					<td><?php echo $row['cashier'];?></td>
					<td><?php echo $row['remarks'];?></td>
					<td><?php echo $row['date'];?></td>
					<td>
					
						<!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit-->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editccModal<?php echo $row['id']; ?>">
							Edit
						</button>

						<div class="modal" id="editccModal<?php echo $row['id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<div class="modal-header bg-primary">
									<h4 class="modal-title" style="color: white;">Edit Credit Card Transaction Entry</h4>
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
										<input type="submit" class="btn btn-primary" value="Save" name="editccBtn" id="editccBtn">
									</div>
										</form>
								</div>
							</div>
						</div>
					
					<!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete-->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#deleteccModal<?php echo $row['id'];?>">Delete</button>
						<div class="modal" id="deleteccModal<?php echo $row['id'];?>">
							<div class="modal-dialog">
							<div class="modal-content">

									<!-- Modal Header -->
								<div class="modal-header bg-danger ft-white">
									<h4 class="modal-title">Delete Credit Card Transaction Entry </h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

									<!-- Modal body -->
								<div class="modal-body">
									Do you want to delete this transaction?
								</div>

									<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn pull-left btn-default" data-dismiss="modal">No</button>
									<a href="delete.php?id=<?php echo $row['id'];?>&table=credit_trans"><button type="button" class="btn btn-danger"> Yes </button></a>
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

<!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE--><!--FIFTH TABLE-->
<div class="container-fluid mt-3">
<div class="row">
	<div class="col-md-12">
		<h3>PR Transaction <button type="button" class="btn btn-primary" style="float:right;" data-backdrop="static" data-toggle="modal" data-target="#addprModal">Add</button></h3>
		<div class="modal fade" id="addprModal">
			<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header bg-primary ft-white">
				<h4 class="modal-title">Add PR Transaction Entry</h4>
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
					<input type="text" id="amount_pr" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount_pr').value))"> 
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
				<input type="submit" id="submit_pr" name="submit_pr" class="btn btn-primary">
				</div>
				</form>
			</div>
			</div>
		</div>
		<table class="table table-bordered ">
			<thead >
				<tr>
					<th>Date Recorded</th>
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
				$sql  = "SELECT * FROM `pr_trans` WHERE `date_recorded` = '$sel_date'";
				$query = mysqli_query($conn, $sql);
				//$row = mysqli_fetch_array($query);
				$row = mysqli_num_rows($query);
				if ($row > 0) {
					while($row = mysqli_fetch_assoc($query)) {
			?>
				<tr>
					<td><?php echo $row['date_recorded'];?></td>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['pr_num'];?></td>
					<td><?php echo $row['or_num'];?></td>
					<td><?php echo $row['particular'];?></td>
					<td><?php echo number_format($row['amount'], 2) ?></td>
					<td><?php echo $row['cashier'];?></td>
					<td><?php echo $row['remarks'];?></td>
					<td><?php echo $row['date'];?></td>
					<td>
					
						<!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit-->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editprModal<?php echo $row['id']; ?>">
							Edit
						</button>

						<div class="modal" id="editprModal<?php echo $row['id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<div class="modal-header bg-primary">
									<h4 class="modal-title" style="color: white;">Edit PR Transaction Entry</h4>
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
										<input type="submit" class="btn btn-primary" value="Save" name="editprBtn" id="editprBtn">
									</div>
										</form>
								</div>
							</div>
						</div>
					
					<!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete-->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#deleteprModal<?php echo $row['id'];?>">Delete</button>
						<div class="modal" id="deleteprModal<?php echo $row['id'];?>">
							<div class="modal-dialog">
							<div class="modal-content">

									<!-- Modal Header -->
								<div class="modal-header bg-danger ft-white">
									<h4 class="modal-title">Delete PR Transaction Entry </h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

									<!-- Modal body -->
								<div class="modal-body">
									Do you want to delete this transaction?
								</div>

									<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn pull-left btn-default" data-dismiss="modal">No</button>
									<a href="delete.php?id=<?php echo $row['id'];?>&table=pr_trans"><button type="button" class="btn btn-danger"> Yes </button></a>
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

<!--SIXTH TABLE--><!--SIXTH TABLE--><!--SIXTH TABLE--><!--SIXTH TABLE--><!--SIXTH TABLE--><!--SIXTH TABLE-->
<div class="container-fluid mt-3">
<div class="row">
	<div class="col-md-12">
		<h3>Send Bill Transaction <button type="button" class="btn btn-primary" style="float:right;" data-backdrop="static" data-toggle="modal" data-target="#addbillModal">Add</button></h3>
		<div class="modal fade" id="addbillModal">
			<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header bg-primary ft-white">
				<h4 class="modal-title">Add Send Bill Transaction Entry</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
				<form action="add.php" method="POST">
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" placeholder="Input Name" class="form-control">
					<label for="invoice">Invoice No:</label>
					<input type="text" id="invoice" name="invoice" placeholder="Input Invoice No." class="form-control"> 
					<label for="particular">Particular:</label>
					<input type="text" id="particular" name="particular" placeholder="Input Particular" class="form-control"> 
					<label for="amount">Amount:</label>
					<input type="text" id="amount_bill" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount_bill').value))"> 
					<label for="cashier">Received By:</label>
					<input type="text" id="received_by" name="received_by" placeholder="Received By:" class="form-control"> 
					<label for="remarks">Remarks:</label>
					<input type="text" id="remarks" name="remarks" placeholder="Input Remarks" class="form-control"> 
					<label for="date">BCS Date / By:</label>
					<input type="text" id="date" name="date" placeholder="Input BCS Date / By" class="form-control"> <br>
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" id="submit_bill" name="submit_bill" class="btn btn-primary">
				</div>
				</form>
			</div>
			</div>
		</div>
		<table class="table table-bordered ">
			<thead>
				<tr>
					<th>Date Recorded</th>
					<th>Name</th>
					<th>Invoice No.</th>
					<th>Particular</th>
					<th>Amount</th>
					<th>Received By</th>
					<th>Remarks</th>
					<th>BCS Date/By</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$conn = new mysqli('localhost', 'root', '', 'sbyc_fo');
				$sql  = "SELECT * FROM `bill_trans` WHERE `date_recorded` = '$sel_date'";
				$query = mysqli_query($conn, $sql);
				//$row = mysqli_fetch_array($query);
				$row = mysqli_num_rows($query);
				if ($row > 0) {
					while($row = mysqli_fetch_assoc($query)) {
			?>
				<tr>
					<td><?php echo $row['date_recorded'];?></td>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['invoice_no'];?></td>
					<td><?php echo $row['particular'];?></td>
					<td><?php echo number_format($row['amount'], 2) ?></td>
					<td><?php echo $row['received_by'];?></td>
					<td><?php echo $row['remarks'];?></td>
					<td><?php echo $row['date'];?></td>
					<td>
					
						<!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit--><!--Edit-->
						<button type="button" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#editbillModal<?php echo $row['id']; ?>">
							Edit
						</button>

						<div class="modal" id="editbillModal<?php echo $row['id']; ?>">
							<div class="modal-dialog">
								<div class="modal-content">

									<div class="modal-header bg-primary">
									<h4 class="modal-title" style="color: white;">Edit Send Bill Transaction Entry</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<div class="modal-body">
										<form action="edit.php?id=<?php echo $row['id']; ?>" method="POST">
											<label for="name">Name:</label>
											<input type="text" id="name" name="name" placeholder="Input Name" class="form-control" value="<?php echo $row['name'];?>"> 
											<label for="invoice">Invoice No.:</label>
											<input type="text" id="invoice" name="invoice" placeholder="Input Invoice No." class="form-control" value="<?php echo $row['invoice_no'];?>"> 
											<label for="particular">Particular:</label>
											<input type="text" id="particular" name="particular" placeholder="Input Particular" class="form-control" value="<?php echo $row['particular'];?>"> 
											<label for="amount">Amount:</label>
											<input type="text" id="amount<?php echo $row['id']; ?>" name="amount" placeholder="Input Amount" class="form-control" onkeypress="return isNumber(event, (document.getElementById('amount<?php echo $row['id']; ?>').value))" value="<?php echo $row['amount'];?>"> 
											<label for="received_by">Received by:</label>
											<input type="text" id="received_by" name="received_by" placeholder="Received By" class="form-control" value="<?php echo $row['received_by'];?>">
											<label for="remarks">Remarks:</label>
											<input type="text" id="remarks" name="remarks" placeholder="Input Remarks" class="form-control" value="<?php echo $row['remarks'];?>"> 
											<label for="date">BCS Date / By:</label>
											<input type="text" id="date" name="date" placeholder="Input BCS Date / By" class="form-control" value="<?php echo $row['date'];?>"> <br>
										
									</div>

									<div class="modal-footer">
										<button type="button" class="btn" data-dismiss="modal">Cancel</button>
										<input type="submit" class="btn btn-primary" value="Save" name="editbillBtn" id="editbillBtn">
									</div>
										</form>
								</div>
							</div>
						</div>
					
					<!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete--><!--delete-->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-backdrop="static" data-target="#deletebillModal<?php echo $row['id'];?>">Delete</button>
						<div class="modal" id="deletebillModal<?php echo $row['id'];?>">
							<div class="modal-dialog">
							<div class="modal-content">

									<!-- Modal Header -->
								<div class="modal-header bg-danger ft-white">
									<h4 class="modal-title">Delete Send Bill Transaction Entry </h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

									<!-- Modal body -->
								<div class="modal-body">
									Do you want to delete this transaction?
								</div>

									<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn pull-left btn-default" data-dismiss="modal">No</button>
									<a href="delete.php?id=<?php echo $row['id'];?>&table=bill_trans"><button type="button" class="btn btn-danger"> Yes </button></a>
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
						<td><?php echo 'No Transaction'?></td>
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
	<!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->  <!--SUMMARY TABLE-->
<div class="container-fluid mt-3">
	<div class="row">

		<div class="col-md-6">
			<h3>Summary</h3>
		
			<table class="table table-bordered" style="max-width: 90%;">
				<thead>
					<tr>
						<th>Transaction Type</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h6>Cash Transaction (CA)</h6></td>
						<td><?php summary('cash_trans'); ?></td>
					</tr>
					<tr>
						<td><h6>Depslip Transaction (DPSLP)</h6></td>
						<td><?php summary('depslip_trans'); ?></td>
					</tr>
					<tr>
						<td><h6>Check Transaction (CK)</h6></td>
						<td><?php summary('check_trans'); ?></td>
					</tr>
					<tr>
						<td><h6>Credit Card Transaction (CC)</h6></td>
						<td><?php summary('credit_trans'); ?></td>
					</tr>
					<tr>
						<td><h6>Provisional Receipt (PR)</h6></td>
						<td><?php summary('pr_trans'); ?></td>
					</tr>
					<tr>
						<td><h6>Send Bill</h6></td>
						<td><?php summary('bill_trans'); ?></td>
					</tr>
					<tr>
						<td><h6>TOTAL TRANSACTIONS</h6></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="col-md-6">
			<hr> <br> <br>
			<h3>Treasury: </h3> <br> <br> <br> 
			<h3>Auditor: </h3>
		</div>

	</div>
</div>
