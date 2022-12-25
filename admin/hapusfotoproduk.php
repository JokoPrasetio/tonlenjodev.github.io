<?php 

$idfoto=$_GET['idfoto'];
$idproduk=$_GET['idproduk'];

//ambil data 
$ambilfoto=mysqli_query($koneksi, "SELECT * FROM produk_foto WHERE id_produk_foto='$idfoto' ");
$detfot=$ambilfoto->fetch_assoc();

//echo '<pre>' ;
//print_r($detfot);
//echo '</pre>';

$nffoto=$detfot['nama_produk_foto'];
//menghapus data foto
unlink("../fotoproduk/".$nffoto);

$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$idfoto' ");

echo '<script>alert("foto dihapus")</script>';
echo "<script>location='index.php?halaman=detailinfo&id=$idproduk';</script>";
?>