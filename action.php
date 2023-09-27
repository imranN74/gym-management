<?php
session_start();
error_reporting(0);
include "connection.php";

if(isset($_POST['login'])){

    $mobile=$_POST['mobile'];
   


    if($_POST['role'] == 'user'){
        $getquery=mysqli_query($con,"SELECT count(*)cnt FROM users WHERE mobile='$mobile' and pwd=''");
        $fetch=mysqli_fetch_array($getquery);
        $cnt=$fetch['cnt'];

        $getqueryRole=mysqli_query($con,"SELECT id, name FROM users WHERE mobile='$mobile'");
        $fetchRole=mysqli_fetch_array($getqueryRole);
        $name=$fetchRole['name'];
        $id=$fetchRole['id'];

        if($cnt==1){
            $_SESSION['mobile']=$mobile;
            $_SESSION['name']=$name;
            $_SESSION['id']=$id;
            header("location:index.php");
        }else{
            echo "<script>alert('incorrect credential');window.location.href='login.php';</script>";
        }
    }else{
        $pwd=$_POST['password'];
        $getquery=mysqli_query($con,"SELECT count(*)cnt FROM users WHERE mobile='$mobile' and pwd='$pwd'");
        $fetch=mysqli_fetch_array($getquery);
        $cnt=$fetch['cnt'];


        $getqueryRole=mysqli_query($con,"SELECT id,name FROM users WHERE mobile='$mobile'");
        $fetchRole=mysqli_fetch_array($getqueryRole);
        $name=$fetchRole['name'];
        $id=$fetchRole['id'];
        if($cnt==1){
            $_SESSION['name']=$name;
            $_SESSION['mobile']=$mobile;
            $_SESSION['id']=$id;
            header("location:users.php");
        }else{
            echo "<script>alert('incorrect credential');window.location.href='login.php';</script>";
        }
    }
}


if(isset($_POST['signup'])){
    $name=ucwords($_POST['name']);      
    $mobile=$_POST['mobile'];
    $addr=$_POST['addr'];
    $weight=$_POST['weight'];
    $height=$_POST['height'];
    $adm_date=date('Y-m-d',strtotime($_POST['adm_date']));
    $getquery=mysqli_query($con,"SELECT count(*)cnt from users WHERE mobile='$mobile'");
     $fetch=mysqli_fetch_array($getquery);
    $cnt=$fetch['cnt'];
    if($cnt>0){
        echo "<script> alert('Mobile already registered'); </script>";
    }else{
        $ins=mysqli_query($con,"INSERT INTO users(name,mobile,address,weight,height,admission_date) values('$name','$mobile','$addr','$weight','$height','$adm_date')");
        if($ins){
           header("location:payment.php");
        }
    }
}


if(isset($_POST['pay'])){
    $name=$_POST['name'];
    $adm_fee=$_POST['adm_fee'];
    $fee_plan=$_POST['fee_plan'];
    $fee_plan_ex=explode(",", $fee_plan);
    $fee_plan_id=$fee_plan_ex[0];
    $day=$_POST['day'];
    $amount=$_POST['amount'];
    $payment_date=date('Y-m-d',strtotime($_POST['payment_date']));
    $perDay=$_POST['perDay'];
    $finDay=$_POST['finDay'];
    $member=$_POST['member'];  
    $ptype=$_POST['ptype']; //1=full 2=partial
	$endDate = date('Y-m-d', strtotime($_POST['payment_date']. ' + '.$finDay.' days'));
	
    $ins=mysqli_query($con,"INSERT INTO payment(user_id,payment_type,admission_fee,fee_plan_id,day,amount,charge_per_day,final_days,member,payment_date,end_date) values('$name','$ptype','$adm_fee',' $fee_plan_id','$day','$amount','$perDay',' $finDay','$member','$payment_date','$endDate')");

    if($ins){
        header("location:users.php");
    }
}

if(isset($_POST['proceed'])){
    $check=$_POST['check'];
    $id=$_SESSION['id'];
    if($check=='on'){
        $sql=mysqli_query($con,"UPDATE users SET is_accepted=1 where id='$id'");
        if($sql){
            header("location:index.php");
        }
    }
}

if(isset($_POST['partial'])){
	$id              = $_POST['id'];
	$user_id         = $_POST['user_id'];
	$plan            = $_POST['plan'];
	$paid_amt        = $_POST['paid_amt'];
	$due_amt         = $_POST['due_amt'];
	$charge_per_day  = $_POST['charge_per_day'];
	$end_date        = $_POST['end_date'];
	
	$finDay          = floor($due_amt/$charge_per_day);
	$endDate         = date('Y-m-d', strtotime($_POST['end_date']. ' + '.$finDay.' days'));
	
	$ins=mysqli_query($con,"INSERT INTO partial_payment(payment_tbl_id,user_id,plan_id,dues_amt) values('$id','$user_id','$plan','$due_amt')");
	if($ins){
	   $ins=mysqli_query($con,"update payment set end_date='$endDate',final_days=(final_days+'$finDay') where id='$id'");	
       header("location:users.php");
    }
}
?>