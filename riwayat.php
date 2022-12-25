<?php
session_start();
include 'admin/db.php';

//jika tidak ada session pelanggan atau pelanggan belum login
if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
    echo'<script>alert("Silahkan Login")</script>';
    echo'<script>location="login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>riwayat</title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'menu.php'
    ?>

    <section class="riwayat">
        <div class="container">
            <h3>Riwayat Belanja <?= $_SESSION['pelanggan']['nama_pelanggan'];?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- mendapatkan id pelanggan yang login dari session -->
                    <?php
                    $nomor=1;
                    $id_pelanggan=$_SESSION['pelanggan']['id_pelanggan'];
                    $ambil=mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ");
                    while ($pecah = $ambil->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $nomor;?></td>
                        <td><?= $pecah['tanggal_pembelian']; ?></td>
                        <td>
                            <?= $pecah['status_pembelian'];?><br>
                            <?php if(!empty($pecah['resi_pengiriman'])):?>
                                Resi: <strong><?= $pecah['resi_pengiriman'];?></strong>
                            <?php endif ?>
                        </td>
                        <td>Rp.<?= number_format($pecah['total_pembelian']);?></td>
                        <td>
                            <a href="nota.php?id=<?= $pecah['id_pembelian']?>" class="btn btn-info">Nota</a>
                            
                            <?php if($pecah['status_pembelian']=='pending') :?>
                                
                            <a href="pembayaran.php?id=<?= $pecah['id_pembelian']?>" class="btn btn-success">Pembayaran</a>
                            <?php else : ?>
                            <a href="lihatpembayaran.php?id=<?= $pecah['id_pembelian'];?>" class="btn btn-warning">Lihat Pembayaran</a>
                            <?php endif ?>

                        </td>
                    </tr>
                    <?php $nomor++;?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    
</body>
</html>