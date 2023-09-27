<?php 
    include "connection.php";
    include "header.php"; 
    error_reporting(0);
?>

<?php
	$currDate = date('d-m-Y');  
    $getTotDays=mysqli_query($con,"SELECT sum(final_days)final_days,sum(amount)amount,payment_date,user_id,(select name from users where id=payment_partial.user_id)name,(select mobile from users where id=payment_partial.user_id)mobile,(select address from users where id=payment_partial.user_id)address,(select admission_date from users where id=payment_partial.user_id)admission_date FROM payment_partial group by user_id");
	$result = array();
    while($getTotDaysRes=mysqli_fetch_assoc($getTotDays)){
		$result[] = [
			'name' => $getTotDaysRes['name'],
			'mobile' => $getTotDaysRes['mobile'],
			'address' => $getTotDaysRes['address'],
			'amount' => $getTotDaysRes['amount'],
			'final_days' => $getTotDaysRes['final_days'],
			'admission_date' => $getTotDaysRes['admission_date'],
			'payment_date' => $getTotDaysRes['payment_date'],
		];
	}

     echo "<pre>";
     print_r($result);
?>

<br />
<div class="table-responsive">
    <!-- &nbsp;&nbsp;<a href="signup.php" class='btn btn-success btn-sm'>ADD NEW USER</a> -->

    <table class="table" id='myTable'>
        <thead>
            <tr>
                <th scope="col">SL No.</th>
                <th scope="col">Name</th>
                <th scope="col">Mobile</th>
                <th scope="col">Address</th>
                <th scope="col">Amount</th>
                <th scope="col">Days</th>
                <th scope="col">Admission date</th>
                <th scope="col">Payment date</th>
                <th scope="col">End date</th>


            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php 
      foreach($result as $key => $user){ 
    ?>
            <tr style="background:<?php echo $user['color']; ?>">
                <td><?php echo $key+1; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['mobile']; ?></td>
                <td><?php echo $user['address']; ?></td>
                <td><?php echo $user['amount']; ?></td>
                <td><?php echo $user['final_days']; ?></td>
                <td><?php echo $user['admission_date']; ?></td>
                <td><?php echo $user['admission_date']; ?></td>
                <td><?php echo $user['endDate']; ?></td>
            </tr>
            <?php
      }
    ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#myTable').DataTable({
        sorting: false,
        paging: false
    });
});
</script>