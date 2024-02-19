<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HomeBudi Sign In</title>
    <script src="services/jquery-3.7.1.min.js"></script>
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

        <div id="confirm" class="modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header orange">
                        <h5 class="modal-title text-light">Confirm Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                    <div class="modal-content">
                        <p class="value-display"></p>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
                    <a href="#" class="nav-link active" style="background-color: orange">
                    <img class="me-2" width="16" height="16" src="images/notification.svg"/>
                    Notifications
                    </a>
                </li>
                <li>
                    <a href="page-messages.php" class="nav-link link-dark">
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
                </div>
            </div>
            <div class="col-2 orange p-0" style="background-color: darkorange">
            <ul class="nav flex-column mb-auto justify-content-center my-5">
                <li class="nav-item">
                    <div href="#" class="nav-link link-dark bg-light" style="margin-left: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                        <b>Step 1:</b> Accept Applications
                    </div>
                </li>
                <li>
                    <a href="page-land-owner.php" class="nav-link link-dark" aria-current="page">
                        <b>Step 2:</b> Track Progress
                    </a>
                <li>
                    <a href="page-land-owner.php" class="nav-link link-dark" aria-current="page">
                        <b>Step 3:</b> Post a Review
                    </a>
                </li>
                <li>
                    <a href="page-land-owner.php" class="nav-link link-dark" aria-current="page">
                        <b>Step 4:</b> Completed 
                    </a>
                </li>
            </ul>
            </div>
            <div class="col-8 vh-100 bg-light">
                <div class="row" style="overflow-y: scroll;">
                        <!-- CONTENT -->
                        <div class="d-flex flex-column p-4" style="height: 150px">
                            <p class="h2"><b>Make a Deal</b></p>
                            <p class="m-0">Here are workers interested in your job and workers you're trying to hire.</p>
                            <p><b>Approve an application to your job offer</b> or <b>wait for the worker's approval</b> for your recruitment request.</p>
                        </div>
                        <div class="d-flex flex-column">
                        <?php
                            $sql = "SELECT ja.JobAtt_ID, ja.JobAtt_Time, j.Job_Title, u.U_FName, u.U_LName
                                    FROM jobattentions ja
                                    INNER JOIN users u ON ja.U_ID = u.U_ID
                                    INNER JOIN joboffers j ON ja.Job_ID = j.Job_ID
                                    WHERE j.U_ID = {$_SESSION['userid']} AND ja.JobAtt_IsByOwner = 0
                                    ORDER BY ja.JobAtt_Time DESC";
                            $result = $conn->query($sql);
                            while($notif = $result->fetch_assoc()){
                                echo
                                "<div>
                                    <div class='card p-4 bg-light m-1'>
                                        <div class='card-content row'>
                                            <div class='col-1 d-flex align-items-center justify-content-center'>
                                                <img src='images/profile.png' width='50' height='50' class='rounded-circle'/>
                                            </div>
                                            <div class='col-9 align-items-center'>
                                                <div class='container p-0'>
                                                    <div class='mb-0'><b>{$notif["U_FName"]} {$notif["U_LName"]}</b> is interested in you job: <b>\"{$notif["Job_Title"]}\"</b></div>
                                                    <div class='mb-0'>{$notif["JobAtt_Time"]}</div>
                                                </div>
                                            </div>
                                            <div class='col-2 d-flex align-items-center justify-content-center p-0'>
                                                <button class='btn btn-secondary secondary-button' data-value='{$notif["JobAtt_ID"]}' data-bs-toggle='modal' data-bs-target='#confirm'>{$notif["JobAtt_ID"]}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }
                            
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#confirm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var value = button.data('value');
                var modal = $(this);
                setTimeout(function() {
                    modal.find('.modal-content .value-display').text(value);
                }, 100);
            });
        </script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>