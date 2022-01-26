<?php
ob_start();
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
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $fotofunfact = $_FILES['fotofunfact']['name'];
    $idfunfact = $_GET['id'];
    $dir = "../img/funfact/";
    if (!is_dir($dir)) {
        mkdir("../img/funfact/");
    }

    move_uploaded_file($_FILES["fotofunfact"]["tmp_name"], "../img/funfact/" . $_FILES["fotofunfact"]["name"]);
    $sql = mysqli_query($koneksi, "update ap_funfact set judul = '$judul',deskripsi = '$deskripsi',fotofunfact = '$fotofunfact' where id = '$idfunfact'");
    $_SESSION['msg'] = "memperbarui Fun Fact";
}
?>

<?php
$idfunfact = $_GET['id'];
$query = "select * from ap_funfact where id = '$idfunfact' ;";
$query_run = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($query_run);
?>
<div id="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb" style="margin-top: 15px;">
            <li class="breadcrumb-item">
                <a href="index.php">Admin Panel</a>
            </li>
            <li class="breadcrumb-item active">Edit Fun Fact</li>
        </ol>
        <?php if (isset($_POST['submit'])) {
            header("refresh:1; url=tambahFunfact.php");
        ?>
            <div class="alert alert-success mt-4">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Berhasil</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
            </div>
        <?php } ?>
        <form method="post" enctype="multipart/form-data" />
        <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control" required="" name="judul" value="<?php echo $row['judul'] ?>" />
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required="" rows="5"><?php echo $row['deskripsi'] ?></textarea>
        </div>
        <div class="form-group">
            <label>Foto </label>
            <input class="form-control" type="file" name="fotofunfact" />
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Simpan" name="submit" />
        </div>
        </form>
    </div>
</div>
<?php
LoadFooterPanel();
?>