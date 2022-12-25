<?php
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}

$datakategori=array();
$ambil=mysqli_query($koneksi, "SELECT * FROM kategori2");
while($tiap=$ambil->fetch_assoc()){
    $datakategori[]=$tiap;
}
?>
<h2>Ubah Data Produk</h2>
<?php
   
    $ambil=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$_GET[id]'");
   $pecah=$ambil->fetch_assoc();
    
?>
<!-- <pre> -->
    <?php
   // print_r($pecah);
    ?>
<!-- </pre> -->

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
         <div class="form-group">
        <label for="">Kategori</label>
        <select name="id_kategori" id="" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>
            <option value="<?= $value['id_kategori']; ?>" <?php if($pecah['id_kategori']==$value['id_kategori']){ echo "selected"; } ?>>
            <?= $value['nama_kategori']; ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="nama" placeholder="masukan nama produk yang baru" value=<?= $pecah['nama_produk'];?>>
    </div>
    <div class="form-group">
        <label>Harga Produk</label>
        <input type="number" class="form-control" name="harga" placeholder="masukan harga produk yang baru" value="<?= $pecah['harga_produk'];?>">
    </div>
    <div class="form-group">
        <label>Berat Produk</label>
        <input type="number" class="form-control" placeholder="masukan berat produk" name="berat" value="<?= $pecah['berat_produk'];?>">
    </div>
    <div class="form-group">
        <img src="../fotoproduk/<?= $pecah['foto_produk'];?>" alt="<?= $pecah['foto_produk'];?>" width="200px">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label>Stok Produk</label>
        <input type="number" class="form-control" name="stok">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"><?= $pecah['deskripsi_produk'];?></textarea>
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
    if(isset($_POST['ubah'])){

        //mengambil data foto 
        $namafile=$_FILES['foto']['name'];
        $lokasi=$_FILES['foto']['tmp_name'];
        
        
        $type1=explode('.',$namafile);
        $type2=$type1[1];

        $nama='fotoproduk'.time().'.'.$type2;

        $tipediizinkan= array('jpg','jpeg','png');
        
        if(!empty($lokasi)){

             if(!in_array($type2, $tipediizinkan)){
            //jika file inputan tidak sesuai
            echo'<script>alert("Format file tidak diizinkan")</script>';
             }else{
            move_uploaded_file($lokasi,"../fotoproduk/".$nama);
            $koneksi->query("UPDATE produk SET id_kategori='$_POST[id_kategori]', nama_produk='$_POST[nama]', harga_produk='$_POST[harga]', berat_produk='$_POST[berat]', foto_produk='$nama', deskripsi_produk='$_POST[deskripsi]', stok_produk='$_POST[stok]' WHERE id_produk='$_GET[id]' ");
        }
        }else{
            $koneksi->query("UPDATE produk SET id_kategori='$_POST[id_kategori]', nama_produk='$_POST[nama]', harga_produk='$_POST[harga]', berat_produk='$_POST[berat]', deskripsi_produk='$_POST[deskripsi]', stok_produk='$_POST[stok]' WHERE id_produk='$_GET[id]' ");
        }
        echo'<script>alert("Data Produk Di Perbarui")</script>';
        echo'<script>location="index.php?halaman=produk"</script>';
    }
?>