<?php
    include "connection.php";
	error_reporting(0);
    if($_POST['type'] == 'getEndDate'){
        $user_id = $_POST['user_id'];
		$sql=mysqli_query($con,"SELECT end_date FROM payment where user_id='$user_id' order by id desc limit 1");
		$data=mysqli_fetch_assoc($sql);
		echo $endDate = !empty($data['end_date'])?$data['end_date']:'';
    }
	
	if($_POST['type'] == 'getPartialdatabyModal'){
        $id = $_POST['id'];
		$sql=mysqli_query($con,"SELECT user_id,final_days,charge_per_day,end_date,(select name from users where id=payment.user_id)name,fee_plan_id,(select fee_name from fee_plan where id=payment.fee_plan_id)plan,amount,(select sum(dues_amt) from partial_payment where user_id=payment.user_id and payment_tbl_id='$id')partial_sum FROM payment where id='$id'");
		$data=mysqli_fetch_assoc($sql);
		$amount = $data['amount'];
		$partial_sum = $data['partial_sum'];
		$tot = ($amount+$partial_sum)
		?>
		
			<table class="table table-bordered table-striped">
				<tr>
					<th>Name:</th>
					<td><?php echo $data['name']; ?><input type='hidden' name='user_id' id='user_id' value="<?php echo $data['user_id']; ?>">
					<input type='hidden' name='id' id='id' value="<?php echo $id; ?>">
					</td>
				</tr>
				<tr>
					<th>Plan:</th>
					<td><?php echo $data['plan']; ?>
					<input type='hidden' name='plan' id='plan' value="<?php echo $data['fee_plan_id']; ?>">
					<input type='hidden' name='plannm' id='plannm' value="<?php echo $data['plan']; ?>"></td>
				</tr>
				<tr>
					<th>Paid Amount:</th>
					<td><?php echo $tot; ?><input type='hidden' name='paid_amt' id='paid_amt' value="<?php echo $tot; ?>"><input type='hidden' name='final_days' id='final_days' value="<?php echo $data['final_days']; ?>"><input type='hidden' name='charge_per_day' id='charge_per_day' value="<?php echo $data['charge_per_day']; ?>">
					<input type='hidden' name='end_date' id='end_date' value="<?php echo $data['end_date']; ?>">
					</td>
				</tr>
				<tr>
					<th>Dues:</th>
					<td><input type='text' value="<?php echo ($data['plan']-$tot); ?>" name='due_amt' id='due_amt' autocomplete='off'></td>
				</tr>
			</table>
		</form>	
		<?php
    }
?>