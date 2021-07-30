<?php
  include '../users/header.php';
  include '../config.php';

  if (isset($_SESSION['logUser'])){
    $userid = $_SESSION['userid'];
    $query = "SELECT * FROM user WHERE userid = '$userid'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {
      $fname = $row['user_Fname'];
      $lname = $row['user_Lname'];
      $blogname = $row['blogName'];
    }
  }

  $sql2 = mysqli_query($conn, "SELECT post_title, post_text, DATE_FORMAT(DATEPOSTED, '%M %d, %Y'), LASTMODIFIED, post_id, post_image FROM posts WHERE USERID = '$userid' ORDER BY post_id DESC");

?>

<link rel="stylesheet" href="../assets/css/blogstyle.css">
<link rel="stylesheet" href="../assets/css/modalstyle.css">

 <header class="py-5 bg-light border-bottom mb-4">
      <div class="container">
          <div class="text-center my-3">
            <h1 class="fw-bolder"><?php echo $blogname?></h1>
            <p class="lead mb-0">by <?php echo $fname." ".$lname?></p>
          </div>
      </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="wrapper">
        <div class="icon create">
          <div class="tooltip">New post</div><a href="../users/createposts.php">
          <span><i class="fas fa-plus"></i></span></a>
        </div>
      </div>
    </div>
      <div class="row justify-content-center mt-3">
          <div class="col-lg-8">
              <?php
                if (mysqli_num_rows($sql2) == 0){ ?>
                  <div class="card mb-4 text-center">
                    <h2>No post</h2>
                  </div>
              <?php } ?>

              <?php
                while ($row2 = mysqli_fetch_array($sql2)){

                  $string = $row2[1];
                  // strip tags to avoid breaking any html
                  $string = strip_tags($string);
                  if (strlen($string) > 300) {

                      // truncate string
                      $stringCut = substr($string, 0, 300);
                      $endPoint = strrpos($stringCut, ' ');

                      //if the string doesn't contain any space then it will cut without word basis.
                      $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                      $string .= ' ...';
                  }
              ?>
              <div class="card mb-4">
                <div class="card-body">
                  <div class="small text-muted"><?php echo $row2[2]?></div>
                    <div class="nav-link float-end" id="updelpost" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h text-dark"></i>
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="updelpost">
                      <li><a class="dropdown-item fw-bold" href="../users/updateposts.php?post_id=<?php echo $row2[4] ?>">Update</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item fw-bold" href="" data-bs-toggle="modal" data-bs-target="#deletepost<?php echo "$row2[4]" ?>">Delete</a></li>
                    </ul>
                  <h2 class="card-title"><?php echo $row2[0]?></h2>
                  <div class="mt-4 mb-5 text-center">
                    <?php echo '<img class="rounded" src="'.$row2[5].'"height="50%" width ="50%"/>'?>
                  </div>
                  <p class="card-text"><?php echo $string; ?>
                    <button type="button" name="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#readmore<?php echo "$row2[4]"?>"> Read more →</button>
                  </p>
                </div>
              </div>

              <div class="modal fade" id="readmore<?php echo "$row2[4]"?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><?php echo "$row2[0]"; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <center><?php echo '<img src="'.$row2[5].'"height="50%" width ="50%"/>'?></center><br>
                      <p class="card-text"><?php echo "$row2[1]"?></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal delete post -->
              <div id='deletepost<?php echo "$row2[4]" ?>' class='modal fade' aria-hidden='true'>
                <div class='modal-dialog modal-confirm'>
                  <div class='modal-content'>
                    <div class='modal-header flex-column'>
                      <div class='icon-box'>
                        <i class='material-icons'>&#xE5CD;</i>
                      </div>
                      <h4 class='modal-title w-100 text-dark'>Are you sure?</h4>
                      <button type='button' class='close btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                      <p class='text-dark'>Do you really want to delete these post? This process cannot be undone.</p>
                    </div>
                    <div class='modal-footer justify-content-center text-white'>
                      <a data-bs-dismiss='modal' type='button' class='btn btn-secondary text-white'>Cancel</a>';
                      <a href='../include/delete_post.php?post_id=<?php echo "$row2[4]" ?>' type='button' class='btn btn-danger text-white'>Delete</a>';
                    </div>
                  </div>
                </div>
              </div>
              <?php }?>
          </div>
          <div class="col-4">
            <iframe src="https://open.spotify.com/embed/playlist/1kupMZ2qcZqeVbtgQABSm8" width="100%" height="550" frameBorder="0" allowtransparency="true" allow="encrypted-media"></iframe>
          </div>
      </div>
  </div>

<?php include '../users/footer.php'; ?>
