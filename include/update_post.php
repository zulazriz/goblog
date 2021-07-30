<?php

session_start();
include '../config.php';

$userid = $_SESSION['userid'];
$postid = $_GET['post_id'];

if (isset($_POST['publish'])) {

  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $lastmodified = date('Y-m-d');
  // echo "$title | $desc | $dateposted | $img";

  if (isset($_FILES['imgtitle']['name'])){

    $maxsize = 10000024; // 10MB

    $name = $_FILES['imgtitle']['name'];
    $target_dir = "../images/titleimg/";
    $target_file = $target_dir . $_FILES["imgtitle"]["name"];

    // Select file type
    $imagesFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","png","gif","jpeg","webp");

    // Check extension
    if(in_array($imagesFileType, $extensions_arr) ){
      // Check file size
      if(($_FILES['imgtitle']['size'] >= $maxsize) || ($_FILES['imgtitle']['size'] == 0)) {
        echo '<script type="text/javascript">alert("File too large. File must be less than 10MB.");location="../users/blog.php";</script>';
      }else {
        // Upload
        if(move_uploaded_file($_FILES['imgtitle']['tmp_name'], $target_file)){
            // Insert into db
            $query = "UPDATE posts
                      SET post_title ='$title', post_text = '$desc', post_image = '$target_file', image_name = '$name', lastModified = '$lastmodified', userid = '$userid'
                      WHERE post_id = '$postid';";
            mysqli_query($conn, $query);

            echo '<script type="text/javascript">alert("Successfully update post!");location="../users/blog.php";</script>';
            // echo "$title | $desc | $target_file | $dateposted | $userid";
        }
      }
    }else{
      echo '<script type="text/javascript">alert("Invalid file type!");location="../users/blog.php";</script>';
    }
  }
}

?>
