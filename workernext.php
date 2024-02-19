<?php
    session_start();

    $_SESSION['workerindex'] = $_SESSION['workerindex'] + 1;

    header("Location:page-land-owner.php");
?>