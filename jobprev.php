<?php
    session_start();

    if($_SESSION['jobindex'] == 0){
        header("Location:page-land-worker.php");
    }else{
        $_SESSION['jobindex'] = $_SESSION['jobindex'] - 1;
    }

    header("Location:page-land-worker.php");

?>