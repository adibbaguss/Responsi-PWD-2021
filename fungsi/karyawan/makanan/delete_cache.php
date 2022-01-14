<?php
    require_once("../../../koneksi/koneksi.php");

    if (isset($_GET['id_cache'])) {
        $id_cache = $_GET['id_cache'];

        $sql_delete = "DELETE FROM cache_beli WHERE id_cache='$id_cache'";
        mysqli_query($conn, $sql_delete);

        echo "<script> window.location = 'index.php'; </script>"; 
    }else{
        echo "<script>alert('Gagal menghapus data'); window.location = 'index.php'; </script>"; 
    }
?>