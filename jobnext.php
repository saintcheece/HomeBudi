<?php
    session_start();

    $_SESSION['jobindex'] = $_SESSION['jobindex'] + 1;

    header("Location:land-worker.php");

?>