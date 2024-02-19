<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="elements.css">
    <link rel="stylesheet" href="index.css">
    <title>HomeBudi | Login & Registration</title>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="verify.php">
            <div class="form-box">
                <div>
                    <div class="top"> -->
                        <!-- <img src="images/logo.png" height="100"/> -->
                        <!-- <img src="images/name.png" height="40"/>
                    </div>
                    <p class="tagline">Work Your Way, Hire Your Way</p>
                    <div class="input-box">
                        <input name="uEmail" class="input-field" type="text" placeholder="Email">
                    </div>
                    <div class="input-box">
                        <input name="uPass" class="input-field" type="password" placeholder="Password">
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" id="solid_btn" value="Sign In">
                    </div>
                    <center>or</center>
                    <div class="input-box">
                        <input type="button" class="submit" id="hollow_btn" value="Sign Up">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body> -->

<!DOCTYPE html>
<html>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>HomeBudi Sign In</title>


    <!-- Custom styles for this template -->
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

        .white{
            background-color: white;
        }
    </style>
  </head>

  <body class="container" style="background-color: orange">
    <!-- SIGNUP FORM -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header orange">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: white">Create an Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postdetails" class="md-form" action="registeruser.php" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <input type="email" class="form-control m-1" name="email" type="text" placeholder="Email"/>
                            <input type="password" class="form-control m-1" name="pass" type="text" placeholder="Password"/>
                            <input class="form-control m-1" name="fname" type="text" placeholder="First Name"/>
                            <input class="form-control m-1" name="lname" type="text" placeholder="Last Name"/>
                        </div>
                        <div class="col-6">
                            <input class="form-control m-1" name="cntry" type="text" placeholder="Country"/>
                            <input class="form-control m-1" name="city" type="text" placeholder="City"/>
                            <input class="form-control m-1" name="prov" type="text" placeholder="Province"/>
                            <input class="form-control m-1" name="town" type="text" placeholder="Town"/>
                            <input class="form-control m-1" name="hnum" type="text" placeholder="House Number"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary primary-button" form="postdetails" value="Sign Up"></button>
            </div>
            </div>
        </div>
    </div>
    <!-- LOGIN FORM -->
    <div class="row vh-100 align-items-center justify-content-center">
        <form class="col-4 form-signin text-center white p-5 rounded" method="POST" action="verify.php">

            <img class="mb-3" src="images/name.png" width="300"/>
            <p class="mb-3 fw-bold">Work Your Way, Hire Your Way</p>

            <div class="row py-2 mx-1 text-start">
                <input name="uEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            </div>

            <div class="row py-2 mx-1 text-start">
                <input name="uPass" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            </div>
            

            <div class="row p-3 pb-0">
                <button class="btn col-5 btn-lg btn-primary btn-block primary-button" type="submit">Sign in</button>
                <div class="col-2 px-0"><div><p class="m-3">or</p></div></div>
                <button class="btn col-5 btn-lg btn-secondary btn-block secondary-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Sign Up</button>
            </div>
            
          </form>
    </div>
    
  
    <script src="js/bootstrap.min.js"></script>
</body></html>