<?php
    session_start();
    include 'admin/db.php';

    // jika tidak ada sesession pelanggan
    if(!isset($_SESSION['pelanggan'])){
        echo'<script>alert("Login terlebih dahulu")</script>';
        echo'<script>location="login.php"</script>';
    }

    if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
        echo'<script>alert("silahkan belanja terlebih dahulu")</script>';
        echo'<script>location="index.php"</script>';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- navbar -->
<?php 
    include 'menu.php';
?>
   
    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1><hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                    <!-- menampilkan produk yang sedng diperulang -->
                    <?php 
                    
                    $ambil=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $pecah=$ambil->fetch_assoc();
                    $subharga=$pecah['harga_produk']*$jumlah;
                    ?>
                    <pre><?php print_r($pecah); ?></pre>
                    <tr>
                        <td><?= $nomor ;?></td>
                        <td><?= $pecah['nama_produk'];?></td>
                        <td>Rp.<?= number_format($pecah['harga_produk']);?></td>
                        <td><?= $jumlah; ?></td>
                        <td>Rp.<?= number_format($subharga);?></td>
                        <td><a href="hapus.php?id=<?= $id_produk ;?>" class="btn btn-danger btn-xs">hapus</a></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
        </div>
    </section>
    

</body>
</html>