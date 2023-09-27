<?php 
    include "connection.php";
    session_start();
    if(empty($_SESSION['name'])){
        header("location:login.php");
    }
    // error_reporting(0);

    $nm=$_SESSION['name'];
    $fin_name=explode(" ", $nm);
    $name= $fin_name[0];
    $id=$_SESSION['id'];

    $sql=mysqli_query($con,"SELECT COUNT(*)cnt from users where id='$id' and is_accepted='1'");
$fetch=mysqli_fetch_array($sql);
 $cnt=$fetch['cnt'];
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>FITNESS POINT</title>
    <link rel="stylesheet" href="nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <link rel="icon" type="image/x-icon" href="images/muscle.png">

    <style>
    label {
        font-weight: 500;
    }
    </style>
</head>

<body>
    <nav style="background:#E8F8F5;" class="navbar navbar-expand-lg bg-body-tertiary nv">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="index.php">Fitness Point</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="font-weight:bold;">&#9776;</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                        if($_SESSION['mobile'] == '7250239842'){
                    ?>
                    <li class="nav-item">
                        <a style="color:green;" class="nav-link active filter" href="payment.php">Welcome,FIROJ</a>
                    </li>
					<li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="signup.php">Add User</a>
                    </li>
					<li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="payment.php">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="users.php">Payment List</a>
                    </li>
					<li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="total_collection.php">Total Collection</a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                        <a style="color:green;" class="nav-link active filter"
                            href="index.php">Welcome,<b><?php echo strtoupper($name); ?></b></a>
                    </li>
                    <?php if($cnt>0){ ?>
                    <li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="paymentHis.php">Payment history</a>
                    </li>
                    <?php }else{?>
                    <li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="#form">Payment history</a>
                    </li>
                    <?php } } ?>
                    <?php if(empty($_SESSION['mobile'])){ ?>
                    <li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="login.php">Login</a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                        <a style="color:black;" class="nav-link active filter" href="logout.php">Logout</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>