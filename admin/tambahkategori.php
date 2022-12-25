<?php 
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}
 ?>
<h2>Tambah Kategori</h2>
<hr>
<form action="" method="post">
    <div class="form-group">
        <label for="">Nama Kategori</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukan nama kategori" required>
    </div>
    <button class="btn btn-primary" name="simpan" >Simpan</button>
</form>

<?php 
    if(isset($_POST['simpan'])){
        $namakategori=$_POST['nama'];

        $tambah=mysqli_query($koneksi, "INSERT INTO kategori2 VALUES (null, '".$namakategori."') ");

        if($tambah){
            echo'<script>alert("Kategori Ditambahkan")</script>';
            echo'<script>location="index.php?halaman=kategori"</script>';
        }else{
            echo "gagal" .mysqli_error($koneksi);
        }
    }
?>