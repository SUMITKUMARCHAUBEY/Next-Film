<?php
include "partials/_dbconnect.php";
session_start();
 if($_SESSION['loggedin']==true){
 
if(isset($_FILES["img"]) && $_SERVER["REQUEST_METHOD"]=="POST")
{

$iname=$_FILES["img"]["name"];
$size=$_FILES["img"]["size"];
$temp_name=$_FILES["img"]["tmp_name"];

$exe=pathinfo($iname,PATHINFO_EXTENSION);

if($size<=250000 && strtolower($exe)=="jpg"){
 
  
 
  $title=$_POST["title"];
  $yor=$_POST["date"];
  $dir=$_POST["director"];
  $desc=$_POST["desc"];
  $act=$_POST["actor"];
  $rat=$_POST["rating"];
  $gen=$_POST["genre"];
  $sql="SELECT * FROM `shows` WHERE name='$title';";
  $result=mysqli_query($con,$sql);
  $num=mysqli_num_rows($result);
  if($num==0)
  {
   
    if($title.".jpg"==$iname){
 $sql="INSERT INTO `shows` (`sl_no`, `name`, `yor`, `dir`, `actor`, `stars`, `genera`, `show_desc`) VALUES (NULL, '$title', '$yor', '$dir', '$act', '$rat', '$gen', '$desc');";
 $result=mysqli_query($con,$sql);
 $res=move_uploaded_file($temp_name,"partials/img/".$iname);
 if($result){
  header("location:/myimdb/_add_tv.php?added=true");
 }
 else{
  echo "somthing went wrong!!";
 }
    }
    else{
     
      echo 'please match the title of show with the name of the image';
    }
}
else{
  echo "title already exist";
}

}
 



else{
  echo "eroor";
  $error=true;
}



}

echo '



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="/myimdb/Next_Film.jpg" />

    </head>
<body>';

   include "partials/_header.php";

   if(isset($_GET['added']) && $_GET['added']==true){
    echo '<div class="alert alert-success" role="alert">
     Added Successfully!!
  </div>';
  
  }
  
   echo '
   <h1 class="text-center my-2">Add New TV Show</h1>
   
   <div class="container my-5" style="border: 2px solid green; border-radius: 25px;">
   <h2 class="my-5">Give Us The Show Details.</h2>
   
   
   
   <form action="/myimdb/_add_tv.php" method="post" enctype="multipart/form-data">
    
   <div class="row mt-5 p-5">
     
    <div class="col">
    <label for="exampleFormControlTextarea1"><h3>Show Title</h3></label>
      <input type="text" class="form-control" placeholder="Show Title" name="title" id="title">
    </div>
    <div class="col"><label for="exampleFormControlTextarea1"><h3>Date of release</h3></label>
      <input type="date" class="form-control" name="date" id="date" placeholder="Date of release">
    </div>

    <div class="form-group py-5">
    <label for="exampleFormControlTextarea1"><h3>Show Description</h3></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc" id="desc"></textarea>
  </div>

  <div class="row">
  <div class="col"><label for="exampleFormControlTextarea1"><h3>Directed By</h3></label>
      <input type="text" name="director" id="director" class="form-control" placeholder="Directed By">
    </div>
    <div class="col"><label for="exampleFormControlTextarea1"><h3>Staring</h3></label>
      <input type="text" name="actor" id="actor" class="form-control" placeholder="Staring">
    </div>
    </div>

    <div class="row my-5">
  <div class="col"><label for="exampleFormControlTextarea1"><h3>Genre</h3></label>
      <input type="text" name="genre" id="genre" class="form-control" placeholder="Genre">
    </div>
    <div class="col"><label for="exampleFormControlTextarea1"><h3>IMDB Rating</h3></label>
      <input type="number" name="rating" id="rating" class="form-control" placeholder="IMDB Rating"  min="0" max="10">
    </div>
    </div>
    <div class="form-group my-5">
    <label class="mx-0" for="exampleFormControlFile1"><h3>Show Poster</h3><p>The image must be of the exact name as the show title and in .jpg format and also the size must be less then 250kb </p></label>
    <input type="file" name="img" id="img" class="form-control-file mx-0 px-3" id="exampleFormControlFile1">
  </div>
    <button class="btn btn-success" type="submit">submit</button>
  </div>

 
  
 </form>
   </div>';

   include "partials/_footer.php";
    echo '
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>
'; 
}
else{
  header("location:/myimdb/home.php");
}
?>