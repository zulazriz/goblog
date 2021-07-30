<?php

session_start();
include '../config.php';

$userid = $_SESSION['userid'];

if (isset($_POST['publish'])) {

  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $dateposted = date('Y-m-d');
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
        echo '<script type="text/javascript">alert("File too large. File must be less than 10MB.");location="../users/createposts.php";</script>';
      }else {
        // Upload
        if(move_uploaded_file($_FILES['imgtitle']['tmp_name'], $target_file)){
            // Insert into db
            $query = "INSERT INTO posts(post_title, post_text, post_image, image_name, dateposted, lastmodified, userid)
                      VALUES ('$title', '$desc', '$target_file', '$name', '$dateposted', '$dateposted', '$userid')";
            mysqli_query($conn, $query);

            echo '<script type="text/javascript">alert("Successfully publish!");location="../users/blog.php";</script>';
            // echo "$title | $desc | $target_file | $dateposted | $userid";
        }
      }
    }else{
      echo '<script type="text/javascript">alert("Invalid file type!");location="../users/createposts.php";</script>';
    }
  }
}

?>
