<?php include('partials-front/menu.php'); ?>

<!-- movie sEARCH Section Starts Here -->
<section class="movie-search text-center">
    <div class="container">
        <?php

        //Get the Search Keyword
        // $search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']);

        ?>

    </div>
</section>
<!-- movie sEARCH Section Ends Here -->



<!-- movie MEnu Section Starts Here -->
<section class="movie-menu">
    <div class="container">
        <h2 class="text-center">Movies Result</h2>

        <?php
        $sql = "SELECT * FROM film WHERE title LIKE '%$search%'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        //Check whether movie available of not
        if ($count > 0) {
            //movie Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get the details
                //Get all the values
                $film_id = $row['film_id'];
                $title = $row['title'];
                $rental_rate = $row['rental_rate'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>

                <div class="movie-menu-box">
                    <div class="movie-menu-img">
                        <img src="<?php echo SITEURL; ?>images/movie.jpeg" alt="Image not Available.a" class="img-responsive img-curve">
                    </div>

                    <div class="movie-dec">
                        <h4><?php echo $title; ?></h4>
                        <p class="movie-price">$<?php echo $rental_rate; ?></p>
                        <p class="movie-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?film_id=<?php echo $film_id; ?>" class="btn btn-primary">Click Here</a>
                    </div>
                </div>

        <?php
            }
        } else {
            //movie Not Available
            echo "<div class='error'>movie not found.</div>";
        }

        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- movie Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>