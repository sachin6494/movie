<?php include('partials-front/menu.php'); ?>

<?php
//CHeck whether movie id is set or not

if (isset($_GET['actor_id'])) {

    //Get the movie id and details of the selected movie
    $actor_id = $_GET['actor_id'];

    $sql = "SELECT CONCAT(a.first_name,' ', a.last_name) as actore_name,GROUP_CONCAT(f.title, ' ') as movies FROM actor a inner join film_actor fa on fa.actor_id = a.actor_id INNER JOIN film f on f.film_id = fa.film_id where a.actor_id = $actor_id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Count the rows
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //WE Have DAta
        //GEt the Data from Database
        $row = mysqli_fetch_assoc($res);

        $actore_name = $row['actore_name'];
        $movies = $row['movies'];
    } else {
        //movie not Availabe
        //REdirect to Home Page
        header('location:' . SITEURL);
    }
} else {
    //Redirect to homepage
    header('location:' . SITEURL);
}
?>

<!-- movie sEARCH Section Starts Here -->
<section class="movie-search">
    <div class="container">

        <h2 class="text-center text-white">Movie Details</h2>

        <fieldset>
            <legend class="text-white">Selected Actor</legend>

            <div class="movie-menu-img">
                <img src="<?php echo SITEURL; ?>images/movie.jpeg" alt="Image not Available." class="img-responsive img-curve">
            </div>

            <div class="movie-menu-desc">
                <h4>Name : <?php echo $actore_name; ?></h4>
                <h4>Movies : <?php echo $movies; ?></h4>


                <br>

            </div>

        </fieldset>


    </div>
</section>
<!-- movie sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>