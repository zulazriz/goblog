<?php

if (isset($_POST["regUser"])) {

  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $user = $_POST["username"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $confirmpwd = $_POST["confirmpwd"];

  require_once '../config.php';
  require_once 'functions.php';

  if (emptyInputRegister($fname, $lname, $user, $email, $pwd, $confirmpwd) !== false) {
    header("location: ../users/userlogin.php?error=emptyinput");
    exit();
  }
  if (pwdMatch($pwd, $confirmpwd) !== false) {
    header("location: ../users/userlogin.php?error=passwordsdontmatch");
    exit();
  }
  if (EmailExists($conn, $email) !== false) {
    header("location: ../users/userlogin.php?error=emailtaken");
    exit();
  }
  if (UsernameTaken($conn, $user) !== false) {
    header("location: ../users/userlogin.php?error=usernametaken");
    exit();
  }
  createUser($conn, $fname, $lname, $user, $email, $pwd);
}else {
  header("location: ../users/userlogin.php");
  exit();
}

?>
