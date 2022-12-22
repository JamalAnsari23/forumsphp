<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            #ques{
                min-height:433px;
            }
        </style>

    <title>iDiscuss -Coding Forums</title>
</head>

<body>

    <?php include 'partials/header.php'; ?>
    
    <?php include 'partials/db_connection.php'; ?>
 
        <?php
    $id=$_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
             $result = mysqli_query($conn,$sql);
             $noResult=true;
             while($row = mysqli_fetch_assoc($result)){ 
                $noResult=false;
                $id=$row['thread_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];

                
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
    



      <?php
    $showAlert = false; 
    $method = $_SERVER['REQUEST_METHOD'];
    // echo $method;
    if($method=='POST'){
        //insert into comment db
        $comment = $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        $showAlert = true;

        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> your comment has been added !
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }
    }
    
    ?>

<div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title; ?></h1>
            <h6 class="lead"><?php echo $desc ?> </h6>
            <hr class="my-4">
            <p>
                This is a peer to peer forum for sharing knowledge with each other,Keep it friendly.
                Be courteous and respectful. Appreciate that others may have an opinion different from yours.
                Stay on topic. ...
                Share your knowledge. ...
                Refrain from demeaning, discriminatory, or harassing behaviour and speech.
            </p>
            <p><b>Posted by : Jamal</b></p>
        </div>
    </div>

    <!-- //form container -->
       <div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <!-- $_SERVER['REQUEST_URI'] that means same url pe post request -->
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Type your comment</label>
    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
  </div>


  <button type="submit" class="btn btn-success">Post Comment</button>
</form>
    </div>

    <div class="container" id="ques">
        <h2 class="py-2"> Discussions</h2>
         <?php
    $id=$_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
             
             $result = mysqli_query($conn,$sql);
             $noResult = true;
             while($row = mysqli_fetch_assoc($result)){ 
                $noResult = false;
                $id=$row['comment_id'];
                $content = $row['comment_content'];
                // $content = $row['comment_by'];
                $comment_time=$row['comment_time'];
                

   
       echo  '<div class="media">
            <img class="align-self-center mr-3" src="img/userimg.png" width="60px" alt="Generic placeholder image">
            <div class="media-body">
                <p class="font-weight-bold my-0">Annomyous user at '.$comment_time.'</p>
                <h6> '.$content.'</h6>
            </div>
        </div>';
    }
    // echo var_dump($noResult);
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No comment found</p>
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