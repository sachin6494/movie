<?php include('partials-front/menu.php'); ?>

<!-- movie sEARCH Section Starts Here -->
<section class="movie-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>actor-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Actors.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>



<!-- movie MEnu Section Starts Here -->
<section class="movie-menu">
    <div class="container">
        <h2 class="text-center">Explore the Actors</h2>

        <?php

        //Getting movies from Database that are active and featured
        //SQL Query
        $sql2 = "SELECT * FROM actor";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Count Rows
        $count2 = mysqli_num_rows($res2);

        $results_per_page = 10;
        $number_of_page = ceil($count2 / $results_per_page);

        //determine which page number visitor is currently on  
        if (!isset($_GET['page1'])) {
            $page1 = 1;
        } else {
            $page1 = $_GET['page1'];
        }
        //determine the sql LIMIT starting number for the results on the displaying page  
        $page_first_result = ($page1 - 1) * $results_per_page;

        //retrieve the selected results from database   
        $query = "SELECT * FROM `actor` LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = mysqli_query($conn, $query);

        //CHeck whether movie available or not
        if ($count2 > 0) {
            //movie Available
            while ($row = mysqli_fetch_assoc($result)) {
                //Get all the values
                $actor_id = $row['actor_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

        ?>

                <div class="movie-menu-box">
                    <div class="movie-menu-img">
                        <img src="<?php echo SITEURL; ?>images/movie.jpeg" alt="Image not Available." class="img-responsive img-curve">
                    </div>

                    <div class="movie-dec">
                        <h4><?php echo $actor_id; ?></h4>
                        <p><?php echo $first_name; ?></p>
                        <p>
                            <?php echo $last_name; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>actor.php?actor_id=<?php echo $actor_id; ?>" class="btn btn-primary">Click Here</a>
                    </div>
                </div>

        <?php
            }
        } else {
            //movie Not Available 
            echo "<div class='error'>movie not available.</div>";
        }

        ?>

        <div class="clearfix"></div>



    </div>
</section>

<section>
    <div class="container">
        <?php
        if ($page1 > 1) {
            echo "<a href='actors.php?page1=" . ($page1 - 1) . "' class='btn btn-danger'>Previous</a>";
        }


        for ($i = 1; $i < $number_of_page; $i++) {
            echo "<a href='actors.php?page1=" . $i . "' class='btn btn-primary'>$i</a>";
        }

        if ($i > $page1) {
            echo "<a href='actors.php?page1=" . ($page1 + 1) . "' class='btn btn-danger'>Next</a>";
        }
        ?>

    </div>

</section>