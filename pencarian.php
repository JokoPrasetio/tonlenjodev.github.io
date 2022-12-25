<?php
include 'admin/db.php';

$keyword=$_GET['keyword'];

$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM produk WHERE nama_produk OR deskripsi_produk LIKE '%$keyword%' ");
while ($pecah=$ambil->fetch_assoc()) {
    
    $semuadata[]=$pecah;
}

// echo '<pre>';
    // print_r($semuadata);
// echo'</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container">
        <h1>Hasil Pencarian <?= $keyword; ?></h1>

        <?php if(empty($semuadata)) : ?>
            <div class="alert alert-danger"><strong><?= $keyword; ?></strong> Pencarian Tidak Ditemukan</div>
        <?php endif ?>

    <div class="row">

        <?php foreach ($semuadata as $key => $value): ?>
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="fotoproduk/<?= $value['foto_produk'];?>" class="img-responsive" alt="">
                <div class="caption">
                    <h3><?= $value['nama_produk']; ?></h3>
                    <h5>Rp. <?= number_format($value['harga_produk']);?></h5>
                    <a class="btn btn-primary" href="beli.php?id=<?= $value['id_produk'];?>">Beli</a>
                    <a href="detail.php?id=<?=$value['id_produk'];?>" class="btn btn-default">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>

    </div>
    </div>
</body>
</html>