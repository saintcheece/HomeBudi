<?php
    session_start();
    require "conn.php";

    $sql = "SELECT COUNT(*)
            FROM jobattentions
            WHERE Job_ID = {$_POST['job']} AND U_ID = {$_SESSION['userid']}";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if($row["COUNT(*)"] == 0){
        $sql = "INSERT INTO jobattentions (Job_ID, U_ID)
                VALUES ({$_POST['job']}, {$_SESSION['userid']});";
        $conn->query($sql);
    }

    header("Location:page-land-worker.php");
?>