<?php

include '_dbconnect.php';


if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $e=$_POST['email'];
  $email=$_POST['username'];
  $pass=$_POST['password'];
  $cpass=$_POST['cpass'];
  $sql="SELECT * FROM `users` WHERE username='$email' OR email='$e';";
  $result=mysqli_query($con,$sql);
  $num=mysqli_num_rows($result);
  if($num==0)
  {
    if($pass==$cpass)
    {
      
      // include '/myimdb/email_con.php';
      $hash=password_hash($pass,PASSWORD_DEFAULT);
      $sql2="INSERT INTO `users` (`sl_no`, `username`, `password`, `time`,`email`) VALUES (NULL, '$email', '$hash', current_timestamp(),'$e');";
      mysqli_query($con,$sql2); 
      
      header("location:/myimdb/home.php?signup=true"); 
     
      exit()
      ;
      
    }
    else
    {
        header("location:/myimdb/home.php?cpassfail=true");
    }
  }
  else{
    header("location:/myimdb/home.php?userexist=true");
  }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Next Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
 
  <body>
  <?php
   include "partials/_header.php";
   include "partials/_dbconnect.php";
  
   ?>
   <form action="/myimdb/partials/signup_handle.php" method="post">
   <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Confirm Otp</label>
    <input type="number" name="otp" class="form-control" id="otp" aria-describedby="emailHelp" required maxlength=20>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
 <?php
   include 'partials/_footer.php';
  ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
