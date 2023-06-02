<?php
session_start();

if (isset($_SESSION['user_name'])){
    header('Location: chat');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
  <title>Welcome to chat</title>
  <link rel="stylesheet" href="style/style.css">
    <script src="js_scripts/conf_passw.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="box">
      <div class="form-box">
          <?php
          if (isset($_SESSION['flash'])):
              if ($_SESSION['flash']['type'] != 'success'):?>
              <div class="flash-error">
                  <p class="message"><?php echo $_SESSION['flash']['error']; ?></p>
              </div>
              <?php else:?>
              <div class="flash-success">
                  <p class="message"><?php echo $_SESSION['flash']['error']; ?></p>
              </div>
              <?php endif; ?>
          <?php unset($_SESSION['flash']); endif; ?>
        <div class="button-box">
          <div id="btn"></div>
          <button type="button" class="toggle-btn" onclick="login()">Log In</button>
          <button type="button" class="toggle-btn" onclick="register()">Register</button>
        </div>
          <form action="php/login.php" id="login" class="input-group" method="post">
              <input type="text" class="input-field" name="username_l" placeholder="Username" required>
              <input type="password" class="input-field" name="password_l" id="password_l" placeholder="Password" required>
              <i class="fas fa-eye" title="Show Password"></i>
              <input type="checkbox" class="check_box"><span>Remember Password</span>
              <button type="submit" class="submit-btn" name="login">Log in</button>
          </form>
          <form action="php/register.php" id="register" class="input-group" method="post">
              <input type="text" class="input-field" name="username_r" placeholder="Username" required>
              <input type="password" class="input-field" name="password_r" placeholder="Password" id="password" required>
              <input type="password" class="input-field" placeholder="Confirm Password" id="confirm_password" required>
              <input type="checkbox" class="check-box" required><span>I agree to the terms & conditions</span>
              <button type="submit" class="submit-btn" name="register" onclick="Check()">Register</button>
          </form>
      </div>
    </div>
	<script src="js_scripts/lor-reg.js"></script>
    <script src="js_scripts/hide_passw.js"></script>
    <script src="js_scripts/remember.js"></script>
</body>
</html>

