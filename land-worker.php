<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HomeBudi | HomeOwner</title>
        <link rel="stylesheet" href="elements.css">
        <link rel="stylesheet" href="land-worker.css">
        <style>
        </style>
        <?php

            session_start();
            require "conn.php";

            $sql = "SELECT COUNT(*)
                    FROM joboffers";

            $result = $conn->query($sql);
            $jobcount = $result->fetch_assoc();


            if($jobcount['COUNT(*)'] > $_SESSION['jobindex']) {

                $sql = "SELECT j.Job_Title, u.U_Prov, u.U_City, c.Cat_Name, j.Job_Sched, j.Job_Len, j.Job_Desc
                        FROM joboffers j
                        INNER JOIN categories c ON j.Cat_ID = c.Cat_ID
                        INNER JOIN users u ON j.U_ID = u.U_ID
                        LIMIT {$_SESSION['jobindex']}, 1;";

                $result = $conn->query($sql);
            }else{

                $_SESSION["jobindex"] = $_SESSION["jobindex"] - 1;

                $sql = "SELECT j.Job_Title, u.U_Prov, u.U_City, c.Cat_Name, j.Job_Sched, j.Job_Len, j.Job_Desc
                    FROM joboffers j
                    INNER JOIN categories c ON j.Cat_ID = c.Cat_ID
                    INNER JOIN users u ON j.U_ID = u.U_ID
                    LIMIT {$_SESSION['jobindex']}, 1;";

                $result = $conn->query($sql);
            }
        
            $row = $result->fetch_assoc();
        ?>
    </head>
    <body class="container">
        <?php require "navbar.php" ?>
        <div id="content">
            <div class="card">
                <div class="card-content">
                    <?php
                        echo
                            '<h1 class="work-title">'.$row["Job_Title"].'</h1>
                            <h2 class="work-location">'.$row["U_Prov"].', '.$row["U_City"].'</h2>
                            <div class="work-info">
                                <div class="key-value">
                                    <a class="info-key">Category:    </a> <a class="info-val">'.$row["Cat_Name"].'</a>
                                </div>
                                <div class="key-value">
                                    <a class="info-key">Schedule:    </a> <a class="info-val">'.$row["Job_Sched"].'</a>
                                </div>
                                <div class="key-value">
                                    <a class="info-key">Duration:    </a> <a class="info-val">'.$row["Job_Len"].' Hours</a>
                                </div>
                                <h2 class="section-title">Job Description:</h2>
                                <div class="desc-text">'.$row["Job_Desc"].'</div>
                            </div>';
                    ?>
                </div>
            </div>
        </div>
        <div id="interact">
            <div class="interact-margin">
                <div class="section">
                    <form class="input-box"action="land-worker.php">
                        <input type="submit" class="submit-active" id="solid_btn" value="Jobs">
                    </form>
                    <form class="input-box"action="land-owner.php">
                        <input type="submit" class="submit" id="solid_btn" value="Workers">
                    </form>
                </div>
                <div class="choose">
                <form class="choose-form" action="jobprev.php" method="post">
                    <button class="choose-btn" type="submit">
                        <img class="choose-icon" src="images/back.png">
                    </button>
                </form>
                <form class="choose-form" action="jobnext.php" method="post">
                    <button class="choose-btn" type="submit">
                        <img class="choose-icon" src="images/next.png">
                    </button>
                </form>
                </div>
                    <?php
                        if($_SESSION['userrole'] == 2){
                            echo "<div class='options'>
                                        <form class='option-form' action='index.html' method='post'>
                                            <button class='option-one' type='submit'>
                                                <img class='choose-icon' src='images/bookmark.png'>
                                            </button>
                                        </form>
                                        <form class='option-form' action='index.html' method='post'>
                                            <button class='option-one' type='submit'>
                                                <img class='choose-icon' src='images/message.png'>
                                            </button>
                                        </form>
                                        <form class='option-two' action='land-owner.php'>
                                            <input type='submit' class='option-two-btn' value='Apply'>
                                        </form>
                                        
                                    </div>";
                        }else if($_SESSION['userrole'] == 3){
                            echo "<div class='options'>
                                        <form class='option-two' style='width: 90%;' action='land-owner.php'>
                                            <input type='submit' class='option-two-btn' value='Register as Worker'>
                                        </form>
                                  </div>";
                        }
                    ?>
            </div>
        </div>
    </body>
</html>