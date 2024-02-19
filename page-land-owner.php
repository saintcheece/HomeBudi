<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HomeBudi Sign In</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>
    <style>

            .orange{
                background-color: orange;
            }

            .green{
                background-color: green;
            }

            .primary-button{
                background-color: orange;
                border-color: transparent;
            }

            .primary-button:hover{
                background-color: darkorange;
                border-color: darkorange;
            }

            .secondary-button{
                background-color: transparent;
                border-color: grey;
                color: grey;
            }

            .secondary-button:hover{
                background-color: transparent;
                border-color: orange;
                color: orange;
            }

            #disable{
                /* display: none; */
                background-color: black;
                opacity: .5;
                height: 100%;
                position: absolute;
                width: 100%;
                z-index: 5;
                left: 0;
            }
        </style>
    </head>
    <body class="container-fluid">
        <?php
            session_start();
            require "conn.php";

            $sql = "SELECT COUNT(*)
                    FROM users
                    WHERE U_Role = 2";

            $result = $conn->query($sql);
            $workercount = $result->fetch_assoc();

            if($workercount["COUNT(*)"] > $_SESSION["workerindex"]){

                $sql = "SELECT u.U_ID, u.U_FName, u.U_LName, u.U_Prov, u.U_City, u.U_Stat, r.Rev_Text, r.Rev_Score, r.Rev_Date
                FROM users u 
                LEFT JOIN transactions t ON u.U_ID = t.U_ID
                LEFT JOIN review r ON t.Trans_ID = r.Trans_ID
                WHERE u.U_Role = 2
                ORDER BY r.Rev_Date DESC
                LIMIT {$_SESSION['workerindex']}, 1;";

                $result = $conn->query($sql);
                
            }else{
                $_SESSION["workerindex"] = $_SESSION["workerindex"] - 1;

                $sql = "SELECT u.U_ID, u.U_FName, u.U_LName, u.U_Prov, u.U_City, u.U_Stat, r.Rev_Text, r.Rev_Score, r.Rev_Date
                FROM users u 
                LEFT JOIN transactions t ON u.U_ID = t.U_ID
                LEFT JOIN review r ON t.Trans_ID = r.Trans_ID
                WHERE u.U_Role = 2
                ORDER BY r.Rev_Date DESC
                LIMIT {$_SESSION['workerindex']}, 1;";

                $result = $conn->query($sql);
            }
        
            $user = $result->fetch_assoc();

            function getStars($score, $className) {
                $stars = "";
                for ($i = 1; $i <= $score; $i++) {
                    $stars .= '<div class="px-1 d-flex align-items-center" style="aspect-ratio: 1; height: 100%;"><img class="" style="width: 100%;" src="images/star.png"/></div>'; 
                }
                for ($i = $score + 1; $i <= 5; $i++) {
                    $stars .= '<div class="px-1 d-flex align-items-center" style="aspect-ratio: 1; height: 100%;"><img class="" style="width: 100%;" src="images/star-blank.png"/></div>';
                }
                return $stars;
                }

            function getStatus($num){
                switch($num){
                    case 1:
                        return "Active";
                    case 2:
                        return "Stand By";
                    case 3:
                        return "Account Disabled";
                }
            }
        ?>
        <!-- POST JOBS -->
        <div class="modal fade" id="JobPosting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header orange">
                    <h5 class="modal-title" id="staticBackdropLabel" style="color: white">How Can We Help?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="postdetails" class="md-form" action="uploadjob.php" method="POST">
                        <input class="form-control m-1" name="title" type="text" placeholder="Job Title"/>
                        <select class="form-control m-1" name="cat" placeholder="Job Category">
                            <?php
                                $sql = "SELECT Cat_Name, Cat_ID FROM categories";
                                $result = $conn->query($sql);
                                while($ctgrys = $result->fetch_assoc()){
                                    echo '<option value="'.$ctgrys["Cat_ID"].'">'.$ctgrys["Cat_Name"].'</option>';
                                }
                            ?>
                        </select>
                        <textarea name="descr" form="postdetails" class="form-control m-1" type="text" style="height: 150px" placeholder="Job Description"></textarea>
                        <div class="m-1">
                            <div class="row">
                                <div class="col-6">
                                    <input name="sched" class="form-control" type="datetime-local"/>
                                </div>
                                <div class="col-6">
                                    <input name="len" class="form-control" type="number" placeholder="Duration"/>
                                </div>
                            </div>
                        </div>
                        <input name="pay" class="form-control m-1" type="text" placeholder="Additional Pay"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary primary-button" form="postdetails" value="POST JOB"></button>
                </div>
                </div>
            </div>
        </div>
        <!-- SELECT JOB TO ASSIGN -->
        <div class="modal fade" id="JobSelect" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content h-75">
                    <div class="modal-header orange">
                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white">Select Job for <?php echo "{$user["U_FName"]} {$user["U_LName"]}"?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="selectjob" action="ownerattention.php" method="POST">
                            <input name="worker" style="display: none;" value="<?php echo $user["U_ID"]; ?>"/>
                            <select name="job" class="form-select" multiple aria-label="multiple select example" required>
                                <?php
                                    $sql = "SELECT Job_ID, U_ID, Job_Title FROM jobOffers
                                            WHERE U_ID = {$_SESSION['userid']}";
                                    $result = $conn->query($sql);
                                    while($job = $result->fetch_assoc()){
                                        echo '<option value="'.$job["Job_ID"].'">'.$job["Job_Title"].'</option>';
                                    }
                                ?>
                            </select>
                        </form>
                    </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary primary-button" form="selectjob" value="Assign Job"></button>
                </div>
                </div>
            </div>
        </div>
        <?php //require "navbar.php"?>
        <div class="row">
            <div class="col-2 d-flex flex-column flex-shrink-0 p-3 shadow" style="z-index: 1;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <div class="d-flex justify-content-center align-items-center">
                        <img style="width: 70%;" src="images/name.png"/>
                    </div>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link link-dark">
                    <img class="me-2" width="16" height="16" src="images/search.svg"/>
                    Search
                    </a>
                </li>
                <li>
                    <?php
                        if($_SESSION['userrole'] == 3){
                            echo '<a href="page-land-owner.php" class="nav-link active" aria-current="page" style="background-color: orange">';
                        }else if($_SESSION['userrole'] == 2){
                            echo '<a href="page-land-worker.php" class="nav-link active" aria-current="page" style="background-color: orange">';
                        }
                    ?>
                    <img class="me-2" width="16" height="16" src="images/home.svg"/>
                    Home
                    </a>
                </li>
                <li>
                    <a href="page-notif-stp1.php" class="nav-link link-dark">
                    <img class="me-2" width="16" height="16" src="images/notification.svg"/>
                    Notifications
                    </a>
                </li>
                <li>
                    <a href="page-land-message.php" class="nav-link link-dark">
                    <img class="me-2" width="16" height="16" src="images/message.svg"/>
                    Messages
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                    <img class="me-2" width="16" height="16" src="images/profile.svg"/>
                    Profile
                    </a>
                </li>
                </ul>
                <hr>
                <div class="dropdown">
                <a class="d-flex align-items-center justify-content-between link-dark text-decoration-none">
                    <div>
                        <img src="images/profile.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php echo $_SESSION["fname"];?></strong>
                    </div>
                    <form class="side-nav-content" action="page-login.php" method="post">
                        <button class="btn btn-secondary secondary-button p-1" type="submit">Log Out</button>
                    </form>
                </a>
                <!-- <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul> -->
                </div>
            </div>
            <div class="col-5 orange">
                <div class="row align-items-center justify-content-center vh-100">
                    <div class="col-8 card form-signin text-center p-4 shadow" style="height: 90%">
                        <div class="card-content">
                            <?php
                            echo
                            '<div class="d-flex justify-content-center" style="height: 100px;">
                                <div class="rounded-circle h-100" style="aspect-ratio: 1;">
                                    <img class="img-fluid" src="images/profile.png"></img>
                                </div>
                            </div>
                            <p class="h2 m-0">'.$user["U_FName"].' '.$user["U_LName"].'</p>
                            <p class="h5">'.$user["U_Prov"].', '.$user["U_City"].'</p>
                            <div class="activity">
                                <span class="activity-stat">'.getStatus($user["U_Stat"]).'</span>
                            </div>
                            <div class="d-flex justify-content-center my-1" style="height: 6vh;">'.getStars($user["Rev_Score"], "star").'</div>
                            <div class="">
                                <div class="d-flex justify-content-start" style="">
                                    <p class="h5 pt-2">Recent Review</p>
                                </div>';
                            if(is_null($user['Rev_Score'])){
                                echo "<p class='h6 m-3'><em>{$user['U_FName']} {$user['U_LName']} has No Reviews...yet</em></p>";
                            }else{
                                echo '<div class="card p-3">
                                    <div class="review-content" style="">
                                        <div class="d-flex justify-content-between align-content-center">
                                            <div class="row">
                                                <div class="col-6 d-flex justify-content-start align-items-center" style="">
                                                        <div style="" >
                                                        <p class="h5 m-0" style="">'.substr($user["Rev_Date"], 5, 2) .'/'. substr($user["Rev_Date"], 8, 2) .'/'. substr($user["Rev_Date"], 0, 4).'</p> 
                                                        </div>
                                                </div>
                                                <div class="col-6" style="">
                                                    <div class="d-flex">
                                                        '.getStars($user["Rev_Score"], "rev-star").'
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-start pt-2 mb-0">'.$user["Rev_Text"].'</p>
                                    </div>
                                </div>';
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 p-5 shadow" style="background-color: white;">
                <!-- NAVIGATION BUTTONS -->
                <div class="row" style="height: 20%;">
                    <form class="px-4 py-1" action="page-land-worker.php" style="height: 50%;">
                        <input type="submit" class="btn btn-light secondary-button rounded-pill" style="height: 100%; width: 100%;" value="Jobs">
                    </form>
                    <form class="px-4 py-1" action="page-land-owner.php" style="height: 50%;">
                        <input type="submit" class="btn btn-light secondary-button rounded-pill active" style="height: 100%; width: 100%;"value="Workers">
                    </form>
                </div>
                <!-- MOVE BUTTONS -->
                <div class="row p-3" style="height: 55%;">
                    <form class="col-6" action="workerback.php" method="POST">
                        <input type="submit" class="btn btn-light secondary-button" style="height: 100%; width: 100%; font-size: 20vh" value="<"/>
                    </form>
                    <form class="col-6" action="workernext.php" method="POST">
                        <input type="submit" class=" btn btn-light secondary-button" style="height: 100%; width: 100%; font-size: 20vh" value=">"/>
                    </form>
                </div>
                <!-- INTERCATION BUTTONS -->
                <div class="row align-items-center" style="height: 25%;">
                    <div class="col-3 text-center">
                        <button class="btn btn-light secondary-button rounded-circle" style="width: 90%; aspect-ratio: 1;" data-bs-toggle="modal" data-bs-target="#JobPosting">
                        <img class="img-fluid h-75" src="images/cross.svg"/>
                        </button>
                    </div>
                    <div class="col-3 text-center">
                        <button class="btn btn-light secondary-button rounded-circle" style="width: 90%; aspect-ratio: 1;">
                            <img class="img-fluid h-75" src="images/message.svg"/>
                        </button>
                    </div>
                    <div class="col-6 text-center" style='height: 70%;'>
                        <button class='btn btn-primary primary-button rounded-pill btn-lg' style='height: 100%; width: 90%; font-size: 5vh' data-bs-toggle="modal" data-bs-target="#JobSelect">
                                Recruit
                        </button>
                    </div>
                    <!-- <form method='POST' action='workerattention.php' class='col-6 text-center' style='height: 70%;'>
                        <input name='job' type='text' style='display: none;' value='{$row["Job_ID"]}'>
                        <input type='submit' class='btn btn-primary primary-button rounded-pill btn-lg' style='height: 100%; width: 90%; font-size: 5vh'/>
                    </form> -->
                </div>
            </div>
        </div>
        <script>
            function assignOn() {
            document.getElementById("disable").style.display = "block";
            document.getElementById("view-assign").style.display = "block";
            }

            function assignOff() {
            document.getElementById("disable").style.display = "none";
            document.getElementById("view-assign").style.display = "none";
            }

            function postOn() {
            document.getElementById("disable").style.display = "flex";
            document.getElementById("view-post").style.display = "flex";
            }

            function postOff() {
            document.getElementById("disable").style.display = "none";
            document.getElementById("view-post").style.display = "none";
            }

            const modal = document.getElementById('myModal');
            const openModalButton = document.getElementById('openModalButton');

            function openModalButton(){
                modal.show();
            };
        </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>