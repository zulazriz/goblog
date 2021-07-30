<?php

session_start();
include '../config.php';

$postid = $_GET['post_id'];
$userid = $_SESSION['userid'];

// echo "$postid | $userid";

if ($userid) {
  $query = "DELETE FROM posts WHERE post_id = $postid";
  $result = mysqli_query($conn, $query);

  echo '<script type="text/javascript">alert("Successfully delete post!");location="../users/blog.php";</script>';
}else {
  echo '<script type="text/javascript">alert("Oopss! Something wrong.");location="../users/blog.php";</script>';
}

?>
