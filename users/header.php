<?php

  session_start();
  include '../config.php';

  if (isset($_SESSION['logUser']))
  {
    $userid = $_SESSION['userid'];
    $query = "SELECT * FROM user WHERE userid = '$userid'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {
      $fname = $row['user_Fname'];
      $lname = $row['user_Lname'];
    }
  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <link rel="icon" href="../images/website/goblog3.ico">
    <script src="https://cdn.tiny.cloud/1/e0ad0u2g5k535g7zzm2m1frbqicmwzo7wkw2ogajyq86qvm4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <title>goBlog!</title>
  </head>

  <style>
  .ck-editor__editable_inline {
    min-height: 350px;
  }
  </style>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><img src="../images/website/goblog2.png" alt="" style="width:25px; height:25px; filter: invert(1);"> goBlog!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                  <?php

                  if (isset($_SESSION["logUser"])) {
                    echo "<li class='nav-item'><a class='nav-link' href='../index.php?Id=$userid&User=$fname $lname'>Home</a></li>
                          <li class='nav-item'><a class='nav-link' href='../users/blog.php?Id=$userid&User=$fname $lname'>Blog</a></li>
                          <li class='nav-item'><a class='nav-link' href=''>Welcome! $fname $lname</a></li>
                          <li class='nav-item'><a class='nav-link' href='../include/logout.php'><i class='fas fa-sign-out-alt' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Logout'></i></a></li>";
                  }else {
                    echo "<li class='nav-item'><a class='nav-link' href='../index.php'>Home</a></li>
                          <li class='nav-item'><a class='nav-link' href='../users/userlogin.php'>Login</a></li>";
                  }

                  ?>

                </ul>
            </div>
        </div>
    </nav>
