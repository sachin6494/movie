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
        $sql = "SELECT * FROM `actor` WHERE first_name LIKE '%$search%' or last_name LIKE '%$search%'";

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
                $actor_id = $row['actor_id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $image_name = $row['image_name'];
        ?>

                <div class="movie-menu-box">
                    <div class="movie-menu-img">
                        <img src="<?php echo SITEURL; ?>images/movie.jpeg" alt="Actor Image" class="img-responsive img-curve">
                    </div>

                    <div class="movie-dec">
                        <!-- <h4><?php echo $actor_id; ?></h4> -->
                        <p><?php echo $first_name; ?></p>
                        <p class="movie-detail">
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
            echo "<div class='error'>movie not found.</div>";
        }

        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- movie Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>