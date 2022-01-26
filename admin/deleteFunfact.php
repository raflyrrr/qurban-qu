<?php
	include '../config/database.php';
    $id = $_GET['id'];
    $delete="DELETE FROM ap_funfact where id=$id";
    mysqli_query($koneksi,$delete);
    header("location:lihatFunfact.php");
?>