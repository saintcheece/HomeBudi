<?php
   require "conn.php";  

   session_start();

   $_SESSION["jobindex"] = 0;
   $_SESSION["workerindex"] = 0;

   $email = $_POST['uEmail'];
   $pass = $_POST['uPass'];

   $sql = "SELECT U_ID, U_FName, U_LName, U_Role FROM users WHERE U_Email='$email' AND U_Pass='$pass'";
   $result = $conn->query($sql);

   $conn->close();

   if ($result->num_rows > 0) {
      
      $row = $result->fetch_assoc();
      if ($row['U_Role'] == 3) {
         $_SESSION["fname"] = $row["U_FName"];
         $_SESSION["userid"] = $row['U_ID'];
         $_SESSION["userrole"] = 3;
         header("Location:page-land-owner.php"); 
      } elseif ($row['U_Role'] == 2) {
         $_SESSION["fname"] = $row["U_FName"];
         $_SESSION["userid"] = $row['U_ID'];
         $_SESSION["userrole"] = 2;
         header("Location:page-land-worker.php");
      } elseif ($row['U_Role'] == 1){
         $_SESSION["fname"] = $row["U_FName"];
         header("Location:pageland-admin.php?");
   }
   } else {
      echo "<script>alert('Email or Password may be incorrect!');</script>";
      header("Location:index.html");
      exit;
   }

   // function getUserName($res){
   //    $_SESSION["fullName"] = $res["U_FName"]. ' ' .$res["U_LName"];
   // }
?>