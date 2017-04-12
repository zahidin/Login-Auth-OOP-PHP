<?php
require_once 'core/init.php';

if( !$user->is_login() ){
  Session::flash('login', '<script>alert("Anda Harus Login")</script>');
  Redirect::to('login');
}
$user_data = $user->get_data(Session::get('username'));

$errors = array();

if( Input::get('submit') ){
  if( Token::check(Input::get('token'))){

    $validation = new Validation();

    // metode check
    $validation = $validation->check(array(
      'password' => array(
                    'required' => true,
                  ),
      'password_baru' => array(
                    'required' => true,
                    'min'      => 3,
                  ),
      'password_verify' => array(
                    'required' => true,
                    'match' => 'password_baru'
                  )
    ));
    if($validation->passed() ){

        if(password_verify(Input::get('password'),$user_data['password'])){

          $user->update_user(array(
            'password' => password_hash(Input::get('password_baru'), PASSWORD_DEFAULT)
          ), $user_data['id']);

          Session::flash('profile','<marquee>Selamat ! Anda Berhasil Mengganti Password</marquee>');
          Redirect::to('profile');

        }else{
          $errors[]="Password Anda Salah";
        }

    }else {
      $erros = $validation->errors();
    }

  }
}

?>
<?php require_once 'templates/header.php'; ?>
<h2 class="judul">Ganti Password</h2>
<form class="" action="change-password.php" method="post">
  <input type="password" class="bil" name="password" placeholder="Masukan Password Lama"><br>
  <input type="password" class="bil" name="password_baru" placeholder="Masukan Password Baru"><br>
  <input type="password" class="bil" name="password_verify" placeholder="Ulangi Password Baru"><br>
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  <input type="submit" class="tombol" name="submit" value="Ganti Password">

  <!-- menampilkan error -->
  <?php if(!empty($errors)){ ?>
    <div class="error">
      <?php foreach ($errors as $error) { ?>
        <!-- sweetalert -->
        <body onload='swal({title: "Ganti Password Ada Kesalahan !",
                                text: "<b><?php echo $error;?></b>",
                                timer: 3000,
                                type: "error",
                                html: true,
                                showConfirmButton: false });'>
    <?php  } ?>
    </div>
  <?php } ?>
</form>

<?php require_once 'templates/footer.php'; ?>
