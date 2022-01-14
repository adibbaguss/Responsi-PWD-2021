<?php   
session_start();
error_reporting(0);
include_once("../../koneksi/koneksi.php");

// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
  echo "<script>alert('Anda gagal masuk! Silahkan coba lagi ');window.location = '../../index.php';</script>"; 
}else if($_SESSION['level']!="karyawan"){
  echo "<script>alert('Anda gagal masuk! Silahkan coba lagi'); window.location = '../../index.php'; </script>"; 
}else{
 
  if((time()-$_SESSION["last_login_time"])>6000){
    echo "<script>window.location = '../logout.php'; </script>"; 
  }else{
    $_SESSION["last_login_time"] = time();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/style1.css" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../fontawesome-free-5.15.4-web/css/all.css" />
    <title>McDonalds-Karyawan</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-inverse bg-light ms-0 shadow-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../../asset/logo/logo-1.png" alt="" width="50"  />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home  <i class="fa fa-home"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="makanan/index.php">Makanan <i class="fas fa-hamburger"></i></a>
            </li>
            <li class="nav-item">
                <a  class="nav-link " href="transaksi/index.php">Transaksi <i class="fas fa-clipboard-list"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">Log Out <i class="fa fa-sign-out-alt"></i></a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- cek akun -->



    <!-- konten -->
    <div class="container">
      
      <div class="row mt-5">
        <div class="col-sm-12 mb-2">
          <div class="d-flex justify-content-end">
          <?php 
          date_default_timezone_set('Asia/Jakarta');
          echo date("D, d-M-Y   H:i:s"); ?>
          </div>
        </div>
        <!-- col baris 1 -->
        <div class="col-12 mb-4">
          <div class="card width-200 text-center">
            <div class="card-header bg-warning text-white fs-3">SELAMAT BEKERJA :)</div>
            <div class="card-body">
              <?php
              $id = $_SESSION['id_pegawai'];
              $sql =mysqli_query($conn,"SELECT * FROM account WHERE id_pegawai = '$id'");
              while ($data = mysqli_fetch_assoc($sql)) {
                echo "<div class='text-home fw-bold'>".strtoupper($data['nama_pegawai'])."</div>";
                # code...
              }
              ?>
              
            </div>
          </div>
        </div>
        <!-- end col baris 1 -->
    
    </div>
    <!-- end konten -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>

  <?php
    }
  }
  ?>
</html>
