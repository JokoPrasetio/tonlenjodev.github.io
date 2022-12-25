<?php
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}
?>
<h2>Data Pelanggan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>telepon</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor=1;
        $ambil=mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($pecah=$ambil->fetch_assoc()) {
        ?>
        <tr>
           <td><?=$nomor;?></td> 
           <td><?= $pecah['nama_pelanggan'];?></td> 
           <td><?= $pecah['email_pelanggan'];?></td> 
           <td><?= $pecah['telepon_pelanggan'];?></td> 
           <td>
            <a href="index.php?halaman=hapuspelanggan&id=<?= $pecah['id_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
           </td> 
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>