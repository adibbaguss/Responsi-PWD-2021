<?php  
    $conn = mysqli_connect("localhost","root","","db_restaurant");

    if(!$conn){
        echo "Error:".mysqli_connect_error();
            exit();
    }

    
	function rp($angka){
        $rupiah="Rp ".number_format($angka,0,',','.').",00";
        return $rupiah;
    }

    //mengaecek kode terbesar utuk food
    $url_kode = "http://localhost/Responsi-PWD-2021/webservice/food_item/create/kodeterbesar.php";

    //url_table katergori
     $url_kategori = "http://localhost/Responsi-PWD-2021/webservice/kategori/";

     //get_transaksi
     $url_transaksi = "http://localhost/Responsi-PWD-2021/webservice/order/";
     //get_account
     $url_account = "http://localhost/Responsi-PWD-2021/webservice/account/";
     //get_data makanan
    $url_data_makanan ="http://localhost/Responsi-PWD-2021/webservice/food_item/";

    // get data transaksi
    $url_print_transaksi ="http://localhost/Responsi-PWD-2021/webservice/print/transaksi/";
    // print makanan
    $url_print_food = "http://localhost/Responsi-PWD-2021/webservice/print/food/";

    // print makanan
    $url_print_account = "http://localhost/Responsi-PWD-2021/webservice/print/account/";

?>