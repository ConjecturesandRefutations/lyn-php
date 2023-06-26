<?php



include('config/db_connect.php');

//write query from all blogs
$sql = 'SELECT title, id, rating FROM blogs'; 

//make query and get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php include('templates/navbar.php'); ?>

<?php include('sections/what.php'); ?>

  <!-- parallax -->

  <div class="parallax-container">
    <div class="parallax">
      <img src="img/stars.jpg" alt="stars" class="responsive-img">
    </div>
  </div>

<?php include('sections/services.php'); ?>

 <!-- parallax -->

 <div class="parallax-container">
    <div class="parallax">
      <img src="img/yoga.jpg" alt="stars" class="responsive-img">
    </div>
  </div>

<?php include('sections/contact.php'); ?>

<?php include('sections/reviews.php'); ?>

<?php include('templates/footer.php'); ?>

</html>