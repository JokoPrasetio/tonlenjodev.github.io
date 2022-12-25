<?php 
//validasi login, jika belum melakukan login maka tidak bisa masuk 
if(!isset($_SESSION['admin'])){
    echo'<script>alert("Tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}

?>

<h2>Data Kategori</h2>
<hr>

<?php 
$semuadata=array();
$ambil=mysqli_query($koneksi, "SELECT * FROM kategori2");
if(mysqli_num_rows($ambil) >0){
while($tiap=$ambil->fetch_assoc()){
    $semuadata[]=$tiap;
}
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($semuadata as $key => $value) : ?>
        <tr>
            <td><?= $key+1; ?></td>
            <td><?= $value['nama_kategori'];?></td>
            <td>
                <a href="index.php?halaman=ubahkategori&id=<?= $value['id_kategori']; ?>" class="btn btn-primary">Ubah</a>
                <a href="index.php?halaman=hapuskategori&id=<?= $value['id_kategori'];?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
        <?php }else { ?>
            <tr>
                <td>Tidak Ada Kategori</td>
            </tr>
          <?php } ?>  
    </tbody>
</table>

<a href="index.php?halaman=tambahkategori" class="btn btn-default">Tambah Data</a>