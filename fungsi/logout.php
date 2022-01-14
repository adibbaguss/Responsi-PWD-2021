<?php 
// mengaktifkan session
session_start();
 
// menghapus semua session
session_destroy();
 
// mengalihkan halaman sambil mengirim pesan logout
echo "<script>alert('Anda Berhasil Logout');
window.location = '../index.php';
</script>";
?>