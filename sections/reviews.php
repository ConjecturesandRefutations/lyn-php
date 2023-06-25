
<?php

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
          <span class="card-title">Authentic Tantric Shamanism Online</span>
          <p>I did several online sessions with Mana with the intention to deeply inquire and shed some light on something that has been sitting with me for a long time. 
            By expressing herself in full authenticity and with her wholeness of body mind and soul, I felt very safe in her presence, totally heard and seen. ALL of me welcomed whilst led by her spiritual, empathic and grounded way that carries such wisdom and deep inner knowing. Mana held space for me, listened when it was needed and encouraged me to speak my truth – or pause – when it was needed. She has this rare and very beautiful sensibility to feel into things and… yes… into me and what stirred in me, always channeling resonant words reflective of the moment. There was no perceived push only loving guidance to tap into the depths of inner knowing within me. Generally I have been somewhat hesitant around online sessions assuming obstacles to their benefit, however I was amazed by the strong connection and energetic transmission I felt in our meetings online. A creative soul lives in Mana and she has a wide range of ways, some of which can seem unusually challenging at first yet always integrous and most refreshing in truth. THANK YOU Mana. 
            I love and honour the important work you are doing.</p>
        </div>
      </div>
      </div>

    <div class="row">
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

          <span class="card-title">A Year Of Muse</span>
          
          
          <p>It was 2 years ago I met Mana Muse. An intense year of initiation into the depths of truth, love and death followed. 
            While the story of our work together is a tale of many wonders, the change in me is perhaps more useful to share here. My relationship with myself has changed, self reflected in me, world and women. Guided by the Muse I have settled into a deep surrender to life in all her moods. During the year I sailed and worked under the ocean in the frozen lands of Antarctica, lost a best friend to a car crash, lost my father to heart disease, built a house out of mud, held my mother through deep mental disturbance and loved, lost and loved again. I feel like I have become an adult, finally at 34. I have become a man too perhaps, not by force or discipline but by deep surrender to my feminine. An unraveling of layers of personal and collective trauma holding me back from authentic expression of my authentic masculine core. I relate to women differently, cleansed of many deep programs of scarcity and control. The Muse had teachings, techniques and transmissions, at times she wowed me with her wisdom and at times enraged me with her very being. Through it all she held me in presence and love and that is where the healing happened. 
            I remain ever grateful for the gift that she shares for the liberation of all beings.</p>
        </div>

      </div>
      </div>

  </div>

  <div class="row">
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

          <span class="card-title">Love Priestesses</span>
          
          
          <p>So grateful to have met these loving and warm women. Present in our shared moments, filled with love,
            intimate and warm. This experience was definitely one of the best if not the best intimate experience
            I have ever had. Taking me through a journey of bliss and joy, peaceful and safe, true and contained.
            It opened my heart and made me feel the rhythm of this gentle breath and touch several days after.
            Using their voices in the session, with the combination of their presence and touch, creates an
            unearthly being, taking you to another dimension and then back again safe and weightless,
            filled with gratitude and love.</p>
        </div>

      </div>
      </div>

  </div>

</div>

<hr>

<!-- Review Form -->

<div class="text-darken-2">
  <h4 class="center toggle-form">Write a Review<i class="material-icons prefix">keyboard_arrow_down</i></h4>
  <form action="reviews.php" method="POST" class="white toggler hide">
      <div class="row">
          <div class="input-field col s12 m6">
              <label class="labels" for="title">Review Title</label>
              <input type="text" id="title" name="title" value="">
              <div class="red-text"><?php echo $errors['title']; ?></div>
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
            <div class="red-text"><?php echo $errors['rating']; ?></div>
            </div>
      </div>
      <div class="input-field">
          <label class="labels" for="content">Description</label>
          <textarea id="content" name="content" class="materialize-textarea auto-resize" rows="1"></textarea>
          <div class="red-text"><?php echo $errors['description']; ?></div>
      </div>
      <div class="center">
          <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
      </div>
  </form>
</div>
</section>
