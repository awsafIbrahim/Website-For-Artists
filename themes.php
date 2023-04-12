<?php
//Starting the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Art by You</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
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
        <!--Section to print the art work under the specific theme-->
        <section class="py-5">
            <div class="container px-5 my-5">

                <div class="row gx-5">

                    <?php
                    //Recieves the theme name from the collections page which is passed here as a queryString
                    $theme = $_GET['theme'];

                    //Heredoc has been used to print the theme name 
                    $heading = <<<THEME
                    <div class="row gx-5 justify-content-center">
                           <div class="col-lg-8 col-xl-6">
                               <div class="text-center">
                                   <h2 class="fw-bolder">$theme</h2>
                                   <br>
                               </div>
                           </div>
                       </div>
                THEME;

                    echo $heading;

                    //Taking all the data for accessing database from serverlogin.php
                    require_once 'serverlogin.php';

                    //Creates the connection
                    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

                    //If the connection fails then show error
                    if (!$conn) {
                        die("Connection failed!" . mysqli_connect_error());
                    }

                    //This query returns the Artist name, art work and art's name that is related to current theme
                    $search = "SELECT Name, Title, ArtImage FROM artwork, theme, artists WHERE  theme.ThemeID=artwork.ThemeID AND artwork.ArtistID=artists.ArtistID AND theme.Theme='$theme'";

                    //Passes  the query through the connections
                    $result = $conn->query($search);

                    //Checks if the query returns any row
                    if ($result = $conn->query($search)) {

                        //Returns every row as an associative array
                        while ($row = $result->fetch_assoc()) {
                            
                            //Takes the assoicated values from the database
                            $image = $row["ArtImage"];
                            $artistName = $row["Name"];
                            $artTitle = $row["Title"];
                            
                            //Prints the result using a heredoc
                            $output = <<<COL
                                    
                               <div class="col-lg-4 mb-5">
                                        <div class="card h-100 shadow border-0">
                                            <img class="card-img-top" src='$image' alt="..." />
                                            <div class="card-body p-4">
                                               
                                                <a class="text-decoration-none  " href="aboutArtist.php?title=$artistName"><h5 class="card-title mb-3">$artistName</h5></a>
                                                <p class="card-text mb-0">$artTitle</p>
                                            </div>
                                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                                <div class="d-flex align-items-end justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                             COL;
                            echo $output;
                        }
                    }

                    //If the query doesnt return any row then print this
                    else{
                        echo "Display Nothing";
                    }
                    
                    //Closes the connection 
                    $conn->close();
                    ?>

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
</body>

</html>