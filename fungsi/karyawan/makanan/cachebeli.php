<?php
include "../../../koneksi/koneksi.php";

if(isset($_POST['submit'])){
    $food_id = $_POST['food_id'];
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $total_harga = ($jumlah * $harga);

    $sql_insert = "INSERT INTO cache_beli (food_id, nama, jumlah_beli, harga_total)VALUES ('$food_id','$nama', '$jumlah', '$total_harga')";
    mysqli_query($conn, $sql_insert);
    }else{
    echo "<script>alert('Gagal menambahkan produk'); window.location = 'index.php'; </script>"; 
    }
    echo "<script>window.location = 'index.php';</script>";
?>