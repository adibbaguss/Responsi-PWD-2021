<?php
require_once("../../../koneksi/koneksi.php");

if (isset($_GET['id_pegawai'])) {
    $id_pegawai = $_GET['id_pegawai'];

    $sql_delete = "DELETE FROM account  WHERE id_pegawai='$id_pegawai'";
    mysqli_query($conn, $sql_delete);

    echo "<script>alert('Berhasil menghapus data ".$id_pegawai."'); window.location = 'index.php'; </script>"; 
}else{
    echo "<script>alert('Gagal menghapus data ".$id_pegawai."'); window.location = 'index.php'; </script>"; 
}
?>