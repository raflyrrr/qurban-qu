<?php
require_once '../function/ap.session.php';
session_start();
if (SessionAdminCek()) {
  header("location:log-in.php");
} else {

  SessionActiveAdmin();
  $id = $Adminarray[0];
  $nama = $Adminarray[1];
  $email = $Adminarray[2];
  $username = $Adminarray[3];
  $level = $Adminarray[4];
}

?>
<?php
require_once '../config/database.php';
require_once '../function/ap.admin.php';
require_once '../function/ap.theme.php';
LoadHeadPanel();
LoadCssPanel();
LoadMenuPanel();
$tanggal_buat = TampilTanggal();


?>
<?php
$nama_produk = $deskripsi_produk = $jenis_produk = $satuan_produk = $stok_produk = $harga_produk  =  $stok_produk =  $hargapotong = $foto_produk = $simpan = "";

$nama_produk_err = $deskripsi_produk_err = $satuan_produk_err = $jenis_produk_err = $harga_produk_err =  $stok_produk_err  = $hargapotong_err =$foto_produk_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty(trim($_POST['nama_produk']))) {
    $nama_produk_err = "Nama produk harus tidak boleh kosong";
  } else {
    $nama_produk = FilterInput($_POST['nama_produk']);
    $nama_produk = EscapeString($nama_produk);
  }
  if (empty(trim($_POST['deskripsi_produk']))) {
    $deskripsi_produk_err = "Deskripsi produk tidak boleh di kosongkan";
  } elseif (strlen($_POST['deskripsi_produk']) < 10) {
    $deskripsi_produk_err = "Deskripsi produk tidak boleh kurang dari 10 karakter";
  } else {
    $deskripsi_produk = FilterInput($_POST['deskripsi_produk']);
    $deskripsi_produk = EscapeString($deskripsi_produk);
  }
  if (empty(trim($_POST['jenis_produk']))) {
    $jenis_produk_err = "Jenis produk tidak boleh kosong";
  } else {
    $jenis_produk = FilterInput($_POST['jenis_produk']);
    $jenis_produk = EscapeString($jenis_produk);
  }
  if (empty(trim($_POST['harga_produk']))) {
    $harga_produk_err = "Harga produk tidak boleh kosong";
  } elseif (ValidateNumber($_POST['harga_produk'])) {
    $harga_produk_err = "Harga produk hanya boleh diisi dengan format number";
  } else {
    $harga_produk = FilterInput($_POST['harga_produk']);
    $harga_produk = EscapeString($harga_produk);
  }
  if (empty(trim($_POST['satuan_produk']))) {
    $satuan_produk_err = "Jenis satuan produk tidak boleh di kosongkan";
  } else {
    $satuan_produk = FilterInput($_POST['satuan_produk']);
    $satuan_produk = EscapeString($satuan_produk);
  }
  if (empty(trim($_POST['stok_produk']))) {
    $stok_produk_err = "Stok produk tidak boleh kosong";
  } elseif (ValidateNumber($_POST['stok_produk'])) {
    $stok_produk_err = "Stok produk hanya boleh diisi karakter number";
  } else {
    $stok_produk = FilterInput($_POST['stok_produk']);
    $stok_produk = EscapeString($stok_produk);
  }
  if (empty(trim($_POST['hargapotong']))) {
    $hargapotong_err = "Harga potong ditempat tidak boleh di kosongkan";
  } else {
    $hargapotong = FilterInput($_POST['hargapotong']);
    $hargapotong = EscapeString($hargapotong);
  }
  /*
      validasi foto produk
      
      */
  $FileName = $_FILES['foto_produk']['name'];
  $FileDir = $_FILES['foto_produk']['tmp_name'];
  $FileSize = $_FILES['foto_produk']['size'];
  $FileDestination = '../img/produk/';
  $FileExtension = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
  $FileValid = array('jpeg', 'jpg', 'png');
  $FileItem = rand(100, 1000000) . "." . $FileExtension;

  if (in_array($FileExtension, $FileValid)) {
    if ($FileSize > 2000000) {
      $foto_produk_err = "Foto produk tidak boleh lebih dari 2MB";
    } else {
      $foto_produk = $FileDir;
    }
  } else {
    $foto_produk_err = "Ektensi foto produk tidak sesuai, pilih file format jpeg, jpg atau png";
  }
  if (empty($nama_produk_err) && empty($deskripsi_produk_err) && empty($jenis_produk_err) && empty($harga_produk_err) && empty($satuan_produk_err) && empty($stok_produk_err) && empty($hargapotong_err) && empty($foto_produk_err)) {

    if (InsertProduk($nama, $nama_produk, $deskripsi_produk, $jenis_produk, $harga_produk, $satuan_produk, $stok_produk, $hargapotong, $foto_produk, $tanggal_buat)) {
      $simpan = "<div class='alert alert-success'>Produk berhasil ditambahkan</div>";
      echo "<meta http-equiv=\"refresh\"content=\"1;URL=produk.tambah.php\"/>";
    } else {
      $simpan = "<div class='alert alert-danger'>Produk gagal ditambahkan</div>";
    }
  }
}
?>

<div id="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb" style="margin-top: 15px;">
      <li class="breadcrumb-item">
        <a href="index.php">Admin Panel</a>
      </li>
      <li class="breadcrumb-item active">Tambah Hewan</li>
    </ol>
    <?php echo $simpan; ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" />
    <div class="form-group">
      <label>Nama Hewan</label>
      <input type="text" class="form-control" required="" name="nama_produk" value="<?php echo $nama_produk; ?>" placeholder="Masukan nama Hewan" />
      <span style="color: red;"><?php echo $nama_produk_err; ?></span>
    </div>
    <div class="form-group">
      <label>Deskripsi Hewan</label>
      <textarea name="deskripsi_produk" class="form-control" required="" rows="5"><?php echo $deskripsi_produk; ?></textarea>
      <span style="color: red;"><?php echo $deskripsi_produk_err; ?></span>
    </div>
    <div class="form-group">
      <label>Jenis Hewan</label>
      <select class="form-control" name="jenis_produk" required="">
        <?php
        $TampilJenisProduk = TampilJenisProduk();
        while ($row = $TampilJenisProduk->fetch_array()) {
        ?>

          <option value="<?php echo $row['jenis_produk']; ?>"><?php echo $row['jenis_produk']; ?></option>
        <?php }

        $TampilJenisProduk->free_result();
        ?>

      </select>
      <span style="color: red;"><?php echo $jenis_produk_err; ?></span>
    </div>
    <div class="form-group">
      <label>Harga Hewan</label>
      <input type="text" class="form-control" name="harga_produk" required="" value="<?php echo $harga_produk; ?>" />
      <span style="color: red;"><?php echo $harga_produk_err; ?></span>
    </div>
    <div class="form-group">
      <label>Harga Potong Ditempat</label>
      <input type="number" class="form-control" name="hargapotong" required="" value="<?php echo $hargapotong; ?>" />
      <span style="color: red;"><?php echo $hargapotong_err; ?></span>
    </div>
    <div class="form-group">
      <label>Berat</label>
      <input type="text" class="form-control" name="satuan_produk" required="" value="<?php echo $satuan_produk; ?>" />
      <span style="color: red;"><?php echo $satuan_produk_err; ?></span>
    </div>
    <div class="form-group">
      <label>Stok</label>
      <input type="text" class="form-control" name="stok_produk" required="" value="<?php echo $stok_produk; ?>" />
      <span style="color: red;"><?php echo $stok_produk_err; ?></span>
    </div>
    <div class="form-group">
      <label>Foto </label>
      <input class="form-control" type="file" name="foto_produk" />
      <span style="color: red;"><?php echo $foto_produk_err; ?></span>
    </div>
    <div class="form-group">
      <input class="btn btn-default" type="submit" name="kirim" value="Simpan" />
    </div>
    </form>
  </div>
</div>
<?php
LoadFooterPanel();
?>