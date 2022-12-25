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
        <title>Nota Pembelian</title>
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
                <h2>Detail Pembelian</h2>
<?php 
    $ambil=mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.   id_pembelian='$_GET[id]' ");
    $detail=$ambil->fetch_assoc();


?>

<!-- jika data pelanggan yang beli tidak sama dengan pelanggan yang login maka dilarikan ke riwayat  -->
<!-- pelanggan yang beli harus pelanggan yang login -->
<?php 
//mendapatkan id pelanggan yang beli 

$idpelangganyangbeli =$detail['id_pelanggan'];

//mendapatkan id pelanggan yang login 

$idpelangganyanglogin =$_SESSION['pelanggan']['id_pelanggan'];

if($idpelangganyangbeli !== $idpelangganyanglogin){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="riwayat.php"</script>';
}
?>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Pembelian</h3>
                        <strong>No.pembelian:
                            <?= $detail['id_pembelian'];?></strong><br>
                        tanggal:
                        <?= $detail['tanggal_pembelian']; ?><br>
                        Total: Rp.
                        <?= number_format($detail['total_pembelian']);?>
                    </div>
                    <div class="col-md-4">
                        <h3>Pelanggan</h3>
                        <strong><?= $detail['nama_pelanggan'];?></strong><br>
                        <p>
                            <?= $detail['telepon_pelanggan'];?><br>
                            <?= $detail['email_pelanggan'];?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h3>Pengiriman</h3>
                        <strong><?= $detail['nama_pulau'];?></strong><br>
                        Ongkos Kirim: Rp.
                        <?= number_format($detail['tarif']); ?><br>
                        alamat:
                        <?= $detail['alamat'];?>

                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
        $nomor=1;
        $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]' ");
        while($pecah=$ambil->fetch_assoc()){
        ?>
                        <tr>
                            <td><?= $nomor; ?></td>
                            <td><?= $pecah['nama']?></td>
                            <td>Rp
                                <?= number_format($pecah['harga'])?></td>
                            <td><?= $pecah['jumlah']?></td>
                            <td>
                                Rp.<?= number_format($pecah['subharga']); ?>
                            </td>
                        </tr>
                        <?php $nomor++;?>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-7">
                        <div class="alert alert-info">
                            <p>
                                Silahkan melakukan pembayaran Rp.
                                <?= number_format($detail['total_pembelian']);?>
                            </p>
                            <strong>BANK BRI ********* an.Joko Prasetio</strong>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </body>
</html>