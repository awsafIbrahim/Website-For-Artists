<?
//Starting the session here
session_start();
//If the user is not signed in then direct the user to sign in page
if (!isset($_SESSION["signin"]) || $_SESSION["signin"] !== true) {
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
                        <?php
                        //Taking all the data for accessing database from serverlogin.php
                        require_once 'serverlogin.php';

                        //Creating the connection
                        $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

                        //Accessing the artistID from the session
                        $aritstIDforPost = $_SESSION["ArtistID"];
                        //Accessing the name of the user using artistid which was taken from the session
                        $search = "SELECT Name FROM artists WHERE ArtistID='$aritstIDforPost'";
                        $resultForPost = $connection->query($search);
                        $rowForPost = $resultForPost->fetch_assoc();
                        $nameOfArtist = $rowForPost["Name"];

                        //Printing the heading using a heredoc
                        $HEAD = <<<HTML
                        <h1 class="fw-bolder">$nameOfArtist Upload New Art</h1>
                        
                     HTML;
                        echo $HEAD;

                        ?>


                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">

                            <!--Opening a form using post method to recieve data and it has 4 input boxes-->
                            <form method="post" action="post.php">
                               
                                <!--Art title box to recieve data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="artName" id="artName" type="text" placeholder="asdasd" />
                                    <label for="ArtName">Art title</label>


                                </div>
                                <!--Theme box to recieve Data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="theme" id="theme" type="text" placeholder="asdasd" />
                                    <label for="theme">Theme</label>


                                </div>

                                <!--File name box to recieve data-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="fileName" id="fileName" type="text" placeholder="asdasd" />
                                    <label for="fileName">File Name</label>


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

                                


                                // Checking if the method is post
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    //Accessing the name of the artist through the session
                                    $aritstIDforPost2 = $_SESSION["ArtistID"];
                                    $Namesearch = "SELECT Name FROM artists WHERE ArtistID='$aritstIDforPost2'";
                                    $resultForPost2 = $connection->query($Namesearch);
                                    $rowForPost2 = $resultForPost2->fetch_assoc();
                                    $nameOfArtist2 = $rowForPost2["Name"];

                                    //Reading the input of the art name
                                    $artName = $_POST['artName'];

                                    //Reading the input of the theme box
                                    $theme = $_POST['theme'];

                                    //Reading the input of the fileName box
                                    $fileName = $_POST['fileName'];

                                    //Creating the file path using the $theme and $fileName
                                    $filePath = "files/$theme/$fileName";

                                    //Getting the ArtistID corresponding to the name from artists table 
                                    $search = "SELECT ArtistID FROM artists WHERE Name='$nameOfArtist2'";
                                    $result = $conn->query($search);
                                    $row = $result->fetch_assoc();

                                    //Stores the ArtistsID 
                                    $artistID = $row["ArtistID"];

                                    //Getting the ThemeID corresponding to the theme from the theme table
                                    $themeSearch = "SELECT ThemeID FROM theme WHERE Theme='$theme'";
                                    $result2 = $conn->query($themeSearch);
                                    $row2 = $result2->fetch_assoc();
                                    //Stores the ThemeID 
                                    $themeID = $row2["ThemeID"];

                                    //Prepare Statement for putting the value in artwork table
                                    $insertVal = $conn->prepare("INSERT INTO artwork (Title, ArtImage, ThemeID, ArtistID) VALUES (?, ?, ?, ?)");

                                    //Binds the parameters
                                    $insertVal->bind_param("ssii", $artName, $filePath, $themeID, $artistID);
                                    //Executes the statement
                                    $insertVal->execute();

                                    //If the connection was successful then print successful
                                    if ($conn->$insertVal->execute() === TRUE) {
                                        echo " New row has been successfully added";
                                    }

                                    //Else show error
                                    else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                    }
                                }

                                //Close the connection
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