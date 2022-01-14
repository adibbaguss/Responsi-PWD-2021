<?php   
session_start();
//error_reporting(0);
include_once("../../../koneksi/koneksi.php");


// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
  echo "<script>alert('Anda gagal masuk! Silahkan coba lagi ');window.location = '../../../index.php';</script>"; 
}else if($_SESSION['level']!="manager"){
  echo "<script>alert('Anda gagal masuk! Silahkan coba lagi'); window.location = '../../../index.php'; </script>"; 
}else{
 
  if((time()-$_SESSION["last_login_time"])>360000){
    echo "<script>window.location = '../../logout.php'; </script>"; 
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
    <link rel="stylesheet" href="../../../css/style.css"/>
    <link rel="stylesheet" href="../../../css/style1.css" />
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../fontawesome-free-5.15.4-web/css/all.css" />
    <title>McDonalds-Manager</title>
  </head>
  <body>
    <!-- navbar -->
     <!-- navbar -->
     <nav class="navbar navbar-expand-lg navbar-light navbar-inverse bg-light ms-0 shadow-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../../../asset/logo/logo-1.png" alt="" width="50"  />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link " aria-current="page" href="../index.php">Home  <i class="fa fa-home"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../makanan/index.php">Makanan <i class="fas fa-hamburger"></i></a>
            </li>
            <li class="nav-item">
                <a  class="nav-link active" href="../account-karyawan/index.php">Karyawan <i class="fas fa-user"></i></a>
            </li>
            <li class="nav-item">
                <a  class="nav-link " href="../transaksi/index.php">Transaksi <i class="fas fa-clipboard-list"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../logout.php">Log Out <i class="fa fa-sign-out-alt"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->
    <?php
        if(isset($_GET['id_pegawai'])){
            $id_pegawai = $_GET['id_pegawai'];
            $data = mysqli_query($conn,"SELECT * FROM account WHERE id_pegawai ='$id_pegawai'");
            while($update = mysqli_fetch_array($data)){
    ?>
    <!-- konten -->
    <div class="container p-5">
      <div class="form bg-white w-75 p-4 mx-auto rounded shadow">
        <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">ID Pegawai</label>
            <input type="text" name="id_pegawai" class="form-control" value="<?= $update['id_pegawai'];?>" readonly/>
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" value="<?= $update['nama_pegawai'];?>" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="level" id="" class="form-control">
            <option  value="<?= $update['level'];?>"><?= $update['level'];?></option>
                <option value="karyawan">karyawan</option>
                <option value="admin">Admin</option>
            </select>
          </div>
          <!-- <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" value="<?= $update['password'];?>" required />
          </div> -->
          <div class="d-grid my-3">
            <button type="submit" name="submit" class="btn btn-warning">UPDATE</button>
          </div>
        </form>
      </div>
    </div>

    <?php
                }
            }else{
              echo "<script>alert('Data tidak tersedia'); window.location = 'index.php'; </script>"; 
            }
    ?>
    <!-- end konten -->
    <?php 
        if(isset($_POST['submit'])){
            $id_pegawai = $_POST['id_pegawai'];
            $nama_pegawai = $_POST['nama_pegawai'];
            $level = $_POST['level'];
            
            $sql_update = "UPDATE account SET nama_pegawai='$nama_pegawai', level='$level' WHERE id_pegawai='$id_pegawai'";
            mysqli_query($conn, $sql_update);
            
            echo "<script>alert('Berhasil mengedit data'); window.location = 'index.php'; </script>"; 
        }
    ?>
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
