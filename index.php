<?php   
session_start();
//error_reporting(0);
include_once("koneksi/koneksi.php");

$id_pegawaiErr = $passwordErr =$captchaErr = "";
$id_pegawai = $password = $captcha = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(!empty($_POST["id_pegawai"] AND $_POST["password"])){
        if(isset($_POST['submit'])){
          $_SESSION["last_login_time"]=time();
          $id_pegawai = $_POST['id_pegawai'];
          $password = MD5($_POST['password']);

          $login = mysqli_query($conn,"SELECT * FROM account WHERE id_pegawai='$id_pegawai' AND password='$password'");

          $cek = mysqli_num_rows($login);

          if($cek > 0){ 
              $data= mysqli_fetch_assoc($login); 

              if($_POST["captcha_code"]==$_SESSION["captcha_code"]){
                  if($data['level']=="manager"){
                    $_SESSION['id_pegawai'] = $id_pegawai;
                    $_SESSION['level'] = "manager";
                    echo "<script>alert('Selamat datang Manager');
                          window.location = 'fungsi/manager/index.php';
                          </script>"; 

                  }else if($data['level']=="karyawan"){
                    $_SESSION['id_pegawai'] = $id_pegawai;
                    $_SESSION['level'] = "karyawan";
                    echo "<script>alert('Selamat datang Karyawan');
                          window.location = 'fungsi/karyawan/index.php';
                          </script>"; 
                  }
            }else{
              echo "<script>alert('Captcha Salah, Ulangi Lagi!');window.location = 'index.php';</script>"; 
            }
          }else{ 
              echo "<script>alert('ID Pegawai atau Password Anda Salah');window.location = 'index.php';</script>"; 
          } 
        }
      }else{ 
          if(empty($_POST["id_pegawai"])){
              $id_pegawaiErr="*ID Pegawai harus diisi";
          }else{
              $id_pegawai=test_input($_POST["id_pegawai"]); 
          }
          if(empty($_POST["password"])){
            $passwordErr="*Password harus diisi";
          }else{
            $password=test_input($_POST["password"]);
          }

          if(empty($_POST["captcha_code"])){
            $captchaErr="*Captcha harus diisi";
          }else{
            $captcha=test_input($_POST["captcha_code"]);
          }
      } 
    }


function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css"> 
    <title>McDonalds-Login</title>
    <style>
      .error {
        color: #ff0000;
      }
    </style>
  </head>
  <body>
 
    <div class="container-fluid" style="height: 100%; margin-top: 100px">
      <div class="card mx-auto p-4 shadow bg-white" style="width: 25rem">
        <img src="asset/logo/logo-1.png" class="card-img-top mx-auto" style="width: 10rem" alt="..." />
        <div class="card-body">
          <form action="" method="POST" class="mt-3">
            <div class="mb-3">
              <label class="form-label">ID PEGAWAI</label>
              <span class="error"><?php echo $id_pegawaiErr;?></span>
              <input type="text" name="id_pegawai" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">PASSWORD</label>
              <span class="error"><?php echo $passwordErr;?></span>
              <input type="password" name="password" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">CAPTCHA</label>
              <span class="error"><?php echo $captchaErr;?></span>
              <div class="mb-3">
                <div class="row">
                  <div class="col-6 pe-0">
                  <img  src="fungsi/captcha.php" alt="">
                  </div>
                  <div class="col-6 ps-0 ms-0">
                  <input type="text" name="captcha_code" placeholder="captcha code" class="form-control">
                  </div>
                </div>
              </div>     
            </div>
            <button type="submit" name="submit"class="btn btn-warning w-100 text-white">SUBMIT</button>
          </form>
        </div>
      </div>
    </div>

<div class="container-fluid">
  <div class="footer text-center">
      <span>Copyright © 2013-2021 <a class="text-decoration-none text-dark" href="https://www.instagram.com/adibbagus_/">Adib Bagus Sudiyono</a></span>
    </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
