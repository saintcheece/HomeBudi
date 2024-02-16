<?php
  require "conn.php";  

  $email = $_POST['uEmail'];
  $pass = $_POST['uPass'];
  
  $sql = "SELECT * FROM Users WHERE U_Email='$email' AND U_Pass='$pass'";
  $result = $conn->query($sql);

  $conn->close();

  if ($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     if ($row['U_Role'] == 1) {
         header("Location:land-owner.php?c=".$row['U_ID']); 
     } elseif ($row['U_Role'] == 2) {
      header("Location:land-worker.php?c=".$row['U_ID']);
     } elseif ($row['U_Role'] == 0){
         header("Location:land-admin.php?c=".$row['U_ID']);
     }
   } else {
      echo "<script>alert('Email or Password may be incorrect!');</script>";
      header("Location:index.html");
      exit;
   }
?>