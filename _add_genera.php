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
  
  $sql="SELECT * FROM `generas` WHERE genera_name='$title';";
  $result=mysqli_query($con,$sql);
  $num=mysqli_num_rows($result);
  if($num==0)
  {
   
    if($title.".jpg"==$iname){
 $sql="INSERT INTO `generas` (`sl_no`,`genera_name`) VALUES (NULL,'$title');";
 $result=mysqli_query($con,$sql);
 $res=move_uploaded_file($temp_name,"partials/img/".$iname);
 if($result){
  header("location:/myimdb/_add_genera.php?added=true");
 }
 else{
  echo "somthing went wrong!!";
 }
    }
    else{
        echo 'please match the name of the image with the title of the genera';
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
   <h1 class="text-center my-2">Add New Genre</h1>
   
   <div class="container my-5" style="border: 2px solid green; border-radius: 25px;">
   <h2 class="my-5">Give Us The Genre Details.</h2>
   
   
   
   <form action="/myimdb/_add_genera.php" method="post" enctype="multipart/form-data">
    
   <div class="row mt-5 p-5">
     
    <div class="col">
    <label for="exampleFormControlTextarea1"><h3>Genre Title</h3></label>
      <input type="text" class="form-control" placeholder="Genre Title" name="title" id="title" required maxlength=20>
    </div>
    
    <div class="form-group my-5">
    <label class="mx-0" for="exampleFormControlFile1"><h3>Genre Poster</h3><p>The image must be of the exact name as the genre title and in .jpg format and also the size must be less then 250kb </p></label>
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