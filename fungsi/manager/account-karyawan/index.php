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

    <!-- konten -->
    <div class="container mt-3">
        <!-- button -->
        <div class="d-flex">
        <a href="create.php" class="btn btn-success px-3 mb-1 mb-2"><i class="fas fa-user-plus"></i></a>
        <a href="<?=$url_print_account;?>" class="btn btn-primary px-3 ms-1 mb-2"><i class="fas fa-print"></i></a>
        
        <div class="search ms-auto">
            <form action="#" class="d-flex ms-auto">
                <input type="text" name="search" class="form-control">
                <button  class="btn btn-primary px-4 ms-2">Cari</button>
            </form>
        </div>
      </div>
        <div class="card">
            <table class="table table-hover table-striped bg-white">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Username</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Opsi</th>
                  </tr>
                </thead>
                <tbody >

                <?php
                     $no=0;
                    if(isset($_GET['search'])){
                      $get_url = $url_account."?search=".($_GET['search']);
                      }else{
                        $get_url = $url_account;
                      }
                      $client = curl_init($get_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
                      $response = curl_exec($client);
                      $result = json_decode($response);
                      foreach ($result as $r) { 
                        $no++;
                  ?>
                      <th><?= $no;?></th>
                      <th><?=$r->nama_pegawai;?></th>
                      <th><?=$r->id_pegawai?></th>
                      <th><?=$r->level;?></th>
                      <th class="d-flex justify-content-start">
                        <a href="update.php?id_pegawai=<?=$r->id_pegawai;?>" class="mx-1"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id_pegawai=<?=$r->id_pegawai;?>"  class="mx-1"><i class="fas fa-trash text-danger"></i></a>
                    </th>
                  </tr>
                  <?php   
                    }
          
                  ?>
                </tbody>
              </table>
        </div>
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
