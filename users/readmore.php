<?php

include '../users/header.php';
include '../config.php';

$postid = $_GET['post_id'];

?>

<link rel="stylesheet" href="../assets/css/readmorestyle.css">

<div class="container mt-5 mb-5">
  <div class="btnback">
    <div class="icon back">
      <a href="../index.php">
        <button class="glow-on-hover" type="button">
          <span><i class="fas fa-chevron-left"></i></span>
        </button>
      </a>
    </div>
  </div>
  <div class="row justify-content-center">
  <?php

  $query = "SELECT * FROM posts WHERE post_id = '$postid'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result)) {

  ?>
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-body">
          <div class="small text-muted"><?php echo date_format(date_create($row['lastModified']), "F d, Y"); ?></div>
          <h2 class="card-title"><?php echo $row['post_title']; ?></h2>
          <img class="mt-5 mb-5 rounded mx-auto d-block" src="../images/titleimg/<?php echo $row['image_name']; ?>" height="90%" width ="90%"/>
          <p class="card-text"><?php echo $row['post_text']; ?></p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<?php

include '../users/footer.php';

?>
