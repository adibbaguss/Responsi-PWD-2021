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
 
  if((time()-$_SESSION["last_login_time"])>3600000){
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
    <link rel="stylesheet" href="../../../css/style.css" />
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../fontawesome-free-5.15.4-web/css/all.css" />
    <title>McDonalds-Manager</title>
  </head>
  <body>
    <!-- navbar -->
     <!-- navbar -->
     <nav class="navbar navbar-expand-lg navbar-light navbar-inverse bg-light ms-0 shadow-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php">
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
                <a  class="nav-link " href="../account-karyawan/index.php">Karyawan <i class="fas fa-user"></i></a>
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
        // $id = $_SESSION['id_pegawai'];
        // $sql =mysqli_query($conn,"SELECT * FROM account WHERE id_pegawai = '$id'");
        // while ($data = mysqli_fetch_assoc($sql)) {
        //     echo "<div class='bg-warning'>".$data['id_pegawai']."/ ".$data['level']."/ ".$data['nama_pegawai']."/ ".$data['password']."</div>";
        //     # code...
        // }


          // mengambil kode
        $kode = curl_init($url_kode);
        curl_setopt($kode, CURLOPT_RETURNTRANSFER, 1);
        $res_kode = curl_exec($kode);
        $result_kode = json_decode($res_kode);

        foreach ($result_kode as $r_kode) {
          $kodeBarang = $r_kode -> kodeTerbesar;
          
          $urutan = (int) substr($kodeBarang, 5, 3);
            
          $urutan++;
          $huruf = "Food-";
          $kodeBarang = $huruf . sprintf("%03s", $urutan);
        }
    ?>
    <!-- konten -->
    <div class="container p-5">
      <div class="form bg-white w-75 p-4 mx-auto rounded shadow">
        <form method="POST" enctype="multipart/form-data" action="">
          <div class="mb-3">
            <label class="form-label">Food ID</label>
            <input type="text" name="food_id" class="form-control" value="<?= $kodeBarang;?>" readonly />
          </div>
          <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control"  required />
          </div>
          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"  required />
          </div>
          <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="jumlah" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="id_kategori"  class="form-control">
              <?php
                $kat= curl_init($url_kategori);
                curl_setopt($kat, CURLOPT_RETURNTRANSFER, 1);
                $res_kat = curl_exec($kat);
                $result_kat = json_decode($res_kat);
                foreach ($result_kat as $r_kat) { 
                ?>
              <option value="<?= $r_kat -> id_kategori ;?>"><?= $r_kat -> kategori ;?></option>
              <?php
                }
              ?>
            </select>
          </div>
          <div class="d-grid my-3">
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- end konten -->

    <!-- php tambah data -->
<?php 
  if(isset($_POST['submit'])){
      $food_id = $_POST['food_id'];
      $nama = $_POST['nama'];
      $jumlah = $_POST['jumlah'];
      $harga = $_POST['harga'];
      $id_kategori = $_POST['id_kategori'];


      $rand = rand();
      $ekstensi =  array('png','jpg','jpeg');
      $filename = $_FILES['foto']['name'];
      $ukuran = $_FILES['foto']['size'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if(!in_array($ext,$ekstensi) ) {
    echo "<script>alert('ekstensi tidak mendukung!!<br> silahkan gunakan ekstensi png/jpg/jpeg '); window.location = 'create.php'; </script>"; 
      }else{
          if($ukuran < 1044070){		
              $xx = $rand.'_'.$filename;
              move_uploaded_file($_FILES['foto']['tmp_name'], '../../../asset/img/food/'.$rand.'_'.$filename);
              $sql_insert = "INSERT INTO food_item VALUES ('$food_id', '$nama', '$jumlah', '$harga', '$id_kategori', '$xx')";
              mysqli_query($conn, $sql_insert);
              echo "<script>alert('Berhasil menambahkan produk'); window.location = 'index.php'; </script>"; 
          }else{
          echo "<script>alert('Gagal menambahakan data<br>silahkan input dengan ukurana  < 1 MB'); window.location = 'create.php'; </script>"; 
          }
      }
  }
?>



    <!-- end php tambah data -->

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
