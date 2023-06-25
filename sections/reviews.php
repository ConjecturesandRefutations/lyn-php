
<?php

//connect to database
$conn = mysqli_connect('localhost', 'universal', '12345', 'pearl-yoga');

//check connection
if($conn){
  echo 'Connected! : ' . mysqli_connect_error();
}

//write query for all reviews
$sql = 'SELECT title, rating, description FROM reviews ORDER BY created_at DESC';

//make query and get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection to database
mysqli_close($conn);

include('config/db_connect.php');

$title = $rating = $description = '';

$errors =  array('title'=>'', 'rating'=>'', 'description'=>'');

if(isset($_POST['submit'])){

//Check title
if(empty($_POST['title'])){
    $errors['title'] = 'A title is required <br/>';
} else {
    $title = $_POST['title'];
}

//Check title
if(empty($_POST['rating'])){
    $errors['rating'] = 'A rating is required <br/>';
} else {
    $rating = $_POST['rating'];
}

if(empty($_POST['description'])){
    $errors['description'] = 'A description is required <br/>';
} else {
    $description = $_POST['description'];
}

if(array_filter($errors)){
    
} else{

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    //create sql
    $sql = "INSERT INTO reviews(title,rating,description) VALUES('$title','$rating','$description')";

    //save to db and check
    if(mysqli_query($conn, $sql)){
        //success
        header('Location: index.php');
    } else {
        //error
        echo 'query error: ' . mysql_error($conn);
    }
}

}; // end of the POST check

?>

<section id="review" class="scrollspy grey lighten-4">

<div class="container" >
  <h2 class="">Reviews</h2>
  <div class="row">

  <?php foreach($reviews as $review){ ?>
  
    <div class="col s12 l6">
      <div class="card">
          <div class="card-image">
              <img src="./img/hands.jpg" alt="review" class="reviews circle">
          </div>
        <div class="card-content">
          <div>
            <div class="starsTwo">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div> 
          </div>
          <span class="card-title"><?php echo htmlspecialchars($review['title']); ?></span>
          <p><?php echo htmlspecialchars($review['description']); ?></p>
        </div>
      </div>
      </div>

      <?php } ?>

  </div>

</div>

<hr>

<!-- Review Form -->

<div class="text-darken-2">
  <h4 class="center form-header">Write a Review<i class="material-icons prefix" id="chevron"></i></h4>
  <form action="add.php" method="POST" class="white toggler hide">
      <div class="row">
          <div class="input-field col s12 m6">
              <label class="labels" for="title">Review Title</label>
              <input type="text" id="title" name="title" value="">
          </div>

           <!-- Star Rating -->

          <div class="row">
            <div class="input-field col s12 m6">
                <label type="text" class="labels" for="rating">               
                  <div class="stars">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div> 
            </label>
            <input class="rating" disabled name="rating" value="">
            </div>
      </div>
      <div class="input-field">
          <label class="labels" for="content">Description</label>
          <textarea id="content" name="content" class="materialize-textarea auto-resize" rows="1"></textarea>
      </div>
      <div class="center">
          <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
      </div>
  </form>
</div>
</section>

