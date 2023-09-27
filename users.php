<?php 
    include "connection.php";
    include "header.php"; 
    error_reporting(0);
?>

<br />
<div class='container'>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id='myTable'>
        <thead>
            <tr style='background:#000; color:#fff'>
                <th scope="col">SL No.</th>
                <th scope="col">Name</th>
                <th scope="col">Mob.</th>
                <th scope="col">Addr.</th>
                <th scope="col">Pay Type</th>
                <th scope="col">Plan</th>
                <th scope="col">Amt.</th>
                <th scope="col">Tot. Days</th>
                <th scope="col">Adm. date</th>
                <th scope="col">Pay. date</th>
                <th scope="col">End date</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
				$getMaxId=mysqli_query($con,"SELECT MAX(id) id FROM payment GROUP by user_id ORDER by MAX(id) DESC;");
				$maxIdArr = array();
				while($getMaxIdRes=mysqli_fetch_assoc($getMaxId)){
					$maxIdArr[] = $getMaxIdRes;
				}
				$i=0;
				foreach($maxIdArr as $key => $val){
					$sql = "SELECT *,(select name from users where id=payment.user_id)name,(select mobile from users where id=payment.user_id)mobile,(select address from users where id=payment.user_id)address,(select admission_date from users where id=payment.user_id)admission_date,(select fee_name from fee_plan where id=payment.fee_plan_id)plan FROM payment where id='".$val['id']."'";
					
					$getdata=mysqli_query($con,$sql);
					while($getdataRes=mysqli_fetch_assoc($getdata)){
						$i++;
						
						$getPartialAmtQry=mysqli_query($con,"select dues_amt from partial_payment where user_id='".$getdataRes['user_id']."' and payment_tbl_id='".$getdataRes['id']."'");
						$partailArr = array();
						while($getPartialRes=mysqli_fetch_assoc($getPartialAmtQry)){
							$partailArr[] = $getPartialRes['dues_amt'];
						}
						
						if(!empty($partailArr)){
							$arr_sum=array();
							foreach($partailArr as $key => $val){
								$arr_sum[] = $val;
							}
							$arraySum = array_sum($arr_sum);
						}else{
							$arraySum = 0;
						}
						
						if($getdataRes['payment_type']==2){
							$totChk = $arraySum+$getdataRes['amount'];
							if($getdataRes['plan'] > $totChk){
								$ptype = "<span class='badge bg-danger'>Partial</span> &nbsp;<button class='badge bg-success' onclick='getDatabyModal(".$getdataRes['id'].")'>&#65291;
							</button>";
							}else{
								$ptype = "<span class='badge bg-success'>Partial Completed</span> &nbsp";
							}
						}else{
							$ptype = "<span class='badge bg-success'>Full</span>";
						}
						
						
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $getdataRes['name']; ?></td>
								<td><?php echo $getdataRes['mobile']; ?></td>
								<td><?php echo $getdataRes['address']; ?></td>
								<td><?php echo $ptype; ?></td>
								<td><?php echo $getdataRes['plan']; ?></td>
								<td>
									<?php echo $getdataRes['amount']; ?>
									<br />
									<?php
										if(!empty($partailArr)){
											$arr_sum=array();
											foreach($partailArr as $key => $val){
												echo $val."<br />";
												$arr_sum[] = $val;
											}
											$arraySum = array_sum($arr_sum);
										}else{
											$arraySum = 0;
										}
									?>
									
									<?php
										if($getdataRes['payment_type']==2){
											$tot_partial = ($arraySum+$getdataRes['amount']);
											echo "<span class='badge bg-info'><b>$tot_partial<b/></span>";
										}
									?>
								</td>
								<td><?php echo $getdataRes['final_days']; ?></td>
								<td><?php echo date('d-M-Y',strtotime($getdataRes['admission_date'])); ?></td>
								<td><?php echo date('d-M-Y',strtotime($getdataRes['payment_date'])); ?></td>
								
								<?php
									$ed = strtotime($getdataRes['end_date']);
									$cd = strtotime(date('d-M-Y'));
									if($ed < $cd){
										$bg = "red";
									}else{
										$bg = "";
									}
								?>
								
								<td style="background:<?php echo $bg; ?>"><b><?php echo date('d-M-Y',strtotime($getdataRes['end_date'])); ?></b></td>
							</tr>
						<?php
					} 
				}
				
			?>
        </tbody>
    </table>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Partial Payment</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
	  <form action='action.php' method='post' onsubmit="return mySubmitFunction(event)">
		  <div class="modal-body" id='load'>
			
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="submit" name='partial' class="btn btn-success btn-sm">SUBMIT</button>
		  </div>
	  </form>

    </div>
  </div>
</div>
<!-- End Modal -->


</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#myTable').DataTable({
        sorting: false,
        paging: false
    });
});


function getDatabyModal(id){
	$.ajax({	
		url:"ajax.php",
		type:"POST",
		data:{id:id,type:'getPartialdatabyModal'},
		success:function(res){
			$("#load").html(res);
			$("#myModal").modal('show');
		}
	});
}

function mySubmitFunction(){
	var plan = Number($("#plannm").val());
	
	var due_amt = Number($("#due_amt").val());
	var paid_amt = Number($("#paid_amt").val());
	var tog = (due_amt+paid_amt);
	
	if(plan < tog){
		alert('Your Amount is Invalid Try Again..!');
		return false;
	}
	
}
</script>