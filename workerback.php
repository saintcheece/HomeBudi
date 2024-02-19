<?php
    session_start();

    if($_SESSION['workerindex'] == 0){
        header("Location:page-land-owner.php");
    }else{
        $_SESSION['workerindex'] = $_SESSION['workerindex'] - 1;
    }

    header("Location:page-land-owner.php");
?>