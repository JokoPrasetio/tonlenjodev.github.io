<?php
//validasi login admin jika admin belum melakukan login maka tidak bisa masuk
if(!isset($_SESSION['admin'])){
    echo'<script>alert("Tidak Diketahui")</script>';
    echo'<script>location="login.php"</script>';
}

$ambil=mysqli_query($koneksi, "SELECT * FROM kategori2 WHERE id_kategori='$_GET[id]' ");
$pecah=mysqli_fetch_assoc($ambil);
?>
<h2>Ubah Kategori</h2>
<hr>

<!-- <pre> -->
    <?php// print_r($pecah);?>
<!-- </pre> -->
<form action="" method="post">
    <div class="form-group">
        <label for="">Nama Kategori</label>
        <input type="text" class="form-control" name="kategori" value="<?= $pecah['nama_kategori']; ?>">
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>
<?php 
    if(isset($_POST['ubah'])){
        //mengambil data file ubah inputan
        $nama=$_POST['kategori'];

        $ubah=mysqli_query($koneksi, "UPDATE kategori2 SET nama_kategori='$nama' WHERE id_kategori='$_GET[id]' ");

        echo'<script>alert("Data Produk Di Perbarui")</script>';
        echo'<script>location="index.php?halaman=kategori"</script>';
    }
?>
