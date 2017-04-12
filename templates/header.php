<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
      <link rel="stylesheet" href="assets/style.css">
      <link rel="stylesheet" href="assets/sweetalert-master/dist/sweetalert.css">
      <script src="assets/sweetalert-master/dist/sweetalert.min.js"></script>
  </head>
  <body>


    <div class="utama">
    <h2 class="judul"><strong>Login Auth OOP PHP</strong></h2>
    <nav>
      <?php if(Session::exists('username')){ ?>
      <a class="menu" href="logout.php">logout</a>
      <a class="menu" href="change-password.php">Ganti Password</a>
      <?php }else{ ?>
      <a class="menu" href="login.php">Login</a>
      <a class="menu" href="register.php">Register</a>
      <?php } ?>
      <a class="menu" href="profile.php">Profile</a>
    </nav><br><br>
