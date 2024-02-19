<?php
    require "conn.php";

    $sql = "INSERT INTO users (U_Email, U_Pass, U_FName, U_LName, U_Country, U_City, U_Prov, U_Town, U_HNum )
    VALUES ('{$_POST['email']}', '{$_POST['pass']}', '{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['cntry']}', '{$_POST['city']}', '{$_POST['prov']}', '{$_POST['town']}', '{$_POST['hnum']}')";

    header("Location:index.php");

    $conn->query($sql);
?>