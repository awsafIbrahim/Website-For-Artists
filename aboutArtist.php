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
            <!--Section to show artist name, title and description-->
            <section class="py-5 bg-light" id="scroll-target">

                <!--Introduction of php to show artist image, title and description-->
                <?php

                // Recieving the query String name from the artist.php and printing the details of the specific artist
                $artistName = $_GET['title'];

                //Taking all the data for accessing database from serverlogin.php
                require_once 'serverlogin.php';

                //Creating the connection 
                $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

                //If the connection fails then show error
                if (!$conn) {
                    die("Connection failed!" . mysqli_connect_error());
                }

                //This query returns everything from the artist table
                $search = "SELECT * FROM artists";

                //Passes the query through the connection in the database
                $result = $conn->query($search);

                //If the number of rows of returned query is greater 0 then go ahead
                if ($result->num_rows > 0) {
                    //Returns each row of the query as an associative array
                    while ($row = $result->fetch_assoc()) {
                        //Checks if the name of the this artist is equal to the current name
                        if ($row["Name"] == $artistName) {
                            //Recieves the required value from the database
                            $image = $row["ArtistImage"];
                            $description = $row["Description"];
                            $type = $row["Type"];
                        }
                    }

                    //Prints the value in the desired way through a heredoc
                    $firstHalf = <<<HTML
                          
                        <div class="container px-5 my-5">
                            <div class="row gx-5 align-items-center">
                                <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src='$image' alt="..." /></div>
                                <div class="col-lg-6">
                                    <h2 class="fw-bolder">$artistName - $type</h2>
                                    
                                    <p class="lead fw-normal text-muted mb-0">$description</p>
                                </div>
                            </div>
                        </div>
                    
                           
                    HTML;
                    echo $firstHalf;
                }
                //If the query doesnt return anything then print this
                else {
                    echo "Nothing to Display";
                }

                //Close the connection
                $conn->close();
                ?>
            </section>
        </header>

        <!--This section shows all the art work of the specific artist and artwork's name-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5">

                    <!--Introudction of php tag-->
                    <?php
                    // Recieving the query String name from the artist.php and printing the details of the specific artist
                    $artistName2 = $_GET['title'];

                    //Taking all the data for accessing database from serverlogin.php
                    require_once 'serverlogin.php';

                    //Creating the connections
                    $conn2 = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
                    
                    //If the connection fails then show error
                    if (!$conn2) {
                        die("Connection failed!" . mysqli_connect_error());
                    }

                    //this query returns the title and artimage of the speciFic artist
                    $search2 = "SELECT Title,ArtImage FROM artwork,artists WHERE artwork.ArtistID = artists.ArtistID AND artists.Name='$artistName2'";

                    //Passing the query through the connection
                    $result2 = $conn2->query($search2);


                    //Checks if the query returns a row
                    if ($result2->num_rows > 0) {
                        //Returns each row as an associative array
                        while ($row2 = $result2->fetch_assoc()) {
                            //Recieves the values 
                            $imgName = $row2["Title"];
                            $artWork = $row2["ArtImage"];

                            //Prints the values as required through a heredoc
                            $secondHalf = <<<HTML
                        
                                <div class="col-lg-4 mb-5">
                                <div class="card h-100 shadow border-0">
                                    <img class="card-img-top" src='$artWork' alt="..." />
                                    <div class="card-body p-4">
                                        
                                        
                                        <p class="card-text mb-0">$imgName</p>
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

                            echo $secondHalf;
                        }
                    }
                    // If the query doesnt return anything then print this
                    else {
                        echo "Nothing to Display";
                    }
                    //Closes the connection
                    $conn2->close();
                    ?>
                </div>
            </div>
        </section>
    </main>
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