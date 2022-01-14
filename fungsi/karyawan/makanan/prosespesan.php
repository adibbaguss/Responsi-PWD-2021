<?php
include "../../../koneksi/koneksi.php";

error_reporting(0);

if(isset($_POST['submit'])){
    $query = mysqli_query($conn, "SELECT max(order_id) as kodeTerbesar FROM order_food");
    $data = mysqli_fetch_array($query);
    $kodeOrder = $data['kodeTerbesar'];
    
    $urutan = (int) substr($kodeOrder, 6, 3);
    
    $urutan++;
    $huruf = "Order-";
    $kodeOrder = $huruf . sprintf("%03s", $urutan);

    $id_pegawai = $_POST['id_pegawai'];
    
    $tanggal = $_POST['tanggal'];
    $food_id = $_POST['food_id'];
    
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $jumlah_order = count($food_id);

    

    for($x=0;$x<$jumlah_order;$x++){
        $insert_order = "INSERT INTO order_food (order_id, tanggal, id_pegawai) values('$kodeOrder','$tanggal','$id_pegawai')";
        $insert_detail = "INSERT INTO detail_order (food_id, order_id, jumlah_pesan, total_harga) VALUES ('$food_id[$x]', '$kodeOrder', '$jumlah[$x]', '$harga[$x]')";

        mysqli_query($conn, $insert_order);
        mysqli_query($conn, $insert_detail);
    } 
    mysqli_query($conn, "DELETE FROM cache_beli");
}else{
    echo "<script>alert('Gagal menambahkan produk'); window.location = 'index.php'; </script>"; 
}
 
 echo "<script>window.location = 'index.php';</script>";
?>