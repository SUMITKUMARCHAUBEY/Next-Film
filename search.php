<?php
session_start();
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
   ?>
   <hr style="height:1px;border:solid;color:green;">
 <?php
 
 if($_SERVER['REQUEST_METHOD']=="POST")
 {

    $gen=$_POST['search'];
    echo '<h1 class="mx-5 px-5 text-light my-0"><u><br><br>'.$gen.' Films<u></h1>
       
    <div class="abc m-5 p-5 mt-0">
';
$sql="SELECT * FROM `films` WHERE match(`name`, `dir`,`actor`,`genera`) AGAINST ('$gen');";
#$sql="SELECT * FROM `films` WHERE name='$gen';";
  $res=mysqli_query($con,$sql);
  while($row=mysqli_fetch_assoc($res))
  {
    $cat=$row['name'];
    $cat_id=$row['sl_no'];
   
    echo '<div class=" mx-2 mb-20" style="display:flex;">
  
    <div class="card my-3 " style="width: 16rem; border-radius:25px;">
    <img src="partials/img/'.$cat.'.jpg" class="card-img-top" alt="..." width="700" height="260" style="border-radius:25px;">
    <div class="card-body">
      
     <h5 class="card-title">
      <a href="film_desc.php? cata='.$cat.'"  class="btn btn-success">'.$cat.'</a>
    </div>
  </div>
  </div>
  ';
  }
  echo '</div>';

  
 }


      ?>
 
 
 <?php
   include 'partials/_footer.php';
  ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>

