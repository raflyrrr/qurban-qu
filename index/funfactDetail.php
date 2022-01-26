<?php
session_start();
?>
<?php
$judul = ($_GET['judul']);
require_once '../config/database.php';
require_once '../function/ap.fungsi.php';
require_once '../function/ap.theme.php';
require_once '../function/ap.identitas.situs.php';
LoadHead($nama_situs, $alamat_situs, $deskripsi_situs, $author_situs, $logo_situs);
LoadCss();
if (isset($_SESSION['username'])) {
    LoadMenu($nama_situs, $logo_situs);
} else {
    LoadBody($nama_situs, $logo_situs);
}
?>
<?php $query = "select * from ap_funfact where judul = '$judul' ;";
$query_run = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($query_run);
?>
<div class="container mt-4" style="margin-bottom:25%">
    <div class="row">
        <div class="col">
            <div class="header">
                <h2><?php echo $row['judul']; ?></h2>
            </div>
            <div class="img">
                <img src="../img/funfact/<?php echo $row ['fotofunfact']; ?>" alt="" width="50%">
            </div>
            <hr>
            <div class="desc">
                <p><?php echo $row['deskripsi']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php
LoadFooter($nama_situs);
?>