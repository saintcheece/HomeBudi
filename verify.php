<?php
   require "conn.php";  

   session_start();

   $_SESSION["jobindex"] = 0;
   $_SESSION["workerindex"] = 0;

   $email = $_POST['uEmail'];
   $pass = $_POST['uPass'];

   $sql = "SELECT * FROM Users WHERE U_Email='$email' AND U_Pass='$pass'";
   $result = $conn->query($sql);

   $conn->close();

   if ($result->num_rows > 0) {
      
      $row = $result->fetch_assoc();
      if ($row['U_Role'] == 3) {
         $_SESSION["userid"] = $row['U_ID'];
         $_SESSION["userrole"] = 3;
         header("Location:land-owner.php"); 
      } elseif ($row['U_Role'] == 2) {
         $_SESSION["userid"] = $row['U_ID'];
         $_SESSION["userrole"] = 2;
         header("Location:land-worker.php");
      } elseif ($row['U_Role'] == 1){
      header("Location:land-admin.php?");
   }
   } else {
      echo "<script>alert('Email or Password may be incorrect!');</script>";
      header("Location:index.html");
      exit;
   }
?>