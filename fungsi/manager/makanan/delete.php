<?php
    require_once("../../../koneksi/koneksi.php");

    if (isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];

        $sql_delete = "DELETE FROM food_item  WHERE food_id='$food_id'";
        mysqli_query($conn, $sql_delete);

        echo "<script>alert('Berhasil menghapus data ".$food_id."'); window.location = 'index.php'; </script>"; 
    }else{
        echo "<script>alert('Gagal menghapus data ".$food_id."'); window.location = 'index.php'; </script>"; 
    }
?>