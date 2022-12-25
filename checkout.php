<?php 
    session_start();
    include 'admin/db.php';

    if(!isset($_SESSION['pelanggan'])){
        echo'<script>alert("login terlebih dahulu")</script>';
        echo'<script>location="login.php"</script>';
    }
    if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
        echo'<script>alert("belanja terlebih dahulu")</script>';
        echo'<script>location="index.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <!-- navbar -->
 <?php 
    include 'menu.php';
 ?>

    <!-- <pre> -->
        <?php 
   //     print_r($_SESSION['pelanggan']); 
     //   print_r($_SESSION['keranjang']);
        
        ?>
    <!-- </pre> -->

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

                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php $totalbelanja=0; ?>
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
                        
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subharga;?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp.<?= number_format($totalbelanja);?></th>
                    </tr>
                </tfoot>
            </table>
           <form method="post">
        
            <div class="row">
                <div class="col-md-4">    
                    <div class="form-group">
                        <input type="text" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan'];?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan'];?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="id_ongkir" class="form-control">
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php 
                        $ambil=mysqli_query($koneksi, "SELECT * FROM ongkir");
                        while($perongkir=$ambil->fetch_assoc()){
                        ?>
                        <option value="<?= $perongkir['id_ongkir']; ?>">
                            <?= $perongkir['nama_pulau'];?>- 
                           Rp.<?= number_format($perongkir['tarif']);?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap Pengiriman</label>
                    <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan Alamat Lengkap Pengiriman" ></textarea>
                </div>
            
            <button class="btn btn-primary" name="checkout">Checkout</button>
           </form>

           <?php

            if(isset($_POST['checkout'])){
                $id_pelanggan=$_SESSION['pelanggan']['id_pelanggan'];
                $id_ongkir=$_POST['id_ongkir'];
                $tanggal_pembelian=date("Y-m-d");
                $alamat=$_POST['alamat_pengiriman'];

                $ambil=mysqli_query($koneksi, "SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir' ");
                $arrayongkir=$ambil->fetch_assoc();
                $nama_pulau=$arrayongkir['nama_pulau'];
                $tarif=$arrayongkir['tarif'];

                $totalpembelian=$totalbelanja + $tarif;

                //menyimpan data ke tabel pembelian 
                $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_pulau,tarif,alamat) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$totalpembelian','$nama_pulau','$tarif','$alamat') ");
                
                // mendapatkan id pembelian barusan terjadi

                $id_pembelian_barusan=$koneksi->insert_id;

            //    echo $id_pembelian_barusan;

                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                    
                    //mendapatkan data produk berdasarkan id produk
                    $ambil=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk' ");
                    $perproduk=$ambil->fetch_assoc();

                    $nama=$perproduk['nama_produk'];
                    $harga=$perproduk['harga_produk'];
                    $berat=$perproduk['berat_produk'];
                    $subberat=$perproduk['berat_produk']*$jumlah;
                    $subharga=$perproduk['harga_produk']*$jumlah;

                    $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah,nama,harga,berat,subberat,subharga) VALUES ('$id_pembelian_barusan','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga') ");

                    //skrip update status stok produk
                    $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk' ");
                }

                //mengkosong kan keranjang belanja

                unset($_SESSION['keranjang']);

                echo'<script>alert("pembelian sukses")</script>';
                echo"<script>location='nota.php?id=$id_pembelian_barusan'</script>";
                

            }

           ?>
        </div>
    </section>
</body>
</html>