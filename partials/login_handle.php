<?php

if($_SERVER['REQUEST_METHOD']=="POST")
{
  include '_dbconnect.php';
    

    $user=$_POST['username'];
    $pass=$_POST['password'];
    $sql3="SELECT * FROM `users` WHERE username='$user';";
    $result3=mysqli_query($con,$sql3);
    $num1=mysqli_num_rows($result3);
    if($num1==1)
    {
      echo $pass;
      $row=mysqli_fetch_assoc($result3);
      if(password_verify($pass,$row['password'])){
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$user;
        header("location:/myimdb/home.php?login=true");
        exit();
      }
      else{
        $notmatch=true;
        header("location:/myimdb/home.php?notmatch=true");
      }
    }
    else{
        header("location:/myimdb/home.php?notmatch=true");
    }
}
?>