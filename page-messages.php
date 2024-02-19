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
    <?php
        session_start();
        require "conn.php";

        $sql = "SELECT COUNT(*)
                FROM joboffers";

        $result = $conn->query($sql);
        $jobcount = $result->fetch_assoc();


        if($jobcount['COUNT(*)'] > $_SESSION['jobindex']) {
            $sql = "SELECT j.Job_ID, j.Job_Title, u.U_Prov, u.U_City, c.Cat_Name, c.Cat_Charge, j.Job_Sched, j.Job_Len, j.Job_Desc, j.Job_Pay
                    FROM joboffers j
                    INNER JOIN categories c ON j.Cat_ID = c.Cat_ID
                    INNER JOIN users u ON j.U_ID = u.U_ID
                    LIMIT {$_SESSION['jobindex']}, 1;";

            $result = $conn->query($sql);
        }else{  

            $_SESSION["jobindex"] = $_SESSION["jobindex"] - 1;

            $sql = "SELECT j.Job_ID, j.Job_Title, u.U_Prov, u.U_City, c.Cat_Name, c.Cat_Charge, j.Job_Sched, j.Job_Len, j.Job_Desc, J.Job_Pay
                    FROM joboffers j
                    INNER JOIN categories c ON j.Cat_ID = c.Cat_ID
                    INNER JOIN users u ON j.U_ID = u.U_ID
                    LIMIT {$_SESSION['jobindex']}, 1;";

            $result = $conn->query($sql);
        }
    
        $row = $result->fetch_assoc();
    ?>
    </head>
    <body class="container-fluid">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        
                        <textarea name="descr" form="postdetails" class="form-control m-1" type="text" style="height: 150px" placeholder="Job Description"></textarea>
                        <input name="pay" class="form-control m-1" type="text" placeholder="Additional Pay"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary primary-button" form="postdetails" value="POST JOB"></button>
                </div>
                </div>
            </div>
        </div>
        <?php //require "navbar.php"?>
        <div class="row">
            <div class="col-2 d-flex flex-column flex-shrink-0 p-3">
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
                            echo '<a href="page-land-owner.php" class="nav-link link-dark" aria-current="page">';
                        }else if($_SESSION['userrole'] == 2){
                            echo '<a href="page-land-worker.php" class="nav-link link-dark" aria-current="page">';
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
                    <a href="page-messages.php" class="nav-link link-dark" active style="background-color: orange">
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
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
                </div>
            </div>
            <div class="col-2 orange" style="background-color: darkorange">
            <ul class="nav nav-pills flex-column mb-auto justify-content-center p-3 my-5">
                
                </ul>
            </div>
            <div class="col-8 vh-100 orange">
                
            </div>
        </div>
        <script>
        </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>