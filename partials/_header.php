<?php
// session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid mx-5 " style="height:100px; font-size:25px;">

<a class="navbar-brand ml-0 " href="/myimdb/home.php"><img class="ml-0 pt-2" src="/myimdb/Next_Film.jpg" width="170" height="100px"  alt="..." style="border-radius:20px;"/></a>
  <a class="navbar-brand" href="/myimdb/home.php" style="font-size:25px;">Home</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/myimdb/generas.php">Genres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/myimdb/films.php">Films</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/myimdb/tv.php">TV Shows</a>
      </li>
      
      ';


    //   <li class="nav-item">
    //   <a class="nav-link active" href="/myimdb/films.php">Contect</a>
    // </li>
    
    // <li class="nav-item">
    //   <a class="nav-link active" href="/myimdb/films.php">About</a>
    // </li>



      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    {
      echo'
      <li class="nav-item dropdown mx-3">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
       Add New Content
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="_add_film.php">Add Film</a></li>
          <li><a class="dropdown-item" href="_add_tv.php">Add TV Show</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="_add_genera.php">Add Genres</a></li>
        </ul>
      </li>
      
   
    ';
    }
    echo ' </ul>
    <form class="d-flex" action="/myimdb/search.php" method="post">
      <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search" name="search" id="search">
      <button class="btn btn-outline-success mx-3" type="submit" >Search</button>
    </form>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
    {
        echo '<p class="text-light mx-3 my-1">Wellcome '.$_SESSION['username'].'</p> <a href="/myimdb/partials/_logout.php" class="btn btn-success">Log Out</a>
        </div>
      </div>
      </nav>';
    }
    else{
      echo '
    <button class="btn btn-success mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#signupmodal" >Sign Up</button>
    <button class="btn btn-success mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#loginmodal">Log In</button>
  </div>
</div>
</nav>';

    }  
include 'partials/_signup.php';
include 'partials/_login.php';
?>
