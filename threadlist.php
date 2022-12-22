<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>iDiscuss -Coding Forums</title>
</head>

<body>

    <?php include 'partials/header.php'; ?>
    <!-- <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">what is forums</h1>
            <p class="lead"><mark> forums provides an online exchange of information between people about a particular
                    topic. It provides a venue for questions and answers and may be monitored to keep the content
                    appropriate. Also called a "discussion board" or "discussion group," an Internet forum is similar to
                    an
                    Internet newsgroup, but uses the Web browser for access.</mark></p>
        </div>
    </div> -->
    <?php include 'partials/db_connection.php'; ?>
    <?php
    $id=$_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
             $result = mysqli_query($conn,$sql);
             while($row = mysqli_fetch_assoc($result)){ 
                $catname = $row['category_name'];
                $catdesc = $row['category_description'];

             }
    ?>
    <?php
    $showAlert = false; 
    $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    if($method=='POST'){
        //insert into thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` (`thread_title`,`thread_desc`,`thread_cat_id`,`thread_user_id`,`timestamps`)VALUES('$th_title','$th_desc','$id','0',current_timestamp())";
        $result = mysqli_query($conn,$sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> your thread has been added! Please wait for community to respond.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }
    }
    
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
            <p class="lead"><?php echo $catdesc ?> </p>
            <hr class="my-4">
            <p>
                This is a peer to peer forum for sharing knowledge with each other,Keep it friendly.
                Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                Stay on topic. ...
                Share your knowledge. ...
                Refrain from demeaning, discriminatory, or harassing behaviour and speech.
            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Problem Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as possible.</small>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Elaborate your concern</label>
    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>


  <button type="submit" class="btn btn-success">Submit</button>
</form>
    </div>

    <div class="container" id="ques">
        <h2 class="py-2">Browse Question</h2>
        <?php
    $id=$_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
             
             $result = mysqli_query($conn,$sql);
             $noResult = true;
             while($row = mysqli_fetch_assoc($result)){ 
                $noResult = false;
                $id=$row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                

   
       echo  '<div class="media">
            <img class="align-self-center mr-3" src="img/userimg.png" width="60px" alt="Generic placeholder image">
            <div class="media-body">
                <h4 class="mt-0"><a href="thread.php?threadid='. $id .'" class="text-dark">'.$title.'</a></h4>
                <h6> '.$desc.'</h6>
            </div>
        </div>';
    }
    // echo var_dump($noResult);
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Threads found</p>
          <p class="lead">Be the first person to ask question</p>
        </div>
      </div>';
    }
    ?>


    </div>

    <?php include 'partials/footer.php'; ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>