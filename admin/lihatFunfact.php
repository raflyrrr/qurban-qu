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



<div id="content-wrapper">
    <div class="container-fluid">
        <h4>Fun Fact</h4>
        <br />
        <a title="Tambah Jenis Produk" href="tambahFunfact.php" class="btn btn-sm btn-primary"><i class="fas fa-shopping-cart"></i> Tambah Fun Fact</a>
        <br />
        <br />
        <div class="table-responsive">
            <table width="100%"" class=" table table-sthiped table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $query = "select * from ap_funfact;";
                $query_run = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                    <tr>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><img src="../img/funfact/<?php echo $row['fotofunfact']; ?>" alt="" width="150px"></td>
                        <td>
                            <a title="Edit Fun Fact" href="editFunfact.php?id=<?php echo $row['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                            <a title="Delete Fun Fact" href="deleteFunfact.php?id=<?php echo $row['id']; ?>" onClick='alert("Fun Fact berhasil dihapus")'><i class="fas fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
        </div>
    </div>
    <?php
    LoadFooterPanel();
    ?>