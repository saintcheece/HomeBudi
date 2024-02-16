<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HomeBudi Sign In</title>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>
    <style>
            img{
                height: 50px;
            }

            .red{
                background-color: red;
            }

            .green{
                background-color: green;
            }

            body{
                overflow: auto;
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
                border-color: orange;
                border-width: 3px;
                color: orange;
            }

            .secondary-button:hover{
                background-color: orange;
                border-color: orange;
                border-width: 3px;
                color: white;
            }
        </style>
    </head>
    <body class="container-fluid">
        <?php
            session_start();
        
            require "conn.php";
        
            $sql = "SELECT u.U_FName, u.U_LName, u.U_Prov, u.U_City, u.U_Stat, r.Rev_Text, r.Rev_Score, r.Rev_Date
                    FROM users u 
                    INNER JOIN transactions t ON u.U_ID = t.U_ID
                    INNER JOIN review r ON t.Trans_ID = r.Trans_ID
                    ORDER BY r.Rev_Date DESC
                    LIMIT 1;";
            $result = $conn->query($sql);
        
            $user = $result->fetch_assoc();

            function getStars($score, $className) {
                $stars = "";
                for ($i = 1; $i <= $score; $i++) {
                    $stars .= '<img class="'.$className.'" src="images/star.png"/>'; 
                }
                for ($i = $score + 1; $i <= 5; $i++) {
                    $stars .= '<img class="'.$className.'" src="images/star-blank.png"/>';
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
        <!-- <div id="view-assign">
        </div> -->
        <!-- <form action="uploadjob.php" method="POST" id="view-post">
            <button onclick="postOff();">X</button>
            <h2>What Job Do You Have in Mind?</h2>
            <input class="form-inpt" name="title" type="text" placeholder="Job Title"/>
            <select class="form-inpt" name="cat" placeholder="Job Category">
                <?php
                    $sql = "SELECT Cat_Name, Cat_ID FROM categories";
                    $result = $conn->query($sql);
                    while($ctgrys = $result->fetch_assoc()){
                        echo '<option value="'.$ctgrys["Cat_ID"].'">'.$ctgrys["Cat_Name"].'</option>';
                    }
                ?>
            </select>
            <input name="sched" class="form-inpt" type="datetime-local"/>
            <input name="len" class="form-inpt" type="number" placeholder="Duration"/>
            <input name="descr" class="form-inpt" type="text" placeholder="Job Description"/>
            <input name="pay" class="form-inpt" type="text" placeholder="Additional Pay"/>
            <input type="submit" value="Post Job Offer"/>
        </form> -->
        <!-- <div id="view-recruit">
            <button onclick="recruitOff();">X</button>
            <h2>Where Can We Help You?$_COOKIE</h2>
            <input class="form-inpt" type="text" placeholder="Job Title"/>
            <input class="form-inpt" type="datetime-local"/>
            <input class="form-inpt" type="number" placeholder="Duration"/>
            <input class="form-inpt" type="text" placeholder="Job Description"/>
            <input type="submit" value="Post Job Offer"/>
        </div> -->
        <!-- <div id="disable"> -->
        <!-- </div> -->
        <?php //require "navbar.php"?>
        <div class="row">
            <div class="col-2 d-flex flex-column flex-shrink-0 p-3">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Sidebar</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                    Search
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                    Notifications
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                    Messages
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    Profile
                    </a>
                </li>
                </ul>
                <hr>
                <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
                </div>
            </div>
            <div class="col-6 red">
                <div class="row align-items-center justify-content-center vh-100">
                    <div class="col-6 form-signin text-center white p-5 rounded bg-light">
                        <div class="card-content">
                            <?php
                            echo
                            '<div class="profile-image"></div>
                            <h1 class="profile-name">'.$user["U_FName"].' '.$user["U_LName"].'</h1>
                            <h2 class="profile-location">'.$user["U_Prov"].', '.$user["U_City"].'</h2>
                            <div class="activity">
                                <span class="activity-stat">'.getStatus($user["U_Stat"]).'</span>
                            </div>
                            <div class="stars">'.getStars($user["Rev_Score"], "star").'</div>
                            <div class="review-section">
                                <h2 class="section-title">Recent Reviews</h2>
                                <div class="review">
                                    <div class="review-content">
                                        <div class="top-details">
                                            <div class="rev-date">'.substr($user["Rev_Date"], 5, 2) .'/'. substr($user["Rev_Date"], 8, 2) .'/'. substr($user["Rev_Date"], 0, 4).'</div>
                                            <div class="rev-stars">
                                                '.getStars($user["Rev_Score"], "rev-star").'
                                            </div>
                                        </div>
                                        <div class="rev-text">'.$user["Rev_Text"].'</div>
                                    </div>
                                </div>
                            </div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 p-5">
                <div style="height: 37.5%;">
                    <form class="row m-2"action="land-worker.php">
                        <input type="submit" class="btn btn-lg btn-secondary btn-block secondary-button rounded-pill" value="Jobs">
                    </form>
                    <form class="row m-2"action="land-owner.php">
                        <input type="submit" class="btn btn-lg btn-secondary btn-block secondary-button rounded-pill" value="Workers">
                    </form>
                </div>
                <form class="row m-2" style="height: 37.5%;" action="index.html">
                    <button class="btn col-6 btn-lg btn-secondary btn-block secondary-button" onclick="postOn();">
                        <img class="choose-icon" src="images/back.png">
                    </button>
                    <button class="btn col-6 btn-lg btn-secondary btn-block secondary-button" onclick="postOn();">
                        <img class="choose-icon" src="images/next.png">
                    </button>
                </form>
                <div class="row m-2">
                    <button class="col-3 btn btn-lg btn-secondary btn-block secondary-button rounded-circle h-25" onclick="postOn();">
                        <img class="choose-icon" src="images/add.png">
                    </button>
                    <button class="col-3 btn btn-lg btn-secondary btn-block secondary-button rounded-circle h-25">
                        <img class="choose-icon" src="images/message.png">
                    </button>
                    <button class="btn col-6 btn-lg btn-primary btn-block primary-button rounded-pill vh-50" onclick="assignOn();">Recruit</button>
                </div>
            </div>
        </div>
        <!-- <script>
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
        </script> -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>