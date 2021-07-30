<?php

  session_start();
  include './config.php';

  if (isset($_SESSION['logUser'])) {
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
    <meta charset="utf-8">
    <link rel="icon" href="./images/website/goblog3.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <title>goBlog!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand"><img src="./images/website/goblog2.png" alt="" style="width:25px; height:25px; filter: invert(1);"> goBlog!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                  <?php

                  if (isset($_SESSION["logUser"])) {
                    echo "<li class='nav-item'><a class='nav-link' href='index.php?Id=$userid&User=$fname $lname'>Home</a></li>
                          <li class='nav-item'><a class='nav-link' href='./users/blog.php?Id=$userid&User=$fname $lname'>Blog</a></li>
                          <li class='nav-item'><a class='nav-link' href=''>Welcome! $fname $lname</a></li>
                          <li class='nav-item'><a class='nav-link' href='./include/logout.php'><i class='fas fa-sign-out-alt' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Logout'></i></a></li>";
                  }else {
                    echo "<li class='nav-item'><a class='nav-link' href='./index.php'>Home</a></li>
                          <li class='nav-item'><a class='nav-link' href='./users/userlogin.php'>Login</a></li>";
                  }

                  ?>

                </ul>
            </div>
        </div>
    </nav>

  <header class="py-5 bg-light border-bottom mb-4">
      <div class="container">
          <div class="text-center my-5">
              <h1 class="fw-bolder">Publish your passions, your way</h1>
              <p class="lead mb-0">Create a unique and beautiful blog. It’s easy and free.</p>
          </div>
      </div>
  </header>

  <div class="container">
      <div class="row">
        <?php

        $query = "SELECT * FROM posts ORDER BY lastModified DESC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
          $string = $row['post_text'];

          // strip tags to avoid breaking any html
          $string = strip_tags($string);
          if (strlen($string) > 200) {

              // truncate string
              $stringCut = substr($string, 0, 200);
              $endPoint = strrpos($stringCut, ' ');

              //if the string doesn't contain any space then it will cut without word basis.
              $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
              $string .= '...';
          }

        ?>
          <div class="col-lg-6">
              <div class="card mb-4">
                <img class="mt-5 rounded mx-auto d-block" src="images/titleimg/<?php echo $row['image_name']; ?>" height="50%" width ="50%"/>
                  <div class="card-body">
                      <div class="small text-muted"><?php echo date_format(date_create($row['lastModified']), "F d, Y"); ?></div>
                      <h2 class="card-title"><?php echo $row['post_title']; ?></h2>
                      <p class="card-text"><?php echo $string; ?></p>
                      <a class="btn btn-primary" href="users/readmore.php?post_id=<?php echo $row['post_id']; ?>">Read more →</a>
                  </div>
              </div>
          </div>
          <?php } ?>
        </div>
      </div>

  <footer class="py-5 bg-dark">
      <div class="container"><p class="m-0 text-center text-white">Copyright&copy; goBlog! 2021</p></div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  
  </body>
</html>
