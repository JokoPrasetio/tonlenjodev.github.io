<?php 
$ambil=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();
$foto=$pecah['foto_produk'];

if(file_exists("../fotoproduk/$foto")){
    unlink("../fotoproduk/$foto");
}

$hapus=mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo '<script>alert("DATA PRODUK TERHAPUS")</script>';
echo '<script>location="index.php?halaman=produk"</script>';

?>