<?php
    session_start();
    if($_SESSION['mobile']){
        session_unset();
    header("location:login.php");
    }
?>