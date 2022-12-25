<?php 
session_start();
//koneksi ke database
include 'admin/db.php';


if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
    echo'<script>alert("Silahkan Login")</script>';
    echo'<script>location="login.php"</script>';
}

// mendapatkan id pembelian dari url

$idpem=$_GET['id'];
$ambil=mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pembelian='$idpem' ");
$detpem=$ambil->fetch_assoc();

//mendapatkan id pelanggan uang beli
$idpelangganyangbeli=$detpem['id_pelanggan'];
$idpelangganyanglogin=$_SESSION['pelanggan']['id_pelanggan'];

if($idpelangganyangbeli !== $idpelangganyanglogin){
    echo'<script>alert("tidak diketahui")"</script>';
    echo'<script>location="riwayat.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
    <?php
    include 'menu.php';
    ?>
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim Bukti Pembayaran Disini</p>
    <div class="alert alert-info">Total tagihan anda <strong>Rp.<?= number_format($detpem['total_pembelian']);?></strong></div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" name="bank" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" min="1" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="bukti" required>
                <p class="text-danger">Foto bukti minimal 2mb</p>
            </div>
            <button class="btn btn-primary" name="kirim">kirim</button>
        </form>
    <!-- jika tombol kirim di tekan -->
    <?php
    if(isset($_POST['kirim'])){
        //upload file
        $namabukti=$_FILES['bukti']['name'];
        $lokasibukti=$_FILES['bukti']['tmp_name'];
        $namafiks=date("YmdHis").$namabukti;
        move_uploaded_file($lokasibukti, "buktipembayaran/$namafiks");

        //upload data input
        $nama=$_POST['name'];
        $bank=$_POST['bank'];
        $jumlah=$_POST['jumlah'];
        $tanggal=date("Y-m-d");
        //simpan pembayaran
        $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");
        
        //update pembelian dari pending ke sudah bayar
        $koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' WHERE id_pembelian='$idpem' ");
        echo'<script>alert("terimakasih sudah berbelanja")</script>';
        echo'<script>location="riwayat.php"</script>';
    }

?>


    </div>
    
</body>
</html>