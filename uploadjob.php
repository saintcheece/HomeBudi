<?php
    session_start();
    require "conn.php";

    $sql = "INSERT INTO joboffers (U_ID, Job_Title, Cat_ID, Job_Sched, Job_Len, Job_Desc, Job_Pay )
    VALUES ({$_SESSION['userid']}, '{$_POST['title']}', {$_POST['cat']}, '".date("Y-m-d\TH:i:s", strtotime($_POST['sched']))."', {$_POST['len']}, '{$_POST['descr']}', {$_POST['pay']})";

    header("Location:page-land-owner.php");

    $conn->query($sql);
?>