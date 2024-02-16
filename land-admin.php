<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HomeBudi | HomeOwner</title>
        <link rel="stylesheet" href="elements.css">
        <!-- <link rel="stylesheet" href="land-owner.css"> -->
        <style>
a{
    font-size: 300%;
}
table{
    border: black solid 1px;
    background-color: black;
}

th{
    background-color: #ee5225;
    padding: 10px;
    color: white;
}

td{
    background-color: white;
    padding: 10px;
}
.container{
    margin: 0;
    display: flex;
    height: 100vh; width: 100vw;
}

#content{
    display: flex;
    justify-content:center;
    align-items: center;
    background-color: lightgrey;
    width: 100%;
}
        </style>
    </head>
    <body class="container"> 
        <div id="content">
        <?php

            require "conn.php";

            $sql = "SELECT t.Trans_ID, c.Cat_Name, c.Cat_Charge, j.Job_Pay, t.Trans_Cut, j.U_ID AS HomeOwner, t.U_ID AS Worker, t.Trans_IsPaid, j.Job_Sched
                    FROM transactions t
                    INNER JOIN joboffers j ON t.Job_ID = j.Job_ID
                    INNER JOIN categories c ON j.Cat_ID = c.Cat_ID";
            $result = $conn->query($sql);

            $conn->close();

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Transaction ID</th>";
                echo "<th>Category Name</th>";
                echo "<th>Category Charge</th>";
                echo "<th>Job Pay</th>";
                echo "<th>Transaction Cut</th>";
                echo "<th>Homeowner ID</th>";
                echo "<th>Worker ID</th>";
                echo "<th>Payment Status</th>";
                echo "<th>Job Date</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
            
                while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Trans_ID'] . "</td>";
                echo "<td>" . $row['Cat_Name'] . "</td>";
                echo "<td>" . $row['Cat_Charge'] . "</td>";
                echo "<td>" . $row['Job_Pay'] . "</td>";
                echo "<td>" . $row['Trans_Cut'] . "</td>";
                echo "<td>" . $row['HomeOwner'] . "</td>";
                echo "<td>" . $row['Worker'] . "</td>";
                echo "<td>" . $row['Trans_IsPaid']. "</td>";
                echo "<td>" . $row['Job_Sched']. "</td>";
                echo "</tr>";
                }
            
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No transactions found.";
            }
            ?>
        </div>
    </body>
</html>