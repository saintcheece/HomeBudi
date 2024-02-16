<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "sampledb";
   $conn = new mysqli("localhost", "root", "", "homebudi");
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }