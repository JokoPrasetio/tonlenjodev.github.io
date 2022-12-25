<?php
    $id_produk=$_GET['id']; 

    $ambil=mysqli_query($koneksi,"SELECT * FROM produk LEFT JOIN kategori2 ON produk.id_kategori=kategori2.id_kategori WHERE id_produk='$id_produk' ");
    $detailproduk=$ambil->fetch_assoc();

    $fotoproduk=array();
    $ambilfoto=mysqli_query($koneksi, "SELECT * FROM produk_foto WHERE id_produk='$id_produk' ");
    while($tiap=$ambilfoto->fetch_assoc()){
        $fotoproduk[] = $tiap;
    }


//echo'<pre>';
//print_r($detailproduk); 
//print_r($fotoproduk);
//echo' </pre>'; 
?>

<h2>Detail Produk</h2>
<hr>

<table class="table">
    <tr>
        <th>Kategori</th>
        <td><?= $detailproduk['id_kategori']; ?></td>
    </tr>
    <tr>
        <th>Produk</th>
        <td><?= $detailproduk['nama_produk']; ?></td>
    </tr>
    <tr>
        <th>Harga</th>
        <td>Rp. <?= number_format($detailproduk['harga_produk']);?></td>
    </tr>
    <tr>
        <th>Berat</th>
        <td><?= $detailproduk['berat_produk'];?></td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td><?= $detailproduk['deskripsi_produk']; ?></td>
    </tr>
    <tr>
        <th>Stok</th>
        <td><?= $detailproduk['stok_produk'];?></td>
    </tr>

</table>

<div class="row">

    <?php foreach ($fotoproduk as $key => $value) : ?>
    <div class="col-md-3 text-center">
        <img src="../fotoproduk/<?= $value['nama_produk_foto'];?>" alt="" class="img-responsive"><br>
        <a href="index.php?halaman=hapusfotoproduk&idfoto=<?= $value['id_produk_foto']?>&idproduk=<?= $id_produk; ?>" class="btn btn-danger btn-sm">Hapus</a>
    </div>
    <?php endforeach ?>
</div>


<hr>
<form action="" enctype="multipart/form-data" method="post">
    <div class="form-group">
        <label for="">file foto</label>
        <input type="file" name="produkfoto">
    </div>
    <button class="btn btn-primary" name="simpan" vlaue="simpan">Simpan</button>
</form>

<?php
if(isset($_POST['simpan'])){
    $lokasifoto= $_FILES['produkfoto']['tmp_name'];
    $namafoto=$_FILES['produkfoto']['name'];

    $namafoto=date("YmdHis").$namafoto;
    //upload
    move_uploaded_file($lokasifoto,"../fotoproduk/".$namafoto);

    $koneksi->query("INSERT INTO produk_foto (id_produk,nama_produk_foto) VALUES ('$id_produk','$namafoto') ");

    echo '<script>alert("foto ditambahkan")</script>';
    echo "<script>location='index.php?halaman=detailinfo&id=$id_produk';</script>";
}
?>