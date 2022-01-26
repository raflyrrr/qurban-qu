<?php
session_start();
?>
<?php
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
<div class="container mt-4" style="margin-bottom: 25%;">
    <h3 style="margin-bottom: 25px;">Fun Fact</h3>
    <div class="row">
        <?php $query = "select * from ap_funfact;";
        $query_run = mysqli_query($koneksi, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
        ?><div class="col-lg-3 col-md-5 col-sm-7 mb-4" data-aos="fade-up">
                <div class="card" style="width: 16rem;">
                    <img src="../img/funfact/<?php echo $row['fotofunfact'] ?> " class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="funfactDetail.php?judul=<?php echo $row['judul'] ?>" class="stretched-link" style="text-decoration: none;"><?php echo $row['judul'] ?></a>
                    </div>
                </div>
            </div><?php } ?>
    </div>
</div>
<?php
LoadFooter($nama_situs);
?>