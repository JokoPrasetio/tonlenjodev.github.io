<?php
$ambil=mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$ambil->fetch_assoc();


if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}

?>
<!-- <pre> -->
    <?php
  //  print_r($detail);
    ?>
<!-- </pre> -->
<h2>Detail Pembelian</h2>
<hr>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <p>
            <?= $detail['tanggal_pembelian'];?><br>
             total Rp. <?=  number_format($detail['total_pembelian']);?><br>
             status : <?= $detail['status_pembelian'];?>
        </p>        
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
        <strong><?= $detail['nama_pulau'];?></strong>
        <p>
            Tarif  : Rp. <?= $detail['tarif']; ?><br>
            Alamat : <?= $detail['alamat'];?> 
        </p>
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
        $ambil=mysqli_query($koneksi, "SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]' ");
        while($pecah=$ambil->fetch_assoc()){
        ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah['nama'];?></td>
            <td>Rp. <?= number_format($pecah['harga']);?></td>
            <td><?= $pecah['jumlah'];?></td>
            <td>
                Rp.<?= number_format($pecah['subharga']);?>
            </td>
        </tr>
        <?php $nomor++;?>
        <?php } ?>
    </tbody>
</table>

