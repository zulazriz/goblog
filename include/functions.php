<?php

function emptyInputRegister($fname, $lname, $user, $email, $pwd, $confirmpwd) {
  $result;
  if (empty($fname) || empty($lname) || empty($user) || empty($email) || empty($pwd) || empty($confirmpwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $confirmpwd) {
  $result;
  if ($pwd !== $confirmpwd) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function EmailExists($conn, $email) {
  $sql = "SELECT * FROM user WHERE email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../users/userlogin.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function UsernameTaken($conn, $user) {
  $sql = "SELECT * FROM user WHERE username = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../users/userlogin.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $user);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $fname, $lname, $user, $email, $pwd) {

  $sql = "INSERT INTO user (user_Fname, user_Lname, username, email, password, blogName, image) VALUES (?, ?, ?, ?, ?, ?, '../images/profile/default_picture.png');";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../users/userlogin.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $blogName = $fname . "'s Blog";
  mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $user, $email, $hashedPwd, $blogName);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../users/userlogin.php?error=none");
  exit();
}

function emptyInputLogin($email, $password) {
  $result;
  if (empty($email) || empty($password)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

?>
