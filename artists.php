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


        <header>
            <!--Section to show the heading and the description of the artist page-->
            <section class="py-5 bg-light">
                <div class="container px-5 my-5">
                    <div class="text-center">
                        <h2 class="fw-bolder">Our artists</h2>
                        <p class="lead fw-normal text-muted mb-5">Dedicated to bringing art to our community</p>
                    </div>
                    <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">

                        <!--PHP file to show the individual artist image and their title-->
                        <?php
                        
                        //Taking all the data for accessing database from serverlogin.php
                        require_once 'serverlogin.php';

                        
                        //Creating the connection
                        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
                        
                        //If the connection fails then show error
                        if (!$conn) {
                            die("Connection failed!" . mysqli_connect_error());
                        }

                        
                        // This query returns all the information from the artist table
                        $search = "SELECT * FROM artists";
                        
                        //Passes the query in the database through the connection
                        $result = $conn->query($search);
                        
                        //Checks if the query returns a row
                        if ($result->num_rows > 0) {
                        
                            //Storing each row as an associative array
                            while ($row = $result->fetch_assoc()) {
                                //Receiving the imagem artist name and type from the database
                                $image = $row["ArtistImage"];
                                $Artist = $row["Name"];
                                $type = $row["Type"];
                        
                                //Printing the result in a heredoc 
                                $output = <<<HTML
                                <div class="col mb-5 mb-5 mb-xl-0">
                                                <div class="text-center">
                                                    <img class="img-fluid rounded-circle mb-4 px-4" src='$image' alt="..." />
                                                    <!-- Using a querystring to retreive the artist Name from the link-->
                                                    <h6 class="fw-bolder"><a href="aboutArtist.php?title=$Artist">$Artist</a></h6>
                                                    <h6 class="fw-bolder">$type</h6>
                                                    
                                                    
                                                </div>
                                            </div>
                             HTML;
                                echo $output;
                            }
                        }
                        //If the database doesnt return anything then print this
                        else {
                            echo "Nothing to Display";
                        }
                        //Closing the connection
                        $conn->close();
                        ?>


                    </div>
                </div>
            </section>
        </header>
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