<?php

session_start();
require_once "../config.php";

if (isset($_POST["logUser"])) {

  $email = $_POST['username'];
  $password = $_POST['password'];

  require_once "../include/functions.php";

  if (emptyInputLogin($email, $password) !== false) {
    header("location: ../users/userlogin.php?error=emptyinput");
    exit();
  }

  $query = "SELECT * FROM user WHERE email = '$email' OR username = '$email'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if (password_verify($password, $row['password'])) {
      $_SESSION['logUser'] = $row["user_Fname"];
      $_SESSION['userid'] = $row["userid"];
      header('Location: ../index.php?Id='.$row["userid"].'&User='.$row["user_Fname"].' '.$row["user_Lname"].'');
    }else {
      header('Location: ../users/userlogin.php?error=incorrectlogin');
    }
  }else {
    // echo "$email | $password";
    header('Location: ../users/userlogin.php?error=incorrectlogin');
  }
}

?>
