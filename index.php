    <?php include('partials-front/menu.php'); ?>

    <!-- movie sEARCH Section Starts Here -->
    <section class="movie-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>movies-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Movies.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>


    <!-- movie MEnu Section Starts Here -->
    <section class="movie-menu">
        <div class="container">
            <h2 class="text-center">Movies</h2>

            <?php

            //Getting movies from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM `film` LIMIT 300";

            //Execute the Query

            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);
            //define total number of results you want per page  
            $results_per_page = 10;
            $number_of_page = ceil($count2 / $results_per_page);

            //determine which page number visitor is currently on  
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }
            //determine the sql LIMIT starting number for the results on the displaying page  
            $page_first_result = ($page - 1) * $results_per_page;

            //retrieve the selected results from database   
            $query = "SELECT * FROM `film` LIMIT " . $page_first_result . ',' . $results_per_page;
            $result = mysqli_query($conn, $query);


            //CHeck whether movie available or not
            if ($count2 > 0) {
                //movie Available
                while ($row = mysqli_fetch_assoc($result)) {
                    //Get all the values
                    $film_id = $row['film_id'];
                    $title = $row['title'];
                    $rental_rate = $row['rental_rate'];
                    $description = $row['description'];
                    //$image_name = $row['image_name'];
            ?>

                    <div class="movie-menu-box">
                        <div class="movie-menu-img">
                            <img src="<?php echo SITEURL; ?>images/movie.jpeg" alt="Image not Available." class="img-responsive img-curve">
                        </div>

                        <div class="movie-dec">
                            <h4><?php echo $title; ?></h4>
                            <!-- <p><?php echo $rental_rate; ?></p> -->
                            <p class="movie-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>movies.php?film_id=<?php echo $film_id; ?>" class="btn btn-primary">Click Here</a>
                        </div>
                    </div>

            <?php
                }
            } else {
                //Movie Not Available 
                echo "<div class='error'>Movie not available.</div>";
            }


            ?>

    </section>

    <section>
        <div class="container">
            <?php
            if ($page > 1) {
                echo "<a href='index.php?page=" . ($page - 1) . "' class='btn btn-danger'>Previous</a>";
            }


            for ($i = 1; $i < $number_of_page; $i++) {
                echo "<a href='index.php?page=" . $i . "' class='btn btn-primary'>$i</a>";
            }

            if ($i > $page) {
                echo "<a href='index.php?page=" . ($page + 1) . "' class='btn btn-danger'>Next</a>";
            }
            ?>

        </div>

    </section>