<?php
//Starts the session here
session_start();

//Destroys the session and signs out the user by using the querylink
if ($_GET['value'] == 'destroy') {
    $_SESSION['signin'] = false;
    $_SESSION = array();
    session_destroy();
    //Directs the user to sign in page
    header("location:signin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Sign In</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Art by You</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="post.php">Post</a></li>
                        <li class="nav-item"><a class="nav-link" href="artists.php">Artists</a></li>
                        <li class="nav-item"><a class="nav-link" href="collections_T.php">Collections</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Signin</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                                <li><a class="dropdown-item" href="signin.php">Sign In</a></li>
                                <li><a class="dropdown-item" href="signin.php?value=destroy">Sign Out</a></li>
                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5">

                        <h1 class="fw-bolder">Sign In</h1>

                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">

                            <form id="contactForm" method="post">
                                <!-- User name input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="userName" id="name" type="text" placeholder="Enter your Username" data-sb-validations="required" />
                                    <label for="name">Username</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">Username is required.</div>
                                </div>
                                <!-- Email address input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="asdasd" data-sb-validations="required,password" />
                                    <label for="password">Password</label>
                                    <div class="invalid-feedback" data-sb-feedback="password:required,password">Password is required</div>
                                    <div class="invalid-feedback" data-sb-feedback="password:password">Password is not valid</div>
                                </div>

                                <!-- Submit Button-->
                                <div class="d-grid"><button class="btn btn-primary btn-lg " id="submitButton" type="submit">Submit</button></div>
                                <?php
                                //Taking all the data for accessing database from serverlogin.php
                                require_once 'serverlogin.php';

                                //Creating the connection
                                $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

                                //If the connections fails then show error
                                if (!$conn) {
                                    die("Connection failed!" . mysqli_connect_error());
                                }

                                //Checking if the form method was post

                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    //Accessing the username and password from the database
                                    $userName = trim($_POST['userName']);
                                    $password = trim($_POST['password']);

                                    //Retrieving the password for the username that was entered in the form if username exists
                                    $search = "SELECT * from signin where Username='$userName'";
                                    $result = $conn->query($search);

                                    //If the username exists in the database then proceed for password authentication. The database will return
                                    //at least one row if the user name already exists in the database
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        if ($password == $row['Password']) {
                                            echo "You Logged in Successfully";

                                            //Setting the session sign variable to true and storing user information in session
                                            $_SESSION["signin"] = true;
                                            $_SESSION["UserID"] = $row['UserID'];
                                            $_SESSION["ArtistID"] = $row['ArtistID'];
                                        } else {
                                            echo "Password does not match with the username";
                                        }
                                    } else {
                                        echo "Usrname does not exists";
                                    }
                                }

                                //If the sign in was successsful then direct the user to post page for posting
                                if (isset($_SESSION["signin"]) && $_SESSION["signin"] === true) {

                                    header("location:post.php");
                                    exit;
                                }



                                //Closing the connection
                                $conn->close();
                                ?>
                            </form>
                            <div class="text-center mb-5 py-3">
                                <p><b>Don't have an account?<br>Join now and start posting your artwork<b></p>
                                <div class=""><a href="createAccount.php"><button class="btn btn-primary btn-lg " id="submitButton" type="submit">Create Account</button></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact cards-->

            </div>
        </section>
    </main>
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; Your Website 2022</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="#!">Privacy</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#!">Terms</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#!">Contact</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>