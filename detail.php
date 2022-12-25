<?php
session_start(); 
include 'admin/db.php';

//mendapatkan idproduk dari url
$idproduk=$_GET['id'];
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$idproduk' ");
$detail=$ambil->fetch_assoc();
?>
<!-- <pre> -->
    <?php //print_r($detail); ?>
<!-- </pre> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail produk</title>
     <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    
    include 'menu.php';

    ?>
    <section class="konten">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="fotoproduk/<?=$detail['foto_produk'];?>" alt="<?=$detail['foto_produk'];?>" class="img-responsive">
                </div>
                <div class="col-md-6">
                    <h2><?= $detail['nama_produk'];?></h2>
                    <h4><?= number_format($detail['harga_produk']);?></h4>
                    <h5>Stok: <strong><?= $detail['stok_produk'];?></strong></h5>
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah" max="<?=$detail['stok_produk'];?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary " name="beli">Beli</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php 
                        if (isset($_POST['beli'])) {
                            //mendapatkan jumlah yang di input
                            $jumlah=$_POST['jumlah'];
                            //masukan di keranjang belanja
                            $_SESSION['keranjang'][$idproduk]=$jumlah;
                            echo'<script>alert("Produk sudah masuk keranjang")</script>';
                            echo'<script>location="keranjang.php"</script>';

                        }
                    ?>
                    <p><?= $detail['deskripsi_produk'];?></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>