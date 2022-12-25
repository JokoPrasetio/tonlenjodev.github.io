<?php 
    session_start();
    include 'admin/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tonlen Jodev</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
      <!-- navbar -->
    <?php
    include 'menu.php'; 
    ?>
    <!-- banner website  -->
    <div class="jumbotron"></div>

    <!-- konten -->
    <section class="konten">
        <div class="container">
            <h1>Produk Terbaru</h1>
            <div class="row">

            <?php $ambil=mysqli_query($koneksi, "SELECT * FROM produk");
            if(mysqli_num_rows($ambil)>0){
                    while($perproduk=$ambil->fetch_assoc()){
             ?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="fotoproduk/<?= $perproduk['foto_produk'];?>" alt="<?= $perproduk['foto_produk'];?>">
                        <div class="caption">
                            <h3><?= $perproduk['nama_produk'];?></h3>
                            <h5>Rp. <?= number_format($perproduk['harga_produk']);?></h5>
                            <a class="btn btn-primary" href="beli.php?id=<?= $perproduk['id_produk'];?>">Beli</a>
                            <a href="detail.php?id=<?=$perproduk['id_produk'];?>" class="btn btn-default">Detail</a>
                        </div>
                    </div>
                </div>
                    <?php } } else { ?>
                        <h style="text-align:center;"> Tidak ada Produk</h>
                    <?php }?> 
            </div>
        </div>
    </section>
    <footer class="bg-white bg-light fw-bold text-center mt-3">
  <p>created by<i class="bi bi-balloon-heart-fill text-danger footer-"></i> <a href="">Joko Prasetio</a></p>
</footer>
</body>

</html>