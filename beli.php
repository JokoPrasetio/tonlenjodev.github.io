<?php
    session_start();
    //mendapatkan id produk dari url
    $id_produk=$_GET['id'];

    //jika sudah ada produk itu dikeranjang maka jumlahnyadi + 1
    if(isset($_SESSION['keranjang'][$id_produk])){
        $_SESSION['keranjang'][$id_produk]+=1;
    }else{
        $_SESSION['keranjang'][$id_produk]=1;
    }
    
    echo '<script>alert("Produk telah masuk ke keranjang")</script> ';
    echo '<script>location="keranjang.php"</script> ';
?>

