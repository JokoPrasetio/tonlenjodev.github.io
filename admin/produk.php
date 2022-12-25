<?php
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}
?>
<h2>Data Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat(Gr)</th>
            <th>Foto</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $nomor=1;
        $ambil=mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori2 ON produk.id_kategori=kategori2.id_kategori ");
        if(mysqli_num_rows($ambil) > 0){
        while($pecah=$ambil->fetch_assoc()){;
        ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $pecah['nama_kategori']; ?></td>
            <td><?= $pecah['nama_produk']; ?></td>
            <td>Rp. <?= number_format($pecah['harga_produk']); ?></td>
            <td><?= $pecah['berat_produk']; ?></td>
            <td>
                <img src="../fotoproduk/<?= $pecah['foto_produk'];?>" alt="<?= $pecah['foto_produk'];?>" width=100px>
            </td>
            <td><?=$pecah['stok_produk'];?></td>
            <td>
                <a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk'];?>" class="btn btn-primary">Ubah</a>
                <a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-danger">Hapus</a>
                <a href="index.php?halaman=detailinfo&id=<?= $pecah['id_produk'];?>" class="btn btn-info">Detail</a>
            </td>
        </tr>
        <?php $nomor++;?>
        <?php } }else{ ?>
            <tr>
                <td colspan="8">Tidak ada data</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>

