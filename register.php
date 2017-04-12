<?php
require_once 'core/init.php';

// pengujian session logout
if($user->is_login()){
  Redirect::to('profile');
}
// untuk menampung error
$errors = array();

if( Input::get('submit') ){
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
              ),
  'password_verify' => array(
                        'required' => true,
                        'match'    => 'password',
              )

));

  if($user->cek_nama(Input::get('username'))){ // menguji nama terdaftar
    $errors[] = "Nama Sudah Terdaftar Mohon Diganti";
  }else{
// lolos seleksi
if($validation->passed() ){
  $user->register_user(array(
    'username' => Input::get('username'),
    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
  ));
  Session::flash('profile','<script>alert("Selamat ! Anda Berhasil Mendaftar")</script>');
  Session::set('username',Input::get('username'));
  Redirect::to('profile');
}else {
  // untuk mengisi errornya ke array
  $errors = $validation->errors() ;
    }
  }
}


require_once 'templates/header.php';
?>
<h2 class="judul">Daftar Disini</h2>
<form action="register.php" method="post">
  <input type="text" class="bil" name="username" placeholder="Masukan Username"><br>
  <input type="password" class="bil" name="password" placeholder="Masukan Password"><br>
  <input type="password" class="bil" name="password_verify" placeholder="Ulangi Password"><br>
  <input type="submit" class="tombol" name="submit" value="Daftar Sekarang">
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
