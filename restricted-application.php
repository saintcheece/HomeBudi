<?php
    require "conn.php";  

    $sql = "SELECT U_Role FROM Users WHERE U_ID = '$c'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    echo '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>HomeBudi | HomeOwner</title>
            </head>
                <body>
                <div id="fixed-sidebar" style="position: fixed;
                                                top: 0; left: 0;
                                                height: 100vh; width: 10vh;
                                                background-color: orangered;
                                                padding: 20px;
                                                overflow-y: auto;
                                                text-align: center;">
                    <img src="images/logo_white.png" height="50vh"/>
                    <img src="images/search.png" height="50vh" style="margin-top: 4vh"/>
                    <img src="images/home.svg" height="50vh" style="margin-top: 23vh"/>
                    <img src="images/notification.png" height="50vh" style="margin-top: 4vh"/>
                    <img src="images/message.png" height="50vh" style="margin-top: 4vh"/>
                    <img src="images/profile.png" height="50vh" style="margin-top: 4vh"/>

                </div>
                <div>
                    <div id="to-jobs" style="margin-left: 20vh; top: 5vh; margin-bottom: 5vh; margin-right: 5vh;
                                                background-color: lightgrey;
                                                position: fixed;
                                                width: 10vh; height: 30vh;
                                                border-radius: 90vh;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;">
                        <p style="font-weight:bold;
                                    font-size: 5vh;
                                    font-family: sans-serif;
                                    transform: rotate(-90deg);">Jobs</p>
                    </div>
                    <div id="to-workers" style="margin-left: 20vh; margin-top: 35vh; margin-bottom: 5vh; margin-right: 5vh;
                                                background-color: lightgrey;
                                                position: fixed;
                                                width: 10vh; height: 30vh;
                                                border-radius: 90vh;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;">
                        <p style="font-weight:bold;
                                    font-size: 5vh;
                                    font-family: sans-serif;
                                    transform: rotate(-90deg);">Workers</p>
                    </div>
                </div>
                <div id="main-content" style="margin-left: 35vh; top: 5vh; margin-bottom: 5vh; margin-right: 5vh;
                                                background-color: lightgray;
                                                height: 70vh; width: 40%;
                                                border-radius: 5vh;
                                                position: fixed;
                                                overflow: auto;
                                                padding: 10vh">
                    <div style="width:20vh; height:20vh;
                                background-color: white;
                                border-radius: 50%"></div>
                    <h1 style="font-family: sans-serif;">'.$row['U_FName'].' '.$row['U_LName'].'</h1>
                    <h2 style="font-family: sans-serif; opacity: 0.5;">'.$row['U_City'].', '.$row['U_Prov'].'</h2>
                    <p style="font-family: sans-serif;"><b>Average Score:</b></p>
                </div>';
                require "conn.php";  

                $sql = "SELECT U_Role FROM Users WHERE U_ID = '$c'";
                $result = $conn->query($sql);

                $row = $result->fetch_assoc();
                if($row['U_Role'] == 2){
                    echo '<div style="left: 140vh; bottom: -5vh;
                                width:15vh; height:15vh;
                                background-color: lightgray;
                                position: fixed;
                                border-radius: 50%;
                                margin: 10vh; 
                                display: flex;
                                justify-content: center;
                                align-items: center;">
                        <img src="images/bookmark.png" height="30vh"/>
                    </div>
                    <div style="left: 158vh; bottom: -5vh;
                                width:15vh; height:15vh;
                                background-color: lightgray;
                                position: fixed;
                                border-radius: 50%;
                                margin: 10vh;
                                display: flex;
                                justify-content: center;
                                align-items: center;">
                        <img src="images/message.png" height="30vh"/>
                    </div>
                    <div style="left: 186vh; bottom: 5vh;
                                                background-color: lightgrey;
                                                position: fixed;
                                                width: 30vh; height: 15vh;
                                                border-radius: 90vh;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;">
                        <p style="font-family: sans-serif; font-size: 5vh">Apply</p>
                    </div>';
                }else{
                    echo '<div style="left: 186vh; bottom: 5vh;
                                                background-color: lightgrey;
                                                position: fixed;
                                                width: 30vh; height: 15vh;
                                                border-radius: 90vh;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;">
                        <p style="font-family: sans-serif; font-size: 5vh">Register as a Budi</p>
                    </div>';
                }
                echo '<div style="left: 150vh; bottom: 23vh;
                                            background-color: lightgrey;
                                            position: fixed;
                                            width: 30vh; height: 30vh;
                                            border-radius: 5vh;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;">
                    <img src="images/back.png" height="40vh"/>
                </div>
                <div style="left: 185vh; bottom: 23vh;
                                            background-color: lightgrey;
                                            position: fixed;
                                            width: 30vh; height: 30vh;
                                            border-radius: 5vh;
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;">
                    <img src="images/next.png" height="40vh"/>
                </div>
                    
            </body>
            </html>';
            $conn->close();
?>