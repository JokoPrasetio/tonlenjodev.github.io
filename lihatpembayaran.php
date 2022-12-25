<?php 
session_start();
include 'admin/db.php';

$idpembelian=$_GET['id'];

//echo $idpembelian;
$ambil=mysqli_query($koneksi, "SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembelian.id_pembelian='$idpembelian' ");
$detbay=$ambil->fetch_assoc();

// echo '<pre>';
// print_r ($detbay);
// echo '</pre>';

//#1 validasi pertama jika belum ada pembayaran
if(empty($detbay)){
    echo'<script>alert("Tidak Diketahui")</script>';
    echo'<script>location="riwayat.php"</script>';
}

//#2 validasi kedua jika data pelanggan yang bayar tidak sesuai dengan pelanggan yang login
if($_SESSION['pelanggan']['id_pelanggan']!== $detbay['id_pelanggan']){
    
    echo'<script>alert("Tidak Diketahui")</script>';
    echo'<script>location="riwayat.php"</script>';

}

// #3 jika pelanggan belum melakukan login
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
    <title>Lihat Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'menu.php'; ?>

    <div class="container">
        <h3>Lihat Pembayaran</h3>
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $detbay['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?= $detbay['bank'];?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $detbay['tanggal_pembelian']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp.<?= number_format($detbay['jumlah']);?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img src="buktipembayaran/<?= $detbay['bukti']?>" alt="<?= $detbay['bukti']?>" class="img-responsive">
            </div>
        </div>
    </div>
    
</body>
</html>