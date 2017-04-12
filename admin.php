<?php
require_once 'core/init.php';

if( !$user->is_login() ){
  Session::flash('login', '<script>alert("Anda Harus Login")</script>');
  Redirect::to('login');
}

if(Session::exists('profile')){
  echo Session::flash('profile');
}

// pengecekan halaman admin
if(!$user->is_admin(Session::get('username'))){
  Session::flash('profile', '<script>alert("Halaman Ini Khusus Admin")</script>');
  Redirect::to('profile');
}

$users = $user->get_users();

?>
<?php require_once 'templates/header.php'; ?>

  <h2 class="judul">Halaman Admin</h2>

  <?php foreach($users as $_user): ?>
    <div class="list">
      <a class="list" href="profile.php?nama=<?php echo $_user['username']?>"> <?php echo $_user['username']?></a>
    </div>
  <?php endforeach; ?>

<?php require_once 'templates/footer.php'; ?>
