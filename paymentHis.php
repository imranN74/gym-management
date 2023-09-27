<?php
include "header.php";
include "connection.php";
$id= $_SESSION['id'];
$data=[];

// echo "SELECT id,user_id,amount,charge_per_day,final_days,payment_date from payment where user_id='$id'";
// die;
$sql=mysqli_query($con,"SELECT id,user_id,amount,charge_per_day,final_days,payment_date from payment where user_id='$id'");
while($fetch = mysqli_fetch_assoc($sql)){
    $final_days = $fetch['final_days'];
    $Date = $fetch['payment_date'];
    if(!empty($Date)){
     $endDate = date('d-m-Y', strtotime($Date. ' + '.$final_days.' days'));
    }else{
     $endDate = "";
    }

    $data[] = [
        'amount' => $fetch['amount'],
        'final_days' => $fetch['final_days'],
        'payment_date' => $fetch['payment_date'],
        'endDate' => $endDate,
    ];
}

// echo "<pre>";
// print_r($data);
?>
<div class="table-responsive">
<table class="table">
<thead>
        <tr>
            <th scope="col">Sl.No</th>
            <th scope="col">Amount Paid</th>
            <th scope="col">Days</th>
            <th scope="col">Payment date</th>
            <th scope="col">End date</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php 
      foreach($data as $key => $det){ 
    ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $det['amount']; ?></td>
            <td><?php echo $det['final_days']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($det['payment_date'])); ?></td> 
            <td><?php echo $det['endDate']; ?></td> 
        </tr>
        <?php
      }
    ?>
    </tbody>
</table>
</div>