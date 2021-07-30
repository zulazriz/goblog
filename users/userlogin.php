<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../images/website/goblog.ico">
    <link rel="stylesheet" href="../assets/css/loginstyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <title>goBlog!</title>
  </head>
  <body>
    <div class="hero">
      <div class="form-box">
        <div class="button-box">
          <div id="btn"></div>
          <button type="button" class="toggle-btn" onclick="login()">Login</button>
          <button type="button" class="toggle-btn" onclick="register()">Register</button>
        </div>
        <div class="social-icons">
          <img src="../images/website/fb.png" alt="">
          <img src="../images/website/tw.png" alt="">
          <img src="../images/website/gp.png" alt="">
        </div>

        <form id="login" class="input-group" action="../include/login.php" method="POST">
          <input type="text" class="input-field" placeholder="Please enter your username or email" name="username" required>
          <div>
            <input type="password" class="input-field" id="id_password" placeholder="Please enter your password" name="password" required>
            <i class="fas fa-eye" id="togglePassword"></i>
          </div>


          <?php
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Fill in all fields!</p>";
              }elseif ($_GET["error"] == "incorrectlogin") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Incorrect username/email or password</p>";
              }
            }
          ?>

          <input type="checkbox" class="checkbox" <?php if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) { ?> checked <?php } ?>><span>Remember me</span>
          <button type="submit" class="submit-btn" name="logUser">Login</button>
          <button type="button" class="back-btn"><a href="../index.php">Back</a></button>
        </form>

        <form id="register" class="input-group" action="../include/register.php" method="POST">
          <input type="text" class="input-field" placeholder="Enter first name" name="fname" required>
          <input type="text" class="input-field" placeholder="Enter last name" name="lname" required>
          <input type="text" class="input-field" placeholder="Enter username" name="username" required>
          <input type="email" class="input-field" placeholder="Enter email" name="email" required>
          <div>
            <input type="password" class="input-field" id="id_password2" placeholder="Enter password" name="pwd" required>
            <i class="fas fa-eye" id="togglePassword2"></i>
            <input type="password" class="input-field" id="id_password3" placeholder="Enter confirm password" name="confirmpwd" required>
            <i class="fas fa-eye" id="togglePassword3"></i>
          </div>

          <?php
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Fill in all fields!</p>";
              }elseif ($_GET["error"] == "passwordsdontmatch") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Password doesn't match!</p>";
              }elseif ($_GET["error"] == "stmtfailed") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Something went wrong, try again!</p>";
              }elseif ($_GET["error"] == "emailtaken") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Email already taken!</p>";
              }elseif ($_GET["error"] == "usernametaken") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>Username already taken!</p>";
              }elseif ($_GET["error"] == "none") {
                echo "<p style='font-weight: bold; font-size: 20px; text-align: center;'>You have registered!</p>";
              }
            }
          ?>

          <input type="checkbox" class="checkbox"><span>I agree to the terms & conditions</span>
          <button type="submit" class="submit-btn" name="regUser">Register</button>
        </form>
      </div>
    </div>

    <script src="../assets/js/scripts.js"></script>
    <script>
      var x = document.getElementById("login");
      var y = document.getElementById("register");
      var z = document.getElementById("btn");

      function register() {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
      }

      function login() {
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0";
      }
    </script>
  </body>
</html>
