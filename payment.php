<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<?php 
include "header.php"; 
include "connection.php";
?>

<?php 
     $sql=mysqli_query($con,"SELECT id,name FROM users where status='1' and role <> 2");
     $username=[];
     while($data=mysqli_fetch_assoc($sql)){
         $username[]=$data;
     }  
     
     $fee=mysqli_query($con,"SELECT id,fee_name,no_of_days,per_day_charge FROM fee_plan where status='1'");
     $feeplan=[];
     while($fee_data=mysqli_fetch_assoc($fee)){
         $feeplan[]=$fee_data;
     }  
     
?>
<br />
<form class="form" action="action.php" method="post">
    <center>
        <h1>Fitness Point</h1>
    </center>
    <div class='container'>
        <div style='border:1px solid #000; padding:10px; border-radius:4px;'>

            <div class='row'>
                <div class='col-sm-6'>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <!--1=new member-->
                                <!--2=old member-->
                                
								<label for="">Member Type</label><br>
                                <select name="member" id="member" class='form-control' onchange="getData(this.value)">
                                    <option value="1">Old</option>
                                    <option value="2">New</option>
                                </select>	
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label for="">Payment Type</label><br>
                                <select name="ptype" id="ptype" class='form-control'>
                                    <option value="1">Full</option>
                                    <option value="2">Partial</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class='col-sm-6'>
                    <label for="">Admission Fee</label><br />
                    <input type='text' id='adm' name="adm_fee" value='0' class='form-control' readonly>
                </div>
            </div>
            <br />

            <div class='row'>
                <div class='col-sm-6'>
                    <div class="form-group">
                        <label for="">Name</label><br>
                        <select required name="name" id="name" class='form-control' onchange='getLastDate(this.value)'>
                            <option value="">Select</option>
                            <?php foreach($username as $user){?>
                            <option id="fee_name" value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="row">
                        <div class='col-sm-6'>
                            <label for="">Fee Plan</label><br />
                            <select name="fee_plan" onchange="getDays(this.value)" id="plan" class='form-control'
                                required>
                                <option value="">Select</option>
                                <?php foreach($feeplan as $plan){ ?>
                                <option
                                    value="<?php echo $plan['id']; ?>,<?php echo $plan['no_of_days']; ?>,<?php echo $plan['per_day_charge']; ?>">
                                    <?php echo $plan['fee_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class='col-sm-6'>
                            <label for="">Payment date</label>
                            <input type="date" id='pdate' name="payment_date" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class='row'>
                <div class='col-sm-6'>
                    <div class="row">
                        <div class='col-sm-6'>
                            <label for="">Days</label><br />
                            <input type='text' name="day" id='days' class='form-control' readonly>
                        </div>
                        <div class='col-sm-6'>
                            <label for="">Amount</label><br />
                            <input type='number' onchange="finDays(this.value)" placeholder="Amount" name="amount"
                                id='amount' class='form-control' required>
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label for="">Charge/day</label>
                                <input type="number" autocomplete="off" class="form-control" placeholder="Charge/day"
                                    id="perDay" name="perDay" readonly>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <label for="">Final Days</label><br />
                            <input type='text' name="finDay" id='finDay' class='form-control' readonly>
                        </div>

                    </div>
                </div>
				

            </div>

            <br />
        </div>
    </div>
    <br />
    <div class='row'>
        <div class='col-sm-4'>
            <div class="form-group">
            </div>
        </div>
        <div class='col-sm-4'>
            <div class="form-group">
                <center>
                    <button type='submit' name='pay' class='btn btn-info btn-sm'>PAY</button>
                </center>
            </div>
        </div>
        <div class='col-sm-4'>
            <div class="form-group">
            </div>
        </div>
    </div>
    </div>
    </div>
</form>

</body>

</html>

<script>
function getData(data) {
    if (data == '2') {
        $("#adm").val('200');
		$("#plan").val('');
    }
    if (data == '1') {
        $("#adm").val('0');
    }
}

function getDays(plan_id) {
    let planDays = plan_id.split(',');
    var days = planDays[1];
    $('#finDay').val(days);
    var perDay = planDays[2];
    var plan = Number($('#plan option:selected').text());
    var member = $('#member option:selected').val();

    $('#days').val(days);
    $('#perDay').val(perDay);
    $('#amount').val(plan);
}

function finDays(finDays) {
    var plan = Number($('#plan option:selected').text());
    let amount = Number(finDays);
    let perDay = Number($("#perDay").val());
    let cal = amount / perDay;
    let days = $('#days').val();

	if (plan == finDays) {
		$('#finDay').val(days);
	} else {
		let finCal = Math.floor(cal);
		$('#finDay').val(finCal);
	}
}

function getpars(val) {
    var pars_day = $('#days').val();
    if (val == 'pars') {
        $('#part').val(pars_day);
    }
}


function getLastDate(user_id){
	$.ajax({	
		url:"ajax.php",
		type:"POST",
		data:{user_id:user_id,type:'getEndDate'},
		success:function(ret){
			$("#pdate").val(ret);
		}
	});
}
</script>