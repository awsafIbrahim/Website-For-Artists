<?php
//Starting the session here
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Post</title>
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
        <!-- Page content which has a form to take inpuuts-->
        <section class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5">

                        <h1 class="fw-bolder">Create New Account</h1>

                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">

                            <!--Opening a form using post method to recieve data and it has 4 input boxes-->
                            <form method="post">
                                <!--Name box to recieve data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Enter your Username" />
                                    <label for="name">Name</label>
                                    <div class="invalid-feedback">Username is required.</div>
                                </div>
                                <!--Art title box to recieve data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="artistType" id="artName" type="text" placeholder="asdasd" />
                                    <label for="ArtName">Type of Artist</label>


                                </div>
                                <!--Theme box to recieve Data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="artistDetail" id="theme" type="text" placeholder="asdasd" />
                                    <label for="theme">Tell us about you</label>


                                </div>

                                <!--File name box to recieve data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="artistImg" id="fileName" type="text" placeholder="asdasd" />
                                    <label for="fileName">Upload an image of yourself</label>


                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control" name="userName" id="name" type="text" placeholder="Enter your Username" data-sb-validations="required" />
                                    <label for="name">Create a Username</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">Username is required.</div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="asdasd" data-sb-validations="required,password" />
                                    <label for="password">Create a Password</label>
                                    <div class="invalid-feedback" data-sb-feedback="password:required,password">Password is required</div>
                                    <div class="invalid-feedback" data-sb-feedback="password:password">Password is not valid</div>
                                </div>

                                <!-- Submit Button-->
                                <div class=""><button class="btn btn-primary " name="formSubmit" id="submitButton" type="submit">Submit</button></div>


                                <!--Using php, data are recieved and passed to the database-->
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
                                    //Aritst Name
                                    $name = $_POST['name'];
                                    //Accessing Artist's Type, Image, username and password  
                                    $artistType = $_POST['artistType'];
                                    $artistDetail = $_POST['artistDetail'];
                                    $artistimg = $_POST['artistImg'];
                                    $userName = $_POST['userName'];
                                    $password = $_POST['password'];

                                    //Checking if the entered user name exists in the database
                                    $search = "SELECT * FROM signin where Username='$userName'";
                                    $result = $conn->query($search);
                                   
                                    //If the username does not exist then the query should return 0 rows
                                    if ($result->num_rows == 0) {
                                        //Getting the query result as associative array
                                        $row=$result->fetch_assoc();
                                        //For inserting values into the artists table
                                        $filePath = "files/artists/$artistimg";
                                        $artist = $conn->prepare("INSERT INTO artists(Name,ArtistImage,Type,Description) VALUES (?, ?,  ?, ?)");
                                        $artist->bind_param("ssss", $name, $filePath, $artistType, $artistDetail);
                                        $artist->execute();
                                        //Getting the ArtistID for the newly inserted artist from the artist table
                                        $artistID = mysqli_insert_id($conn);

                                        //For inserting values in to the sign in table
                                        $signIn = $conn->prepare("INSERT INTO signin(ArtistID, Username, Password) VALUES (?,?,?)");
                                        $signIn->bind_param("iss", $artistID, $userName, $password);
                                        $signIn->execute();
                                        echo "Acocunt was created";

                                        //Storing the user information in session when the account creation is successfull
                                        $_SESSION["signin"] = true;
                                        $_SESSION["ArtistID"] = $artistID;
                                        $_SESSION["UserID"] = $row['UserID'];

                                    
                                    } else {
                                        echo "User name already exists";
                                    }
                                }
                                //If the account creation was successful then direct the user to post page
                                if (isset($_SESSION["signin"]) && $_SESSION["signin"] === true) {
                                    header("location:post.php");
                                    exit;
                                }


                                $conn->close();
                                ?>

                            </form>
                        </div>
                    </div>
                </div>


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