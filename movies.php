<?php include('partials-front/menu.php'); ?>

<?php
//CHeck whether movie id is set or not

if (isset($_GET['film_id'])) {

    //Get the movie id and details of the selected movie
    $film_id = $_GET['film_id'];

    //Get the DEtails of the SElected movie
    //$sql = "SELECT f.title, l.name, f.release_year, f.description,(SELECT a.first_name FROM `film_actor` fa inner join actor a on a.actor_id = fa.actor_id where fa.film_id = $film_id LIMIT 1) as actor FROM film f inner join language l on f.language_id = l.language_id WHERE f.film_id = $film_id";
    $sql = "SELECT f.title, l.name as language, f.release_year, f.description,f.rating,f.length,c.name as category, (SELECT CONCAT(a.first_name,' ', a.last_name) FROM `film_actor` fa inner join actor a on a.actor_id = fa.actor_id where fa.film_id = $film_id LIMIT 1) as actor FROM film f inner join language l on f.language_id = l.language_id inner join film_category fc on fc.film_id = f.film_id inner join category c on c.category_id = fc.category_id WHERE f.film_id = $film_id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Count the rows
    $count = mysqli_num_rows($res);
    // echo ($count);
    // echo "heloooooooooooo";
    //CHeck whether the data is available or not
    // die();
    if ($count == 1) {
        //WE Have DAta
        //GEt the Data from Database
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $description = $row['description'];
        $language = $row['language'];
        $release_year = $row['release_year'];
        $actor = $row['actor'];
        $rating = $row['rating'];
        $length = $row['length'];
        $category = $row['category'];
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
            <legend class="text-white">Selected Movie</legend>

            <div class="movie-menu-img">
                <img src="<?php echo SITEURL; ?>images/movie.jpeg" alt="Image not Available." class="img-responsive img-curve">
            </div>

            <div class="movie-menu-desc">
                <h4>Title : <?php echo $title; ?></h4>
                <h4>Actor : <?php echo $actor; ?></h4>
                <h4>Description : <?php echo $description; ?></p>
                </h4>
                <h4>Release Date : <?php echo $release_year; ?></h4>
                <h4>Language : <?php echo $language; ?></h4>
                <h4>Rating : <?php echo $rating; ?></p>
                </h4>
                <h4>Length : <?php echo $length; ?></h4>
                <h4>Category : <?php echo $category; ?></h4>

                <br>

            </div>

        </fieldset>


    </div>
</section>
<!-- movie sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>