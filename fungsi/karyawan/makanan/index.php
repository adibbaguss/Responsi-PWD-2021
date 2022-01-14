<?php   
session_start();
// error_reporting(0);
include_once("../../../koneksi/koneksi.php");

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
    <link rel="stylesheet" href="../../../css/style.css"/>
    <link rel="stylesheet" href="../../../css/style1.css" />
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../fontawesome-free-5.15.4-web/css/all.css" />
    <title>McDonalds-Karyawan</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-inverse bg-light ms-0">
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
              <a class="nav-link active" href="../makanan/index.php">Makanan <i class="fas fa-hamburger"></i></a>
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
    $id = $_SESSION['id_pegawai'];
    $sql =mysqli_query($conn,"SELECT * FROM account WHERE id_pegawai = '$id'");
    while ($data = mysqli_fetch_assoc($sql)) {
      echo "<div class='bg-warning'>".$data['id_pegawai']."/ ".$data['level']."/ ".$data['nama_pegawai']."/ ".$data['password']."</div>";
      # code...
    }
    ?>
    <!-- konten -->
    <div class="container-fluid mt-3">
        <div class="d-flex mb-2 mx-2">
            <form action="#" class="d-flex ms-auto">
                <input type="text" name="search" class="form-control">
                <button  class="btn btn-primary px-4 ms-2">Cari</button>
            </form>
        </div>
      <div class="row">
        <div class="col-8">
        <div class="row mt-4 ">
        <?php
            if(isset($_GET['search'])){
              $get_url = $url_data_makanan."?search=".($_GET['search']);
              }else{
                $get_url = $url_data_makanan;
              }
              $client = curl_init($get_url);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
              $response = curl_exec($client);
              $result = json_decode($response);
              foreach ($result as $r) { 
          ?>
            <div class="col-4 mb-5">
              <div class="food">
                <div class="d-flex justify-content-center">
                  <div class="card" style="width:18rem;">
                    <img class="card-img-top" src="../../../asset/img/food/<?= $r->foto;?>"  alt="">
                    <div class="card-body text-center py-0">
                        <h6 class="card-tittle fw-bold my-0">
                          <?= $r -> nama;?>
                        </h6>
                        <div class="navbar-toggler pb-1 pt-0" type="button" data-bs-toggle="collapse" data-bs-target="#<?=  $r->food_id; ?>" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <div class="text-center">
                            <span><i class="fas fa-sort-down text-secondary opacity-25 fs-2"></i></span>
                          </div>
                        </div>
  
                        <div class="collapse navbar-collapse mt-1" id="<?=$r->food_id; ?>">
                          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-white">
                            <div class="d-grid">
                              <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#Modal<?=$r->food_id;?>">
                                TAMBAH
                              </button>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="Modal<?=$r->food_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title text-black" id="exampleModalLabel">Tambah <?=$r->nama;?></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="cachebeli.php" method="POST">
                                      <div class="modal-body">
                                        <input type="hidden" name="food_id" value="<?= $r -> food_id;?>">
                                        <input type="hidden" name="nama" value="<?= $r -> nama;?>">
                                        <input type="hidden" name="harga" value="<?= $r -> harga;?>">
                                        <label class="text-black font-weight-bold">Masukkan Jumlah Pembelian</label>
                                        <input type="number" name="jumlah" value="1" min="1" max="50" class="col-12">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                      <button type="submit" name="submit" class="btn btn-warning">Simpan</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>


                            </div>
                          </ul>
                        </div>  
                    </div>
                </div>
                </div>
              </div>
            </div>
            <!-- Button trigger modal -->
              <?php
            }
            ?>
        </div>
        </div>

        <div class="col-4">
            <div class="card mt-4 position-sticky">
              <form action="prosespesan.php" method="POST">
                <div class="card-body">
                  <h5 class="card-tittle"></h5>
                 
                    <?php
                        $id_pegawai = $_SESSION['id_pegawai'];
                        $get_cache = "SELECT * FROM cache_beli";
                        $query = mysqli_query($conn,$get_cache);
                        $total_bayar =0;
                        while ($row = mysqli_fetch_assoc($query)) {
                       
                    ?>
                    <div class="card px-2 py-2 mb-2">
                      <div class="row">
                        <div class="col-5 my-auto">
                          <?=$row["nama"];?>
                        </div>
                        <div class="col-1 my-auto">
                          <?=$row["jumlah_beli"];?>
                        </div>
                        <div class="col-4 my-auto">
                          <?=rp($row["harga_total"]);?>
                        </div>
                        <div class="col-1 my-auto px-2">
                          <a href="delete_cache.php?id_cache=<?=$row["id_cache"];?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </div>
                      </div>
                    </div>
                  
                    <input type="hidden" name="food_id[]"  value="<?=$row["food_id"];?>">
                    <input type="hidden" name="jumlah[]"  value="<?=$row["jumlah_beli"];?>">
                    <input type="hidden" name="harga[]"  value="<?=$row["harga_total"];?>">
                      <?php 
                      

                      $total_bayar = $total_bayar + $row["harga_total"]; ?>
                    <?php
                        }
                    ?>
                 
                  </div>
                  <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d"); ?>">
                  <input type="hidden" name="id_pegawai"  value="<?=$id_pegawai;?>" >
                  <div class="d-grid p-3">
                    <div class="text fs-5 fw-bold mb-3 ms-auto">TOTAL : <?=rp($total_bayar) ;?></div>
                    <button class="btn btn-warning" type="submit" name="submit">PESAN SEKARANG</button>
                  </div>
              </form>
              </div>
        </div>
          
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
