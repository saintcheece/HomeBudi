<?php
    session_start();
    require "conn.php";

    $sql = "SELECT COUNT(*)
            FROM jobattentions
            WHERE Job_ID = {$_POST['job']} AND U_ID = {$_SESSION['userid']}";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($row["COUNT(*)"] == 0){
        $sql = "INSERT INTO jobattentions (U_ID, Job_ID, JobAtt_IsByOwner)
                VALUES ({$_POST['worker']}, {$_POST['job']}, 1);";
        $conn->query($sql);
    }
    header("Location:page-notif-stp1.php");
?>