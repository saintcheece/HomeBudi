<?php
    session_start();

    $_SESSION['jobindex'] = $_SESSION['jobindex'] + 1;

    header("Location:page-land-worker.php");

?>