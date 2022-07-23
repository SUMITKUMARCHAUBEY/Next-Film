<?php
session_start();

include 'partials/_dbconnect.php';

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
  flex-wrap: wrap;
}
    </style>
  <body class="bg-dark">
  <?php
   include "partials/_header.php";
   include "partials/_dbconnect.php";

   if(isset($_GET['cpassfail']) && $_GET['cpassfail']==true){
    echo '
  <div class="alert alert-danger" role="alert">
   Your password did not match, please match your password and try again.
  </div>
  ';
  }
   
  if(isset($_GET['userexist']) && $_GET['userexist']==true){
    echo '<div class="alert alert-danger" role="alert">
   Username already exist, please choose another.
  </div>';
  
  }

  if(isset($_GET['notmatch']) && $_GET['notmatch']==true){
    echo '<div class="alert alert-danger" role="alert">
   Invalid Cradencials!!<br>
   Please SignUp, if you do not have an account.
  </div>';
  
  }

  if(isset($_GET['login']) && $_GET['login']==true){
    echo '<div class="alert alert-success" role="alert">
    Logged In Successfully!!
  </div>';
  
  }
  
  if(isset($_GET['logout']) && $_GET['logout']==true){
    echo '<div class="alert alert-success" role="alert">
    Logged Out Successfully!!
  </div>';
  
  }
  
  if(isset($_GET['signup']) && $_GET['signup']==true){
    echo '<div class="alert alert-success" role="alert">
    Signed Up Successfully!!
  </div>';
  
  }


   ?>
  





 <!-- <div class="container bg-dark p-5" style="lenght:100vw"> -->
 <div id="carouselExampleIndicators" class="carousel slide pt-4 py-5 px-4 bg-dark" data-bs-ride="true" >
  <div class="carousel-indicators" >
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"  class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
  </div>
  <div class="carousel-inner" >
    <div class="carousel-item active">
    <a href="generas.php? cata='action'"> <img src="partials\img\FILMS.webp" class="d-block w-100"width="1700" height="350"  alt="..." style="border-radius:25px;"></a>
    <!-- <a href="generas.php? cata='action'" class="btn btn-success"><h1 class="text-light mt-2 mb-0 mx-5 px-5">Action</h1></a> -->
      </div>
    
      <div class="carousel-item">
    <a href="generas.php? cata='comedy'"><img src="partials\img\DC.webp", class="d-block w-100" width="1700" height="350" alt="..." style="border-radius:25px;"></a>
      <!-- <h1 class="text-light mt-2 mb-0 mx-5 px-5">Comedy</h1> -->
    </div>

    <div class="carousel-item">
    <a href="generas.php? cata='drama'"><img src="partials\img\MC.jpg" class="d-block w-100" width="1700" height="350" style="border-radius:25px;" alt="..."></a>
      <!-- <h1 class="text-light mt-2 mb-0 mx-5 px-5">Drama</h1> -->
    </div>

    <div class="carousel-item">
    <a href="generas.php? cata='thriller'"><img src="partials\img\tv.avif" class="d-block w-100" width="1700" height="350" style="border-radius:25px;" alt="..."></a>
      <!-- <h1 class="text-light mt-2 mb-0 mx-5 px-5">Thriller</h1> -->
    </div>
    
    <div class="carousel-item">
    <a href="generas.php? cata='suspence'"><img src="partials\img\SW.jpg" class="d-block w-100" width="1700" height="350" style="border-radius:25px;" alt="..."></a>
      <!-- <h1 class="text-light mt-2 mb-0 mx-5 px-5">Suspence</h1> -->
    </div>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<h1 class="mx-5 mt-4 text-light">Some of the highest rated movies</h1>
<div class="card2">
  
           

<?php
$sql="SELECT * FROM `films`;";
$res=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($res))
{
  $cat=$row['name'];
  $cat_id=$row['sl_no'];
  $stars=$row['stars'];

  echo '<div class="abc mx-2">
      
  <div class="card my-3" style="height:320px;  width: 200px; border-radius:25px;">
  <img src="partials/img/'.$cat.'.jpg" class="card-img-top" alt="..." width="180" height="230" style="border-radius:25px;">
  <div class="card-body my-0 mx-1">
    
    <a href="film_desc.php? cata='.$cat.'"  class="btn btn-success">'.$cat.'</a>
    <p><b>Ratings: '.$stars.'/5</b></p>
  </div>
</div>
</div>';

}


?>



</div>



<h1 class="mx-5 mt-5 pt-5 text-light">Some of the highest rated TV Shows</h1>
<div class="card2">
  
           

<?php
$sql="SELECT * FROM `shows`;";
$res=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($res))
{
  $cat=$row['name'];
  $cat_id=$row['sl_no'];
  $stars=$row['stars'];

  echo '<div class="abc mx-2">
      
  <div class="card my-3" style="height:320px;  width: 200px; border-radius:25px;">
  <img src="partials/img/'.$cat.'.jpg" class="card-img-top" alt="..." width="180" height="230" style="border-radius:25px;">
  <div class="card-body my-0 mx-1">
    
    <a href="tv_desc.php? cata='.$cat.'"  class="btn btn-success">'.$cat.'</a>
    <p><b>Ratings: '.$stars.'/5</b></p>
  </div>
</div>
</div>';

}


?>



</div>







<div class="container mb-50 p-0 bg-dark">
<h1 class="text-center m-4 text-light mb-0"><u><br><br>generas<u></h1>
       
<div class="abc m-5 p-5 mt-0">



<?php

$sql="SELECT * FROM `generas`;";
      $res=mysqli_query($con,$sql);
      while($row=mysqli_fetch_assoc($res))
      {
        $cat=$row['genera_name'];
        $cat_id=$row['sl_no'];
       
        echo '<div class=" mx-2 mb-20" style="display:flex;">
      
        <div class="card my-3 " style="width: 16rem; border-radius:25px;">
        <img src="partials/img/'.$cat.'.jpg" class="card-img-top" alt="..." width="700" height="260" style="border-radius:25px;">
        <div class="card-body">
          <h5 class="card-title"><a href="generas.php? cata='.$cat_id.'"> </a></h5>
          <a href="/myimdb/films.php? gen='.$cat.'"  class="btn btn-success">'.$cat.'</a>
        </div>
      </div>
      </div>';
      }

      ?>
  </div>
</div> 
 
 
 
 <?php
   include 'partials/_footer.php';
  ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>