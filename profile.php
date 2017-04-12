<?php
require_once 'core/init.php';

if( !$user->is_login() ){
  Session::flash('login', '<script>alert("Anda Harus Login")</script>');
  Redirect::to('login');
}

if(Session::exists('profile')){
  echo Session::flash('profile');
}

if(Input::get('nama')){
  $user_data = $user->get_data(Input::get('nama'));
}else {
  $user_data = $user->get_data(Session::get('username'));
}

?>
<?php require_once 'templates/header.php'; ?>

<!-- fungsi multi level user       -->
<?php if($user_data['username'] == Session::get('username')){?>
<?php if($user->is_admin(Session::get('username'))){?>
  <a style="color:#eee;margin-left:-215px;text-decoration: underline;" href="admin.php">Selamat Datang Admin</a>
<?php } ?>
<?php } ?>
      <h1 class="judul"><strong>Halo <?php echo $user_data['username']; ?></strong></h1>

<?php require_once 'templates/footer.php'; ?>
