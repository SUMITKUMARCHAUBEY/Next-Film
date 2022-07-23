<?php

session_start();
$added=false;
include "partials/_dbconnect.php";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $fname=$_GET['cata'];
  $userid=$_GET['uid'];
  $com=$_POST['comment'];
  $sql="INSERT INTO `comments` (`sl_on`, `film`, `com`, `com_user_id`, `time`) VALUES  (NULL, '$fname', '$com','$userid',current_timestamp());";
  mysqli_query($con,$sql); 
  header("location:/myimdb/film_desc.php?added=true&&cata=$fname");
 
 
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Next Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="/myimdb/Next_Film.jpg" />
  </head>
  <style>
    div.carditem {
    width: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.card2{
    display: flex;
    overflow-x : scroll;
    margin-left: 50px;
    margin-right: 50px;
    padding-bottom: 10px;
}
.abc{
  display: flex;
  flex-wrap: row;
}
    </style>
  <body>
  <?php
   include "partials/_header.php";
   include "partials/_dbconnect.php";


   if(isset($_GET['added']) && $_GET['added']==true){
    echo '<div class="alert alert-success" role="alert">
    Added Successfully!!
  </div>';
  
  }
   
   ?>
<?php
$film=$_GET['cata'];

$sql="SELECT * FROM `films` WHERE name='$film';";
  $res=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($res);
  // echo $row['film_desc'];
    
   


echo '
<div class="jumbotron bg-dark  text-light m-5 p-5" style="border-radius:25px;">
  <div class="abc">
  <img src="/myimdb/partials/img/'.$film.'.jpg"  alt="..." width="180" height="230" style="border-radius:25px;">
  <div>
  <h3 class="mx-5 px-4">'.$film.'</h3>
  <p class="lead mx-5 p-4">
  '.$row['film_desc'].'</p><p class="mx-5 px-4"><b>IMDB Rating: '.$row['stars'].'/10</b></p></div></div>
  <hr class="my-4">
  <pre class="mb-0" style="font-size: 20px;"><t><span>    Director: '.$row['dir'].'</span><span>      Staring: '.$row['actor'].' </span><span>      Genera: '.$row['genera'].'  </span></pre>
  
</div>';
 ?>
 <?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){

$thr_unam=$_SESSION['username'];


$sql12="SELECT * FROM `users` WHERE username='$thr_unam';";
$result12=mysqli_query($con,$sql12);
$row12=mysqli_fetch_assoc($result12);
$uid=$row12['sl_no'];


echo '<div class="container">
<form action="film_desc.php?uid='.$uid.' && cata='.$film.'" method="post">
<div class="form-group">
<label for="exampleFormControlTextarea1"><h2>Reviews</h2></label>
<textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
<button type="submit" class="btn btn-success my-3">Submit</button>
</div>



</form>
</div>';
}

else{
  echo '<h1 class="container " style="height:120px; text-align:center;"><b>Please login to write a review.</b><br>
  <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Log In</button>
      <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign Up</button></h1>';
}



 ?>


<div class="container my-5 mb-5 pb-5"><h2><b>Reviews</b></h2>
<?php
   $empty=true;
   $sql4="SELECT * FROM `comments` WHERE film='$film';";
   $result4=mysqli_query($con,$sql4);
   while($row=mysqli_fetch_assoc($result4)){
    $empty=false;

    $thr_uid=$row['com_user_id'];
    // echo $thr_uid;
    $sql11="SELECT * FROM `users` WHERE sl_no=$thr_uid;";
    $result11=mysqli_query($con,$sql11);
    $row11=mysqli_fetch_assoc($result11);

    echo '<div class="container my-5 mx-6">
   
    <div class="media my-3">
<img class="mr-3" src="img1.webp" width=54px alt="Generic placeholder image">
<div class="media-body">
  '.$row['com'].'
</div>
</div>
<div style="text-align: right;"><b>posted by :- '.$row11['username'].'</b>
</div>
</div><hr>'; 
   }
   if($empty)
   {
    echo '<div class="jumbotron jumbotron-fluid my-4">
    <div class="container">
      <p class="display-5">No One Has Reviewed It Yet!!</p>
      <p class="lead">Be the first person to answer this question.</p>
    </div>
  </div>';
   }
   ?>
    </div>


 
 <?php
   include 'partials/_footer.php';
  ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>