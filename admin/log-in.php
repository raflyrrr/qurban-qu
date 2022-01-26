<?php
session_start();
if (isset($_SESSION['admin'])) {
  header("location:index.php");
}

?>
<?php
require_once '../config/database.php';
require_once '../function/ap.fungsi.php';
require_once '../function/ap.login.php';
require_once '../function/ap.theme.php';
require_once '../function/ap.identitas.situs.php';
LoadHead($nama_situs, $alamat_situs, $deskripsi_situs, $author_situs, $logo_situs);
LoadCss();
?>
<?php
$username_err = $password_err = $login = "";
if (isset($_GET['page']) == 'logout') {
  $logout = "Anda sudah keluar";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty(trim($_POST['username']))) {
    $username_err = "<div class='alert alert-danger'>Masukan username Anda</div>";
  } else {

    $username = FilterInput($_POST['username']);
    $username = EscapeString($username);
  }
  if (empty(trim($_POST['password']))) {
    $password_err = "<div class='alert alert-danger'>Masukan sebuah password</div>";
  } else {
    $password = trim($_POST['password']);
    $password = ($secret_panel . $password);
  }
  if (empty($username_err) && empty($password_err)) {
    if (LoginAdmin($username, $password)) {

      $_SESSION['id'] = $id;
      $_SESSION['nama'] = $nama;
      $_SESSION['email'] = $email;
      $_SESSION['admin'] = $username;
      $_SESSION['level'] = $level;

      $login = "<div class='alert alert-success'>Login berhasil, mengarahkan...</div>";
      echo "<meta http-equiv=\"refresh\"content=\"2;URL=index.php\"/>";
    } else {
      $login = "<div class='alert alert-danger'>Username atau password salah</div>";
    }
  }

  $koneksi->close();
}

?>

<link href="../theme/css/sb-admin.css" rel="stylesheet">

<body style="background-color: #8EC5FC;
background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header" style="text-align: center; font-weight:bold; font-size:20px">QurbanQu</div>
      <div class="logo-login">
      </div>
      <div class="card-body">
        <?php echo $login; ?>
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

          <div class="form-group">
            <div class="form-label-group">
              <input style="border: none;" id="username" name="username" class="form-control" placeholder="Masukan Username" required="required" autofocus="autofocus">
              <label for="username"> <i class="fas fa-user"></i> Username</label>
            </div>
<hr>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input style="border: none;" type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
              <label for="password"><i class="fas fa-lock"></i> Password</label>
            </div>
          </div>


          <input type="submit" class="btn btn-primary btn-block" name="login" value="Login"  style="border:none; background: #4e54c8;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #8f94fb, #4e54c8);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #8f94fb, #4e54c8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
"/>
        </form>

      </div>
    </div>
  </div>
  <script src="../theme/vendor/jquery/jquery.min.js"></script>
  <script src="../theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../theme/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>