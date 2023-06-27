<?php

include('config/db_connect.php');

$title = $rating = $content = '';
$errors = array('title' => '', 'content' => '', 'rating' => '');
$blogs = array(); // Initialize the $blogs array

// Fetch blogs from the database
$sql = "SELECT * FROM blogs";
$result = mysqli_query($conn, $sql);
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    // Check title
    if (empty($_POST['title'])) {
        $errors['title'] = 'Blog must have a title';
    } else {
        $title = $_POST['title'];
    }

    // Check rating
    if (empty($_POST['rating'])) {
        $errors['rating'] = 'Blog must have a rating';
    } else {
        $rating = $_POST['rating'];
    }

    // Check content
    if (empty($_POST['content'])) {
        $errors['content'] = 'You need to write the main content of your blog <br/>';
    } else {
        $content = $_POST['content'];
    }

    if (array_filter($errors)) {
        // echo 'errors in form';
    } else {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);

        // Create SQL
        $sql = "INSERT INTO blogs(title,rating,content) VALUES('$title','$rating','$content')";

        // Save to db and check
        if (mysqli_query($conn, $sql)) {
            // Fetch updated list of reviews
            $sql = "SELECT * FROM blogs";
            $result = mysqli_query($conn, $sql);
            $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            // Error
            echo 'Query error: ' . mysqli_error($conn);
        }
    }
}

//the code for deleting a post

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    
    $sql = "DELETE FROM blogs WHERE id = $id_to_delete";
    
    if(mysqli_query($conn, $sql)){
        //success
        echo '<script>
                window.onload = function() {
                    window.location.reload();
                };
              </script>';
    }{
        //failure
        echo 'query error: ' . mysqli_error($conn);
    }
    
    }
    
    //check GET request id parameter
    if(isset($_GET['id'])){
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
        //make sql
        $sql = "SELECT * FROM blogs WHERE id = $id";
    
        //get the query result
        $result = mysqli_query($conn, $sql);
    
        //fetch result in array format
        $blog = mysqli_fetch_assoc($result);
    
        mysqli_free_result($result);
        mysqli_close($conn);

        echo `<script>"location.reload()"</script>`;
    
    }

?>

<section id="review" class="scrollspy grey lighten-4">

<div class="container">
    <h2 class="">Reviews</h2>
    <div class="row">
        <?php 
        function sort_by_id($a, $b) {
            return $b['id'] - $a['id'];
        }
        
        usort($blogs, 'sort_by_id');
        foreach ($blogs as $blog): ?>
        <div class="col s12">
            <div class="card">
                <div class="card-image">
                    <img src="./img/hands.jpg" alt="review" class="reviews circle">
                </div>
                <div class="card-content">
                    <div>
                        <div class="starsTwo">
                        <?php 
                                for ($i = 0; $i < $blog['rating']; $i++) {
                                echo '<i class="fa-solid fa-star"></i>';
                                }
                            ?>    
                        </div>
                    </div>
                    <span class="card-title"><?php echo htmlspecialchars($blog['title']); ?></span>
                    <p><?php echo htmlspecialchars($blog['content']); ?></p>
                        <!-- delete form -->
                <form action="index.php" method="POST" id="deleteForm" class="delete-form hide">
                    <input type="hidden" name="id_to_delete" value="<?php echo $blog['id']; ?>">
                    <input type="submit" name="delete" value="delete" id="deleteButton" class="btn brand z-depth-0">
                </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


            <!-- Review Form -->
            <div class="text-darken-2">
                <h4 class="center form-header">Write a Review<i class="material-icons prefix" id="chevron"></i></h4>
                <form action="index.php" method="POST" class="white toggler hide">
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <label class="labels" for="title">Review Title</label>
                            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title) ?>">
                            <div class="red-text"><?php echo $errors['title'] ?></div>
                        </div>

                        <!-- Star Rating -->
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <label type="number" class="labels" for="rating">Rating</label>
                                <input class="rating" name="rating" min="0" max="5" value="<?php echo htmlspecialchars($rating) ?>">
                                <div class="red-text"><?php echo $errors['rating'] ?></div>
                            </div>
                        </div>

                        <div class="input-field">
                            <label class="labels" for="content">Description</label>
                            <textarea id="content" name="content" class="materialize-textarea auto-resize" rows="1"><?php echo htmlspecialchars($content) ?></textarea>
                            <div class="red-text"><?php echo $errors['content'] ?></div>
                        </div>
                        <div class="center">
                            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script src="reviewScript.js"></script>