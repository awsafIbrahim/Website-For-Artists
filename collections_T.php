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

        <!--Section to show the collections of theme-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="text-center">
                            <h2 class="fw-bolder">Collections by Themes</h2>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row gx-5">


                    <?php
                    //Taking all the data for accessing database from serverlogin.php
                    require_once 'serverlogin.php';

                    //Creating the connections
                    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

                    //Shows error if the connections fails
                    if (!$conn) {
                        die("Connection failed!" . mysqli_connect_error());
                    }

                    //This query returns all the rows from the theme table
                    $search = "SELECT * FROM theme";

                    //passes the query through the connections
                    $result = $conn->query($search);

                    //Checks if the query returns any row
                    if ($result->num_rows > 0) {

                        //Returns every row as an associative array
                        while ($row = $result->fetch_assoc()) {

                            //Collecting the theme image and theme name from the database
                            $themeImage = $row["ThemeImage"];
                            $themeName = $row["Theme"];

                            //Printing the result in a heredoc
                            $show = <<<HTML
                            <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                           <img class="card-img-top" src='$themeImage' alt="..." />
                            <div class="card-body p-4">
                            <!--Writing a query String to retrieve the theme name and passing it to the themes.php page-->
                               <a class="text-decoration-none link-dark stretched-link" href="themes.php?theme=$themeName"><h5 class="card-title mb-3">$themeName</h5></a>
                                    
                                </div>
                               <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                 <div class="d-flex align-items-end justify-content-between">
                                 <div class="d-flex align-items-center">
                                     
                                  </div>
                              </div>
                            </div>
                          </div>
                       </div>
                     HTML;
                            echo $show;
                        }
                    }

                    //If the query does not return anything then print this
                    else{
                        echo "Nothing to display";
                    }

                    //Closies the connection
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