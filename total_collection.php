<?php
error_reporting(0);
include "header.php";
include "connection.php";
$id= $_SESSION['id'];
if(isset($_POST['submit'])){
	$start_date = date('Y-m-d',strtotime($_POST['start_date']));
	$end_date   = date('Y-m-d',strtotime($_POST['end_date']));
	
	$sql = "select p.user_id,p.payment_type,p.amount,u.name,p.payment_date,p.end_date,p.created_at from payment as p join users as u on p.user_id=u.id where date(p.created_at) between '$start_date' and '$end_date'";
					
	$getdata=mysqli_query($con,$sql);
	$result = array();
	while($getdataRes=mysqli_fetch_assoc($getdata)){
		$result[] = $getdataRes;
	}
	
	$sql1 = "select pp.dues_amt,pp.created_at,u.name from partial_payment as pp join users as u on pp.user_id=u.id where date(pp.created_at) between '$start_date' and '$end_date'";
	
	$getdata1=mysqli_query($con,$sql1);
	$result1 = array();
	while($getdataRes1=mysqli_fetch_assoc($getdata1)){
		$result1[] = $getdataRes1;
	}
	
}
?>
<br /><br />
<div class='container'>
	<form action='' method='POST'>
	<div class='row'>
		<div class='col-sm-6'><b>START DATE</b><br /><input type='date' name='start_date' class='form-control'></div>
		<div class='col-sm-6'><b>END DATE</b><br /><input type='date' name='end_date' class='form-control'></div>
	</div>
	<br />
	<div class='row'>
		<div class='col-sm-12'>	
			<center><input type='submit' name='submit' value='SUBMIT' class='btn btn-success'></center>
		</div>
	</div>
	</form>
	<br /><br />
	<?php
		if(!empty($result)){
			?>
				<div class='table-responsive'>
				<table class='table table-bordered table-striped'>
					<tr>
						<th>Sl. No.</th>
						<th>Name</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Payment Date</th>
						<th>Amount</th>
					</tr>
					<?php
						$tot = 0;
						foreach($result as $key => $val){
								$tot += $val['amount'];
								?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $val['name']; ?></td>
										<td><?php echo date('d-M-Y',strtotime($val['payment_date'])); ?></td>
										<td><?php echo date('d-M-Y',strtotime($val['end_date'])); ?></td>
										<td><?php echo date('d-M-Y',strtotime($val['created_at'])); ?></td>
										<td><?php echo $val['amount']; ?> Rs.</td>
									</tr>
								<?php
						}
					?>
					<tr>
						<th colspan='6'><center><b>PARTIAL PAYMENT</b></center></th>
					</tr>
					<?php	
						$tot1 = 0;
						foreach($result1 as $key => $val){
							$tot1 += $val['dues_amt'];
							?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td><?php echo $val['name']; ?></td>
									<td></td>
									<td></td>
									<td><?php echo date('d-M-Y',strtotime($val['created_at'])); ?></td>
									<td><?php echo $val['dues_amt']; ?> Rs.</td>
								</tr>
							<?php
						}
					?>
					<tr>
						<td colspan='5' style='text-align:right'><b>TOTAL</b></td>
						<td><?php echo ($tot+$tot1); ?></td>
					</tr>
				</table>
				</div>
			<?php
		}
	?>
	<br /><br /><br />
</div>
