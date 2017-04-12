<?php

require_once "core/init.php";

/* mengetes spl autoload
mengambil file di classses Database.php
$data = new Database(); */

// pengujian session logout
if($user->is_login()){
  Redirect::to('profile');
}

if(Session::exists('login')){
  echo Session::flash('login');
}

// untuk menampung error
$errors = array();

if( Input::get('submit') ){
  if( Token::check(Input::get('token'))){
// validasi :
// memanggil objek validasi
$validation = new Validation();

// metode check
$validation = $validation->check(array(
  'username' => array(
                'required' => true,
                'min'      => 3,
                'max'      => 50,
              ),
  'password' => array(
                'required' => true,
                'min'      => 3,
              )

));
if($validation->passed() ){
  // pengujian cek nama
  if($user->cek_nama(Input::get('username'))){
  if($user->login_user( Input::get('username'), Input::get('password') ) )
  {
    Session::set('username', Input::get('username'));
    Redirect::to('profile');
  }else{
    $errors[] = "Username Belum Terdaftar Silahkan Register Dahulu";
  }
}else{
  $errors[] = "Nama Belum Terdaftar";
}

}else {
  // untuk mengisi errornya ke array
  $errors = $validation->errors() ;
    }
  }// end token
} // end submit


require_once 'templates/header.php';
?>
<h2 class="judul">Login</h2>
<form action="login.php" method="post">
  <input type="text" class="bil" name="username" placeholder="Masukan Username"><br>
  <input type="password" class="bil" name="password" placeholder="Masukan Password"><br>
  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  <input type="submit" class="tombol" name="submit" value="Login Sekarang">
  <!-- menampilkan error -->
  <?php if(!empty($errors)){ ?>
    <div class="error">
      <?php foreach ($errors as $error) { ?>
        <!-- sweetalert -->
        <body onload='swal({title: "Login Gagal Ada Kesalahan !",
                                text: "<b><?php echo $error;?></b>",
                                timer: 3000,
                                type: "error",
                                html: true,
                                showConfirmButton: false });'>
    <?php  } ?>
    </div>
  <?php } ?>
</form>

<?php
require_once 'templates/footer.php';
?>
